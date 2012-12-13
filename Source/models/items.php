<?php

include __DIR__ . "/../interfaces/iItems.php";

class items implements iItems {

    private $db = null;
    private $user = null;
    //All items count from search or list
    public $items_count = null;
    public $orders_item_count = null;

    function __construct(Cdb $db) {
        global $oUser;
        $this->user = $oUser;
        $this->db = $db;
    }

    /**
     * add new item 
     */
    public function addItem($data, $account_id = FALSE) {
        if (empty($data['store_id']))
            unset($data['store_id']);
        //Check if iam adding item into my store !!
        if ($data['store_id']) {
            $is_my_store = $this->db->select_record('stores', "(id= '{$data['store_id']}' OR store_name = '{$data['store_id']}') AND account_id = '$account_id'");
            if (!$is_my_store)
                unset($data['store_id']);
            else
                $data['store_id'] = $is_my_store['id'];
        }

        if ($data['weight'] <= 0)
            $data['weight'] = 1;
        if ($data['quantity'] <= 0)
            $data['quantity'] = 1;

        return $this->db->insert('items', $data);
    }

    public function editItem($id, $data) {
        return $this->db->update('items', $data, "id = '$id'");
    }

    public function deleteItem($id) {
        return $this->db->delete('items', "id = '$id'");
    }

    public function getItem ($id, $account_id = false) {

        global $local;
        $join_fields = "countries.title_$local as cn_title,stores.title as st_title,
                      ACAT.title_$local as cat_title,ACAT.id as cat_id,BCAT.title_$local as subcat_title,BCAT.id as sub_cat_id
                      ,cities.title_$local as city_title,areas.title_$local as area_title,favorites.id as fav,drop_requests.id as drop_request
                        ";

        $join_sql = "INNER JOIN countries ON items.country_code = countries.code
                     LEFT JOIN categories ACAT ON ACAT.id = items.category_id
                     LEFT JOIN categories BCAT ON BCAT.id = items.sub_category_id
                     LEFT JOIN cities ON cities.id = items.city_id
                     LEFT JOIN areas ON areas.id = items.area_id
                     LEFT JOIN stores ON items.store_id = stores.id 
                     LEFT JOIN favorites ON favorites.account_id = '$account_id' AND items.id = favorites.item_id
                     LEFT JOIN drop_requests ON drop_requests.account_id = '$account_id' AND items.id = drop_requests.item_id AND drop_requests.approved = 0 
                    ";

        $item = $this->db->select_record('items', "items.id = '$id'", false, false, false, false, $join_fields, $join_sql);

        $item['nfavorites'] = $this->db->query_value("SELECT COUNT(*) FROM favorites WHERE item_id = '{$item['id']}'");
        return $item;
    }

    public function addRecord($item_id, $user_id, $data) {
        $item = $this->getItem($item_id, $user_id);
        if (!$item)
            return self::ERR_NOT_EXIST;

        //Check if their empty room
        if ($item['quantity'] == $item['records'])
            return self::ERR_FULL_RECORD;


        $sql = "UPDATE items SET records = records + 1 WHERE id = '$item_id'";
        $this->db->execute($sql);
        return $this->db->insert('items_records', array('item_id' => $item_id, 'rec1' => $data['rec1'], 'rec2' => $data['rec2']));
    }

    public function delRecord($item_id, $user_id, $record_id) {
        $item = $this->getItem($item_id, $user_id);
        if (!$item)
            return self::ERR_NOT_EXIST;

        $record = $this->db->select_record("items_records", "id = '{$record_id}'");
        if ($record['account_id'] != 0)
            return self::ERR_PAIED_RECORD;

        $sql = "UPDATE items SET records = records-1 WHERE id = '$item_id'";
        $this->db->execute($sql);
        return $this->db->delete('items_records', "id = '{$record_id}'");
    }

    public function getRecords($item_id) {
        return $this->db->select('items_records', "item_id = '$item_id'");
    }

