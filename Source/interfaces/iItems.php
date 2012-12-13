<?php
interface iItems {
    
    const ERR_CART_SAME_STORE = -33;
    
    const ERR_NOT_EXIST = -34;
    
    
    const ERR_FULL_RECORD = -35;
    
    const ERR_PAIED_RECORD = -36;
    /**
     * add new item 
     * @param type mixed $data
     * @param type integer $account_id
     */
    public function addItem($data,$account_id = FALSE);

    /**
     * Edit item
     * @param integer $id
     * @param array $data 
     */
    public function editItem ($id,$data);
    
    /**
     *delete item
     * @param integer $id 
     */
    public function deleteItem($id);
    
    /**
     * Get item by id
     * @param integer $id 
     */
    public function getItem ($id);
    
    
    /**
     * Get all items
     * @param integer $count 
     */
    public function getItems ($count, $page_no, $filter = false, $store_id = false, $account_id = false, $myitems = false, $fav_items = false);
    
    
    /**
     * Add item to favorite
     * @param type $account_id
     * @param type $item_id
     * @return type 
     */
    public function addToFavorite($account_id, $item_id);
    
    
    
    /**
     * remove from favorites
     * @param type $account_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeFromFavorite($account_id, $item_id);
    
    
    /**
     * request drop
     * @param type $account_id
     * @param type $item_id
     * @param type $drop_price
     * @return type 
     */
    public function requestDrop($account_id, $item_id, $drop_price);
    
    
    /**
     * Get my current opening shoping cart
     * @param type $account_id
     * @return type 
     */
    public function getCart($account_id);
    
    
    /**
     *get my cart items
     * @global type $local
     * @param type $cart_id
     * @return type 
     */
    public function getCartItems($cart_id);
    
    /**
     *Get cart items count
     * @param type $cart_id
     * @return type 
     */
    public function getCartItemsCount ($cart_id);
    
    
    /**
     * Add item to shopping cart
     * @param type $account_id
     * @param type $item_id 
     */
    public function addItemToCart($account_id, $item_id, $quantity = false);
    
    
    /**
     * 
     * @param type $cart_id
     * @param type $item_id
     * @return boolean 
     */
    public function removeCartItem ($cart_id,$item_id);
    
}
?>
