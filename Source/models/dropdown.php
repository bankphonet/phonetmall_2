<?php

class DropDown {

    function __construct(Cdb $db) {
        $this->db = $db;
    }

    /** Get Countries For Admin * */
    public function getCountries($count = false, $page_no = false) {
        global $local;
        $custom_select = "title_$local as title";
        return $this->db->select('countries', false, false, $custom_select, "title ASC", limit($count, $page_no, true));
    }

    public function getCountriesCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM countries");
    }

    public function getCountry($code) {
        return $this->db->select_record("countries", "code='{$code}'");
    }

    public function updateCountry($code, $data) {
        return $this->db->update("countries", $data, "code = '$code'");
    }

    public function addCountry($data) {
        return $this->db->insert("countries", $data);
    }

    public function deleteCountry($code) {
        return $this->db->delete("countries", "code = '$code'");
    }

    public function getCities($id = false, $count = false, $page_no = false) {
        global $local;
        $custom_select = "title_$local as title,id";
        if ($id)
            $sql = "country ='$id'";
        return $this->db->select('cities', $sql, false, $custom_select, 'title ASC', limit($count, $page_no, true));
    }

    public function getCitiesCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM cities");
    }

    public function getCity($code) {
        return $this->db->select_record("cities", "id='{$code}'");
    }

    public function updateCity($code, $data) {
        return $this->db->update("cities", $data, "id = '$code'");
    }

    public function addCity($data) {
        return $this->db->insert("cities", $data);
    }

    public function deleteCity($code) {
        return $this->db->delete("cities", "id = '$code'");
    }

    
    
    public function getAreas($id=false) {
        global $local;
        $custom_select = "title_$local as title,id";
        if ($id)
            $sql = "city_id ='$id'";
        
        return $this->db->select('areas', $sql, false, $custom_select, 'title ASC',limit($count, $page_no, true));
    }

     public function getAreasCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM areas");
    }

    public function getArea($code) {
        return $this->db->select_record("areas", "id='{$code}'");
    }

    public function updateArea($code, $data) {
        return $this->db->update("areas", $data, "id = '$code'");
    }

    public function addArea($data) {
        return $this->db->insert("areas", $data);
    }

    public function deleteArea($code) {
        return $this->db->delete("areas", "id = '$code'");
    }
    
    
    
    /**
     * return all categories (Main) 
     */
    public function getCategories($count = false,$page_no =false) {
        global $local;
        $custom_select = "title_$local as title,id";
       
        
            $sql = "main_category ='0'";
        
        
        return $this->db->select('categories', $sql, false, $custom_select, 'title ASC',limit($count, $page_no, true));
    }
    
    
     public function getCategoriesCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM categories WHERE main_category=0 ");
    }

    public function getCategory($code) {
        return $this->db->select_record("categories", "id='{$code}'");
    }

    public function updateCategory($code, $data) {
        return $this->db->update("categories", $data, "id = '$code'");
    }

    public function addCategory($data) {
        return $this->db->insert("categories", $data);
    }

    public function deleteCategory($code) {
        return $this->db->delete("categories", "id = '$code'");
    }

    /**
     * get subcategories
     * @global string $local
     * @param integer $id
     * @return mixed 
     */
   
    
    
    /**
     * return all categories (Main) 
     */
    public function getSubCategories($count = false,$page_no =false) {
        global $local;
        $custom_select = "title_$local as title,id";
       
        
            $sql = "main_category !='0'";
        
        
        return $this->db->select('categories', $sql, false, $custom_select, 'title ASC',limit($count, $page_no, true));
    }
    
    
     public function getSubCategoriesCount() {
        return $this->db->query_value("SELECT COUNT(*) FROM categories WHERE main_category!=0 ");
    }

    public function getSubCategory($code) {
        return $this->db->select_record("categories", "id='{$code}'");
    }

    public function updateSubCategory($code, $data) {
        return $this->db->update("categories", $data, "id = '$code'");
    }

    public function addSubCategory($data) {
        return $this->db->insert("categories", $data);
    }

    public function deleteSubCategory($code) {
        return $this->db->delete("categories", "id = '$code'");
    }

}

?>
