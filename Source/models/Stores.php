<?php

include __DIR__ . "/../interfaces/iStores.php";

class stores implements istores {

    private $db = null;

    /** Store stores count * */
    public $stores_count = null;

    function __construct(Cdb $db) {
        $this->db = $db;
    }

    /**
     * add new store !
     * @param type $data 
     */
    public function addStore($data) {
        $sub_cat_data = $data['sub_category_id'];
        unset($data['sub_category_id']);

        if ($data['store_name']) {
            if (!ctype_alnum($data['store_name']))
                return self::ERR_ALPHA_NUM;

             $st = $this->db->select_record ('stores',"store_name = '{$data['store_name']}'");
             if($st)
                return self::ERR_STORE_EXIST;
            
            $data['store_name'] = trim($data['store_name']);
            $data['store_name'] = str_replace(" ", "_", $data['store_name']);
        }

        $add_store = $this->db->insert('stores', $data);


        foreach ($sub_cat_data as $sub_cat) {
            $this->db->insert('store_sub_categories', array('store_id' => $add_store, 'category_id' => $sub_cat));
        }

        return $add_store;
    }

    public function editStore($id, $data) {
        $sub_cat_data = $data['sub_category_id'];
        unset($data['sub_category_id']);
        if ($data['store_name']) {
            if (!ctype_alnum($data['store_name']))
                return self::ERR_ALPHA_NUM;

            $st = $this->db->select_record ('stores',"store_name = '{$data['store_name']}' AND id != '$id'");
            if($st)
                return self::ERR_STORE_EXIST;
            
            $data['store_name'] = trim($data['store_name']);
            $data['store_name'] = str_replace(" ", "_", $data['store_name']);
        }

        $edit_store = $this->db->update('stores', $data, "id='$id'");

        // Delete Old sub-categories
        $this->db->delete('store_sub_categories', "store_id = '$id'");
        foreach ($sub_cat_data as $sub_cat) {
            $this->db->insert('store_sub_categories', array('store_id' => $id, 'category_id' => $sub_cat));
        }

        return $edit_store;
    }

    /** Delete Store * */
    public function deleteStore($id) {
        return $this->db->delete("stores", "id='$id'");
    }

    /**
     * Get store by id 
     */
    public function getStore($id, $account_id = false) {
        global $local;

        $join_fields = "countries.title_$local as cn_title,
                      ACAT.title_$local as cat_title,ACAT.id as cat_id
                      ,cities.title_$local as city_title,areas.title_$local as area_title ,favorites.id as fav,
                          (CASE WHEN stores.store_name != '' THEN stores.store_name ELSE stores.id END) as id ";

        $join_sql = "INNER JOIN countries ON stores.country_code = countries.code
                     LEFT JOIN categories ACAT ON ACAT.id = stores.category_id
                     LEFT JOIN cities ON cities.id = stores.city_id
                     LEFT JOIN areas ON areas.id = stores.area_id
                     LEFT JOIN store_sub_categories ON store_sub_categories.store_id = stores.id
                     LEFT JOIN favorites ON favorites.account_id = '$account_id' AND stores.id = favorites.store_id";

        $store = $this->db->select_record('stores', "stores.id='$id' OR stores.store_name = '$id'", false, false, false, false, $join_fields, $join_sql);


        if ($store) {
            $join_sql2 = 'INNER JOIN categories ON categories.id = store_sub_categories.category_id';
            $join_fields2 = "categories.title_$local as sub_cat_title,categories.id";
            $store['sub_categories'] = $this->db->select('store_sub_categories', "store_id = '{$store['id']}'", false, false, false, false, $join_fields2, $join_sql2);

            $store['nfavorites'] = $this->db->query_value("SELECT COUNT(*) FROM favorites WHERE store_id = '{$store['id']}'");
        }

        return $store;
    }