    /**
     * Get all items
     * @global type $local
     * @param type $count
     * @param type $page_no 
     */
    public function getItems($count, $page_no, $filter = false, $store_id = false, $account_id = false, $myitems = false, $fav_items = false) {

        global $local;
        $join_fields = "SELECT SQL_CALC_FOUND_ROWS items.*,accounts.email,countries.title_$local as cn_title,stores.title as st_title,
                      ACAT.title_$local as cat_title,ACAT.id as cat_id,BCAT.title_$local as subcat_title,BCAT.id as sub_cat_id
                      ,cities.title_$local as city_title,areas.title_$local as area_title 
                       ,favorites.id as fav,drop_requests.id as drop_request,(CASE WHEN stores.store_name != '' THEN stores.store_name ELSE items.store_id END) as st_id 
                       FROM items ";

        $join_sql = "INNER JOIN countries ON items.country_code = countries.code
                     LEFT JOIN categories ACAT ON ACAT.id = items.category_id
                     LEFT JOIN categories BCAT ON BCAT.id = items.sub_category_id
                     LEFT JOIN cities ON cities.id = items.city_id
                     LEFT JOIN areas ON areas.id = items.area_id
                     LEFT JOIN stores ON items.store_id = stores.id
                     LEFT JOIN accounts ON accounts.id = items.account_id";
        if ($fav_items)
            $join_sql.=' INNER ';else
            $join_sql .= ' LEFT ';
        $join_sql.= "JOIN favorites ON favorites.account_id = '$account_id' AND items.id = favorites.item_id 
                     LEFT JOIN drop_requests ON drop_requests.account_id = '$account_id' AND items.id = drop_requests.item_id AND drop_requests.approved = 0 
                     ";


        $sql = ' WHERE ';

        /** my items * */
        if ($myitems)
            $criteria = " items.account_id = '$account_id'";

        /** Stores items * */
        if ($store_id){
            //Get store name
            $store_name = $this->db->select_record ('stores',"id = '$store_id' OR store_name = '$store_id'");
            $store_id = $store_name['id'];
            
            $criteria = " (items.store_id = '{$store_id}') ";
        }
        
        /** Filter * */
        if ($filter['keyword'] && $filter['keyword'] != l('keyword')) {
            $criteria = " (items.title LIKE '%{$filter['keyword']}%' OR items.description LIKE '%{$filter['keyword']}%') ";
        }

        //If Store
        if ($filter['store'] && $filter['store'] != l('Store')) {
            if ($criteria)
                $criteria.= ' AND ';
            $criteria .= " (stores.title LIKE '%{$filter['store']}%' OR stores.description LIKE '%{$filter['store']}%' ) ";
        }

        //if category
        if ($filter['category_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.category_id = '{$filter['category_id']}') ";
        }

        //if sub category
        if ($filter['sub_category_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.sub_category_id = '{$filter['sub_category_id']}') ";
        }

        //if type
        if ($filter['item_type']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.item_type = '{$filter['item_type']}') ";
        }


        //if country
        if ($filter['country_code']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.country_code = '{$filter['country_code']}') ";
        }

        //if city
        if ($filter['city_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.city_id = '{$filter['city_id']}') ";
        }

        //if area
        if ($filter['area_id']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.area_id = '{$filter['area_id']}') ";
        }

        //if shipping type
        if ($filter['shipping_type']) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.shipping_type = '{$filter['shipping_type']}') ";
        }

        //if from price 
        if ($filter['pricefrom'] && $filter['pricefrom'] != l('price from')) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.price >= '{$filter['pricefrom']}') ";
        }

        //if to price 
        if ($filter['priceto'] && $filter['priceto'] != l('price to')) {
            if ($criteria)
                $criteria .=' AND ';
            $criteria .= " (items.price <= '{$filter['priceto']}') ";
        }
        //if trusted
        
        if($filter['trusted']){
        	if ($criteria)
        		$criteria .=' AND ';
        	$criteria .= " (stores.trusted = '1') ";
        }
         
        
        $sql .= $criteria;
        
        //Fix if there are no critria
        if (!$criteria)
            $sql .= ' 1 ';

        $sql .= 'GROUP BY items.id';
        $sql .= " ORDER BY (CASE WHEN items.promoted =1 THEN items.promoted  END) DESC,id DESC ";

        $sql .= limit($count, $page_no);

        $full_sql = $join_fields . $join_sql . $sql;
        $items = $this->db->query($full_sql);
        //get Stores Count
        $this->items_count = $this->db->query_value("SELECT  FOUND_ROWS() as cnt");

        return $items;
        //return $this->db->select ('items',$sql,false,false,"id DESC",limit($count,$page_no,true),$join_fields,$join_sql);
    }

    public function getsearchitem($count, $page_no, $filter = false, $store_id = false, $account_id = false, $myitems = false, $fav_items = false) {
    	global $local;
    	$sql = "SELECT DISTINCT title FROM items ";
    	$sql .='WHERE ';
    	 
    	// if ($myitems)
    	$criteria = " items.title LIKE '{$filter['keyword']}%' ";
    	$sql .= $criteria;
    
    	$sql .= 'GROUP BY items.id';
    	$sql .= " ORDER BY (CASE WHEN items.promoted =1 THEN items.promoted  END) DESC,id DESC ";
    	$sql .= limit($count, $page_no);
    	$full_sql = $join_fields . $join_sql . $sql;
    	//echo $full_sql;exit;
    	$items = $this->db->query($full_sql);
    	//get Stores Count
    	$this->items_count = $this->db->query_value("SELECT  FOUND_ROWS() as cnt");
    	//echo $items[0]['title'];exit;
    	$array=array();
    	for ($i=0;$i<count($items);$i++){
    		$array[$i]=$items[$i]['title'];
    
    	}
    
    	// $items_count
    	//var_dump($array);exit;
    	return $array;
    
    }
    
    
    /**
     * Add item to favorite
     * @param type $account_id
     * @param type $item_id
     * @return type 
     */
    public function addToFavorite($account_id, $item_id) {

        $is_added = $this->db->select_record('favorites', "item_id = '$item_id' AND account_id = '$account_id'");

        if ($is_added)
            return false;

        return $this->db->insert('favorites', array('item_id' => $item_id, 'account_id' => $account_id));
    }

    /**
     * remove from favorites
     * @param type $account_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeFromFavorite($account_id, $item_id) {
        return $this->db->delete('favorites', "item_id = $item_id AND account_id = $account_id");
    }

    /**
     * request drop
     * @param type $account_id
     * @param type $item_id
     * @param type $drop_price
     * @return type 
     */
    public function requestDrop($account_id, $item_id, $drop_price) {
        /** get old drop * */
        /** Get Item From here * */
        $item = $this->getItem($item_id);
        if ($item) {
            $user = $this->db->select_record('accounts', "id = '{$item['account_id']}'");

            global $data;
            $data['firstname'] = $user['firstname'];
            $data['item_id'] = $item_id;

            $msg_body = render('views/items/email_drop.php');
            $subject = l('New Drop request for your item');

            AmazonEmail($user['email'], $subject, $msg_body);
            $id = $this->db->insert('drop_requests', array('account_id' => $account_id, 'datetime1' => time(), 'item_id' => $item_id, 'dop_value' => $drop_price));
        }
        return $id;
    }

    /** Shoping cart * */

    /**
     * Get my current opening shoping cart
     * @param type $account_id
     * @return type 
     */
    public function getCart($account_id) {
        return $this->db->select_record('cart', "account_id = '$account_id' AND closed = 0");
    }

    public function getCartCount($account_id) {
        $cart = $this->getCart($account_id);
        if ($cart) {
            $sql = "SELECT COUNT(*) FROM cart_items WHERE cart_id = '{$cart['cart_id']}'";
            return $this->db->query_value($sql);
        }

        return 0;
    }

    /**
     * get my cart items
     * @global type $local
     * @param type $cart_id
     * @return type 
     */
    public function getCartItems($cart_id, $account_id = false, $to_city = false) {

        global $local;
        $join_fields = "cart_items.quantity as qty,drop_requests.*,items.*,CAST(drop_requests.dop_value as SIGNED) as dd,
                      (CASE   WHEN CAST(drop_requests.dop_value as SIGNED) IS NULL THEN items.price 
                      ELSE drop_requests.dop_value  END) AS price
                      ,countries.title_$local as cn_title,stores.title as st_title,
                      ACAT.title_$local as cat_title,ACAT.id as cat_id,BCAT.title_$local as subcat_title,BCAT.id as sub_cat_id
                      ,cities.title_$local as city_title,areas.title_$local as area_title,favorites.id as fav,drop_requests.id as drop_request ";

        $join_sql = "INNER JOIN items ON items.id = cart_items.item_id
                     INNER JOIN countries ON items.country_code = countries.code
                     LEFT JOIN categories ACAT ON ACAT.id = items.category_id
                     LEFT JOIN categories BCAT ON BCAT.id = items.sub_category_id
                     LEFT JOIN cities ON cities.id = items.city_id
                     LEFT JOIN areas ON areas.id = items.area_id
                     LEFT JOIN stores ON items.store_id = stores.id 
                     LEFT JOIN favorites ON favorites.account_id = '$account_id' AND items.id = favorites.item_id
                     LEFT JOIN drop_requests ON drop_requests.id = 
                     (SELECT id FROM drop_requests WHERE drop_requests.account_id = '$account_id' AND drop_requests.item_id = cart_items.item_id AND drop_requests.approved != 0 ORDER BY datetime1 DESC limit 1) 
                    ";

        $items = $this->db->select('cart_items', "cart_items.cart_id = $cart_id", false, false, false, false, $join_fields, $join_sql);

        if ($items)
            foreach ($items as $item) {
                if ($item['shipping_type'] == 'paid') {
                    $ship_cost = $this->db->select_record("shipping_cost", "from_city ='{$item['city_id']}' AND to_city = '$to_city'");
                    $item['first_kilo'] = $ship_cost['first_kilo'];
                    $item['extra_kilo'] = $ship_cost['extra_kilo'];
                }

                $new_items [] = $item;
            }

        return $new_items;
    }

    /**
     * Get cart items count
     * @param type $cart_id
     * @return type 
     */
    public function getCartItemsCount($cart_id) {
        $sql = "SELECT COUNT(*) FROM cart_items WHERE cart_id = '$cart_id' ";
        return $this->db->query_value($sql);
    }

    /**
     * Add item to shopping cart
     * @param type $account_id
     * @param type $item_id 
     */
    public function addItemToCart($account_id, $item_id, $quantity = false) {

        $cart = $this->getCart($account_id);
        $cart_id = $cart['id'];
        /** if there is no cart just create it * */
        if (!$cart)
            $cart_id = $this->db->insert('cart', array('account_id' => $account_id, 'datetime1' => time()));
        /** Check if item in cart * */
        if ($cart)
            $item_in_cart = $this->db->select_record('cart_items', "item_id = '$item_id' AND cart_id = '$cart_id'");

        /** Check if there are prev item from other store * */
        $prev_item = $this->db->select_record('cart_items', "cart_id = '$cart_id'");
        if ($prev_item) {
            $prev_item_data = $this->getItem($prev_item['item_id']);
            $curr_item_data = $this->getItem($item_id);
            if ($prev_item_data['account_id'] != $curr_item_data['account_id'])
                return self::ERR_CART_SAME_STORE;
        }

        /** Fix quantity problem ,must be at least one * */
        if ($quantity <= 0)
            $quantity = 1;

        /** Add item to cart * */
        if (!$item_in_cart)
            $id = $this->db->insert('cart_items', array('cart_id' => $cart_id, 'item_id' => $item_id, 'quantity' => $quantity));

        return $id;
    }

    public function updateCart() {
        
    }

    /**
     * 
     * @param type $cart_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeCartItem($cart_id, $item_id) {
        if (!$cart_id)
            return false;

        return $this->db->delete('cart_items', "cart_id = $cart_id AND item_id = $item_id ");
    }

    public function updateCartItem($cart_id, $item_id, $qty) {
        if (!$cart_id)
            return false;
        return $this->db->update('cart_items', array('quantity' => $qty), "cart_id = $cart_id AND item_id = $item_id ");
    }

    /**
     * Create cart
     * @param type $user_id
     * @param type $data 
     */
    public function closeOrder($user_id, $data) {





        $order['to_id'] = $data['account_id'];
        $order['shipping_name'] = $data['shipping_name'];
        $order['shipping_mobile'] = $data['shipping_mobile'];
        $order['shipping_address'] = $data['shipping_address'];
        $order['country'] = $data['country_code'];
        $order['city_id'] = $data['city_id'];
        $order['from_id'] = $user_id;
        $order['datetime1'] = time();
        $order['cod'] = ($data['cod']) ? 1 : 0;
        $order_id = $this->db->insert('orders', $order);


        /** Total number i have to pay * */
        $return['total_check'] = 0;
        $return['order_id'] = $order_id;
        /** PRepare qty * */
        foreach ($data['itemid'] as $key => $value) {
            $itmqty[$value] = $data['quantity'][$key];
        }



        $my_cart = $this->getCart($user_id);

        $items = $this->getCartItems($my_cart['id'], $user_id, $data['city_id']);
        foreach ($items as $item) {
            if ($item) {
                $item_data['order_id'] = $order_id;
                $item_data['item_id'] = $item['id'];
                $item_data['item_title'] = $item['title'];
                $item_data['quantity'] = $itmqty[$item['id']];
                $item_data['shipping_type'] = $item ['shipping_type'];
                $item_data['country'] = $item ['country_code'];
                $item_data['city_id'] = $item ['city_id'];


                $item_data['item_price'] = $item['price'];
                $item_data['shipping_price'] = (($item['shipping_type'] == 'owner') ? $item['shipping_fees'] : getShipping($item['weight'], $item['first_kilo'], $item['extra_kilo'], $item['qty']));

                $this->db->insert('order_itemes', $item_data);
            }
        }

        /** Send email * */
        //global $order;
        //$order = $this->getOrderDetails($order_id);
        //$message = render('views/cart/email_order.php');
        //$subject = "Order details ";
       
        //AmazonEmail($order['from_email'], $subject, $message);

        /** Close cart * */
        $this->db->update('cart', array('closed' => 1), "account_id = '$user_id' AND closed = 0");


        /** Retun total check * */
        return $order_id;
    }

    /**
     * Get order details
     * @param type $order_id
     * @param type $user_id 
     */
    public function getOrderDetails($order_id, $user_id = false, $transaction_id = false) {
        global $local;
        $sql = "orders.id = '$order_id'";
        if ($user_id)
            $sql .= " AND (orders.from_id = '$user_id' OR orders.to_id = '$user_id')";

        $join_sql = "INNER JOIN accounts A ON orders.from_id = A.id
                     INNER JOIN accounts B on orders.to_id = B.id
                     LEFT JOIN countries CA ON CA.code = orders.country
                     LEFT JOIN cities CITYA ON CITYA.id = orders.city_id
                     LEFT JOIN countries CB on CB.code = B.country_code
                     ";

        $join_fields = "A.title as from_title,A.firstname as from_firstname,A.lastname AS from_lastname,A.mobile as from_mobile,A.email AS from_email,CA.title_$local as country,CITYA.title_$local as city,
                        B.id as to_id,B.title as to_title,B.firstname as to_firstname,B.lastname AS to_lastname,B.mobile as to_mobile,B.email AS to_email,CB.title_$local as country_buyer";

        $order = $this->db->select_record('orders', $sql, false, false, false, false, $join_fields, $join_sql);
        if ($order) {
            $join_sql_item = "LEFT JOIN countries ON countries.code = order_itemes.country
                              LEFT JOIN cities ON cities.id = order_itemes.city_id
            				  INNER JOIN items ON items.id = order_itemes.item_id";

            $join_fields_item = "countries.title_$local as country,cities.title_$local as city, items.coupon";
            $order['items'] = $this->db->select('order_itemes', "order_itemes.order_id = '{$order['id']}'", false, false, false, false, $join_fields_item, $join_sql_item);
        }
        /** CHECK IF PAYMENT IS OK * */
        if ($order['paied'] == 0 && $transaction_id) {
            /** register using api * */
            require_once 'api/Zend/Soap/Client.php';
            $client = new Zend_Soap_Client(API_CLIENT,
                            array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_DEFLATE));

            $unit_prices = 0;
            if ($order['items'])
                foreach ($order['items'] as $itm) {
                    $unit_prices = $unit_prices + ($itm['quantity'] * $itm['item_price'])+$itm['shipping_price'];
                
}


            $seller_private_key = $this->user->generate_private_key($order['to_id']);         
if ($client->confirm($seller_private_key, $transaction_id, $unit_prices)) {

                $this->db->update('orders', array('paied' => 1, 'tid' => $transaction_id), "orders.id = $order_id");
                $order['paied'] = 1;
            }
        }


        //Check if paied associate records
        if ( ($order['paied'] == 0 && $order['cod'] == 1) OR ($order['paied'] == 1) ) {
			
            foreach ($order['items'] as $item) {
                if ($item['coupon'] == 1){
	                $qty = $item['quantity'];
	                //Check number of reserved records for this order
	                $records_count = $this->db->query_value("SELECT COUNT(*) FROM items_records WHERE order_id = '$order_id' AND item_id = '{$item['item_id']}'");
	               
	                //If number of reserved records less than quantity for this item try to reserve them
	                if ($qty > $records_count) {
	                   
	                    for ($i = $records_count; $i < $qty; $i++) {
	                        /** IF item has records buy free one for me * */
	                        $record = $this->db->select_record("items_records", "item_id = '{$item['item_id']}' AND account_id = 0");
	
	                        if ($record) {
	                            $this->db->update("items_records", array('account_id' => $order['from_id'], 'order_id' => $order_id), "id = '{$record['id']}'");
	                        }
	                    }
	                }
                }
                /** End records * */
            }

            $order['items'] = $this->db->select('order_itemes', "order_itemes.order_id = '{$order['id']}'", false, false, false, false, $join_fields_item, $join_sql_item);
            //Loop to put keys
            foreach($order['items'] as $key=>$item){
                $item_records = $this->db->select ("items_records","order_id = '$order_id' AND item_id = '{$item['item_id']}'");
                $item_rec[$key]= $item;
                $item_rec[$key]['records']= $item_records;
                
            }
            $order['items']= $item_rec;
            
        }



        /** END CHECK * */
        return $order;
    }

    public function getOrders($count = false, $page_no = false, $user_id = false, $type = false, $filter = false) {

        if ($user_id && !$type)
            $sql = " (orders.from_id = '$user_id')";

        if ($user_id && $type)
            $sql = " (orders.to_id = '$user_id')";

        $join_sql = "INNER JOIN accounts A ON orders.from_id = A.id
                     INNER JOIN accounts B on orders.to_id = B.id
                     LEFT JOIN items_records ON items_records.order_id = orders.id ";

        $join_fields = "A.title as from_title,A.firstname as from_firstname,A.lastname AS from_lastname,A.mobile as from_mobile,A.email AS from_email,
                        B.id as to_id,B.title as to_title,B.firstname as to_firstname,B.lastname AS to_lastname,B.mobile as to_mobile,B.email AS to_email";


        if ($filter['email']) {
            if ($sql)
                $sql.= ' AND';

            if ($filter['type'] == 'buyer')
                $sql .= "A.email = '{$filter['email']}' OR A.mobile = '{$filter['email']}'";
            else
                $sql .= "B.email = '{$filter['email']}' OR B.mobile = '{$filter['email']}'";
        }
        
        if($filter['keyword'] && $filter['keyword'] != l('id/name/email/key/mobile/tid')){
            $kw = trim ($filter['keyword']);  
            if ($sql)
                $sql.= ' AND';
             
            if ($user_id && !$type)
            $sql .= " (B.firstname LIKE '%$kw%' OR B.firstname LIKE '$kw' OR B.mobile = '$kw' OR B.email= '$kw' OR items_records.rec1= '$kw' OR items_records.rec2= '$kw' OR orders.tid = '$kw' OR orders.id='$kw')";
            
            if ($user_id && $type) 
                             $sql .= " (A.firstname LIKE '%$kw%' OR A.mobile = '$kw' OR A.firstname LIKE '$kw' OR A.email= '$kw' OR items_records.rec1= '$kw' OR items_records.rec2= '$kw' OR orders.tid = '$kw' OR orders.id='$kw')";

        }
        
        $orders = $this->db->select('orders', (($sql) ? $sql : ' 1 = 1 ').' GROUP BY orders.id ', false, false, 'datetime1 DESC', limit($count, $page_no, true), $join_fields, $join_sql);

        if ($orders)
            foreach ($orders as $order) {
                $order['items'] = $this->db->select('order_itemes', "order_id = '{$order['id']}'");
                /** Git amount * */
                $unit_prices = 0;
                if ($order['items'])
                    foreach ($order['items'] as $itm) {
                        $unit_prices = $unit_prices + ($itm['quantity'] * $itm['item_price']) + $itm['shipping_price'];
                    }

                $order['amount'] = $unit_prices;

                $new_orders[] = $order;
            }
        
        $this->orders_item_count = $this->db->query_value("SELECT COUNT(*) FROM orders " . $join_sql . (($sql) ? ' WHERE ' . $sql : '' ));

        return $new_orders;
    }
    
    

    public function getOrdersCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM orders");
    }

    public function getDropRequests($count = false, $page_no = false, $user_id = false, $type = false) {

        if ($user_id && !$type)
            $sql = " (drop_requests.account_id = '$user_id')";

        if ($user_id && $type)
            $sql = " (items.account_id = '$user_id')";

        $join_sql = "INNER JOIN items ON items.id = drop_requests.item_id
                     INNER JOIN accounts A ON drop_requests.account_id = A.id
                     INNER JOIN accounts B on items.account_id = B.id";

        $join_fields = "items.title as item_title,items.id as item_id,
                        A.title as from_title,A.firstname as from_firstname,A.lastname AS from_lastname,A.mobile as from_mobile,A.email AS from_email,
                        B.id as to_id,B.title as to_title,B.firstname as to_firstname,B.lastname AS to_lastname,B.mobile as to_mobile,B.email AS to_email";

        $drop_requests = $this->db->select('drop_requests', $sql, false, false, 'datetime1 DESC', false, $join_fields, $join_sql);


        return $drop_requests;
    }

    /** Get Count* */
    public function getDropRequestsCount($user_id = false, $type = false) {

        $sql = "SELECT COUNT(*) FROM drop_requests";

        $sql .= " INNER JOIN items ON items.id = drop_requests.item_id
                     INNER JOIN accounts A ON drop_requests.account_id = A.id
                     INNER JOIN accounts B on items.account_id = B.id";

        if ($user_id && !$type)
            $sqlw = " (drop_requests.account_id = '$user_id')";

        if ($user_id && $type)
            $sqlw = " (items.account_id = '$user_id')";

        if ($sqlw)
            $sql .= ' WHERE (drop_requests.approved = 0) AND ' . $sqlw;

        return $this->db->query_value($sql);
    }

    /**
     * edit request
     * @param type $id
     * @param type $user_id
     * @param type $status
     * @param type $price 
     */
    public function editRequest($id, $user_id, $status, $price = false) {
        $join_sql = "INNER JOIN items ON items.id = drop_requests.item_id
                     INNER JOIN accounts A ON items.account_id = A.id
                     LEFT JOIN accounts B on drop_requests.account_id = B.id";
        $join_fields = 'A.firstname,A.email,B.firstname as ffirstname,B.email as femail';

        $sql = "drop_requests.id = $id AND A.id = '$user_id' AND drop_requests.approved = 0 ";
        $my_drop = $this->db->select_record('drop_requests', $sql, false, false, 'datetime1 DESC', false, $join_fields, $join_sql);

        if (!$my_drop)
            return false;

        $data['approved'] = $status;
        if ($price)
            $data['dop_value'] = $price;



        //email
        global $email_data;
        $email_data['firstname'] = $my_drop['ffirstname'];
        $email_data['item_id'] = $my_drop['item_id'];

        if ($status == 1 && !$price) {
            $email_data['message'] = ' has been accepted';
        } elseif ($status == 1 && $price) {
            $email_data['message'] = ' has been change price to ' . $price;
        } else {
            $email_data['message'] = ' has been rejected !';
        }

        $subject = "Drop request status";
        $message = render('views/items/email_drop_status.php');

        // echo $my_drop['femail'];exit;
        AmazonEmail($my_drop['femail'], $subject, $message);
        return $this->db->update('drop_requests', $data, "id = '$id'");
    }

    public function addCost($data) {
        return $this->db->insert('shipping_cost', $data);
    }

    public function updateCost($id, $data) {
        $id = intval($id);
        return $this->db->update('shipping_cost', $data, "id = '$id'");
    }

    public function deleteCost($id) {
        $id = intval($id);
        return $this->db->delete('shipping_cost', "id = '$id'");
    }

    public function getAllCost($count = false, $page_no = false) {
        $join_sql = "INNER JOIN cities A ON A.id = shipping_cost.from_city 
                     INNER JOIN cities B ON B.id = shipping_cost.to_city 
                     INNER JOIN countries AA ON AA.code = A.country
                     INNER JOIN countries BB ON BB.code = B.country";

        $join_fields = "A.title_en as from_city,B.title_en as to_city,AA.title_en as from_country,BB.title_en as to_country";

        return $this->db->select('shipping_cost', false, false, false, 'id DESC', limit($count, $page_no, true), $join_fields, $join_sql);
    }

    public function getCost($id) {
        $id = intval($id);
        $join_sql = "INNER JOIN cities A ON A.id = shipping_cost.from_city 
                     INNER JOIN cities B ON B.id = shipping_cost.to_city 
                     INNER JOIN countries AA ON AA.code = A.country
                     INNER JOIN countries BB ON BB.code = B.country";
        $join_fields = "A.id as f_city,B.id as t_city,AA.code as f_country,BB.code as t_country";
        return $this->db->select_record('shipping_cost', "shipping_cost.id = '$id'", false, false, false, false, $join_fields, $join_sql);
    }

    public function getAllCostCount() {
        $sql = "SELECT COUNT(*) FROM shipping_cost";
        return $this->db->query_value($sql);
    }

    public function addAds($data) {
        $ad = $this->getAds();
        if ($ad) {
            $this->db->update('ads', $data, "id = '{$ad['id']}'");
        } else {
            $this->db->insert('ads', $data);
        }
    }

    public function getAds() {
        return $this->db->select_record('ads', false, false, false, false, " 1");
    }

    public function delAd($id) {
        if (!in_array($id, array(1, 2, 3)))
            return false;
        $ad = $this->getAds();
        $this->db->update('ads', array("img$id" => "", "url$id" => ""), "id = '{$ad['id']}'");
    }

    public function promoteItem($id, $p) {
        if (!in_array($p, array(0, 1)))
            return false;
        return $this->db->update('items', array('promoted' => $p), "id ='{$id}'");
    }

}

?>
