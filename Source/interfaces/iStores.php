<?php

interface istores {
    
    const ERR_ALPHA_NUM = -41;
    const ERR_STORE_EXIST = -42;
    /**
     * Add new Store 
     */
    public function addStore($data);
    
    
    /**
     * Edit Store 
     * @param integer $id
     */
    public function editStore($id, $data);
    
    /**
     * get one store
     * @param integer $id 
     */
    public function getStore($id);
    
    /**
     * get all stores
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type 
     */
    public function getStores($count, $page_no, $filter = false, $account_id = false, $mystores = false, $fav_store = false);
    
    /**
     * get all categorise 
     */
    public function getCategories();
    
    
    /**
     * Get one category 
     * @param integer $id
     */
    public function getSubCategory($id);
    
    /**
     * Add item to favorite
     * @param type $account_id
     * @param type $item_id
     * @return type 
     */
    public function addToFavorite($account_id, $store_id) ;
    
    
    /**
     * remove from favorites
     * @param type $account_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeFromFavorite($account_id, $store_id);
    
    
    
}
?>