    /**
     * get all stores
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type 
     */
    public function getStores($count, $page_no, $filter = false, $account_id = false, $mystores = false, $fav_store = false, $admin = false) {
        global $local;
        $join_fields = "SELECT SQL_CALC_FOUND_ROWS stores.*, countries.title_$local as cn_title,
                      ACAT.title_$local as cat_title,ACAT.id as cat_id
                      ,cities.title_$local as city_title,areas.title_$local as area_title
                       ,favorites.id as fav,(CASE WHEN stores.store_name != '' THEN stores.store_name ELSE stores.id END) as st_id  
                       FROM stores ";


        $join_sql = "INNER JOIN countries ON stores.country_code = countries.code
                     LEFT JOIN categories ACAT ON ACAT.id = stores.category_id
                     LEFT JOIN cities ON cities.id = stores.city_id
                     LEFT JOIN areas ON areas.id = stores.area_id
                     LEFT JOIN store_sub_categories ON store_sub_categories.store_id = stores.id";
        if ($fav_store)
            $join_sql.=' INNER ';else
            $join_sql .= ' LEFT ';
        $join_sql .= " JOIN favorites ON favorites.account_id = '$account_id' AND stores.id = favorites.store_id
                     ";



        $sql = ' WHERE ';
        /** Search critiria here * */
        /** get my stores * */
        if ($mystores) {
            $criteria = " stores.account_id = '$account_id' ";
        }

        if ($filter['keyword'] && $filter['keyword'] != l('keyword')) {
            $criteria = " (stores.title LIKE '%{$filter['keyword']}%' OR stores.description LIKE '%{$filter['keyword']}%') ";
        }

        //if category
        if ($filter['category_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (stores.category_id = '{$filter['category_id']}') ";
        }

        //if sub category
        if ($filter['sub_category_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (store_sub_categories.category_id = {$filter['sub_category_id']}) ";
        }

        //if country
        if ($filter['country_code']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (stores.country_code = '{$filter['country_code']}') ";
        }

        //if city
        if ($filter['city_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (stores.city_id = '{$filter['city_id']}') ";
        }

        // if trusted
        if($filter['trusted']){
        	if ($criteria)
        		$criteria .=' AND ';
        	$criteria .= " (stores.trusted = '1') ";
        }
        
        //if area
        if ($filter['area_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (stores.area_id = '{$filter['area_id']}') ";
        }

        $sql .= $criteria;
        //Fix if there are no critria
        if (!$criteria)
            $sql .= ' 1 ';
        $sql .= 'GROUP BY stores.id';


        $sql .= " ORDER BY (CASE WHEN stores.promoted =1 THEN stores.promoted  END) DESC,id DESC  ";

        $sql .= limit($count, $page_no);

        $full_sql = $join_fields . $join_sql . $sql;
        $stores = $this->db->query($full_sql);
        //get Stores Count
        $this->stores_count = $this->db->query_value("SELECT  FOUND_ROWS() as cnt");

        /** add subcategories to stores array * */
        foreach ($stores as $store) {
            $join_sql2 = 'INNER JOIN categories ON categories.id = store_sub_categories.category_id';
            $join_fields2 = "categories.title_$local as sub_cat_title,categories.id";
            $store['sub_categories'] = $this->db->select('store_sub_categories', "store_id = '{$store['id']}'", false, false, false, false, $join_fields2, $join_sql2);
            if ($admin) {
                $store['items_count'] = $this->db->query_value("SELECT COUNT(*) FROM items WHERE store_id = {$store['id']} ");
            }
            $new_stores [] = $store;
        }

        return $new_stores;
    }

    
    public function promoteStore ($store_id,$p){
        if($p == '1')
            $data = array ('promoted'=>1);
        else
            $data = array ('promoted'=>0);
        
        return $this->db->update ('stores',$data,"id = '$store_id'");
    }
    /**
     * Add item to favorite
     * @param type $account_id
     * @param type $item_id
     * @return type 
     */
    public function addToFavorite($account_id, $store_id) {

        $is_added = $this->db->select_record('favorites', "store_id = '$store_id' AND account_id = '$account_id'");

        if ($is_added)
            return false;

        return $this->db->insert('favorites', array('store_id' => $store_id, 'account_id' => $account_id));
    }

    /**
     * remove from favorites
     * @param type $account_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeFromFavorite($account_id, $store_id) {
        return $this->db->delete('favorites', "store_id = '$store_id' AND account_id = '$account_id'");
    }

    /**
     * return all categories (Main) 
     */
    public function getCategories() {
        global $local;
        $sql = "SELECT title_$local AS title,id,main_category FROM categories WHERE main_category = 0";
        return $this->db->query($sql);
    }

    /**
     * get subcategories
     * @global string $local
     * @param integer $id
     * @return mixed 
     */
    public function getSubCategory($id) {
        global $local;
        $sql = "SELECT title_$local AS title,id,main_category FROM categories WHERE main_category = '$id'";
        return $this->db->query($sql);
    }

}

?>
