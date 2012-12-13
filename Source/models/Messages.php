<?php

include __DIR__ . "/../interfaces/iMessages.php";

class messages implements imessages {

    private $db = null;

    /** Store stores count * */
    public $messages_count = null;

    function __construct(Cdb $db) {
        $this->db = $db;
    }

    /**
     * send new message !
     * @param type $data 
     */
    public function sendMessage($data) {
        $user_id = $_SESSION['phonetmall_id'];
        
        $select_type = "SELECT type_id FROM types WHERE type_name LIKE '{$data['type']}'";
		$select_receiver = "SELECT account_id FROM {$data['type']}s WHERE id='{$data['id']}'";
		
        $type = $this->db->query($select_type);
        $receiver = $this->db->query($select_receiver);
        
        $message_id = $this->db->insert('messages', array('sender_id'=>$user_id, 'type_id'=>$type[0]['type_id'], 'item_store_id'=>$data['id'], 'receiver_id'=>$receiver[0]['account_id'], 'subject'=>$data['subject'], 'message'=>$data['message']));
		
        return $message_id;
    }
    
    /**
     * send reply message !
     * @param type $data
     */
    public function sendReply($data) {
    	$user_id = $_SESSION['phonetmall_id'];
		
    	$select_type = "SELECT type_id FROM types WHERE type_name LIKE '{$data['type']}'";
    	$select_receiver = "SELECT sender_id, receiver_id FROM messages WHERE message_id='{$data['parent_id']}'";
		
    	$type = $this->db->query($select_type);
    	$receiver = $this->db->query($select_receiver);
    	
    	$notified_user = ($receiver[0]['sender_id'] == $user_id) ? $receiver[0]['receiver_id'] : $user_id;
    	
    	$message_id = $this->db->insert('messages', array('sender_id'=>$user_id, 'type_id'=>$type[0]['type_id'], 'item_store_id'=>$data['id'], 'receiver_id'=>$notified_user, 'subject'=>$data['subject'], 'message'=>$data['message'], 'parent_id'=>$data['parent_id']));
    	return $data['parent_id'];
    }
    
    /**
     * get all messages
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type 
     */
    public function getReceivedMessages($count, $page_no, $filter=false, $account_id = false) {
        global $local;
        $user_id = $_SESSION['phonetmall_id'];
        $join_fields = "SELECT messages.* , accounts.* , types.* , 
    				 	items.id AS item_id , items.title AS item_title ,  
    					stores.id AS store_id , stores.title AS store_title 
    					FROM messages ";

        $join_sql = "INNER JOIN accounts ON accounts.id = messages.sender_id 
        			 INNER JOIN types ON types.type_id = messages.type_id 
        			 LEFT JOIN items ON items.id = messages.item_store_id AND types.type_name LIKE 'item'  
        			 LEFT JOIN stores ON stores.id = messages.item_store_id  AND types.type_name LIKE 'store' ";
        
        $criteria = "WHERE (messages.receiver_id='$user_id' ";
        $criteria .= "OR messages.sender_id='$user_id') ";
        $criteria .= "AND messages.date=(SELECT MAX(date) FROM messages WHERE (sender_id='$user_id' OR receiver_id='$user_id') ) ";
        
        $criteria .= 'GROUP BY messages.item_store_id ';

        $criteria .= "ORDER BY messages.date DESC  ";
        $criteria .= limit($count, $page_no);

        $full_sql = $join_fields . $join_sql . $criteria;
        
        //echo $full_sql;exit;
        
        $messages = $this->db->query($full_sql);
        
        //get Messages Count
        $this->stores_count = $this->db->query_value("SELECT  FOUND_ROWS() as cnt");
		
        return $messages;
    }
    /**
     * get message by id
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type
     */
    public function getMessage($message_id) {
    	global $local;
    	$join_fields = "SELECT messages.* , accounts.* , types.* , 
    				 	items.id AS item_id , items.title AS item_title ,  
    					stores.id AS store_id , stores.title AS store_title 
    					FROM messages ";
    	
    	$join_sql = "INNER JOIN accounts ON accounts.id = messages.sender_id
        			 INNER JOIN types ON types.type_id = messages.type_id
        			 LEFT JOIN items ON items.id = messages.item_store_id AND types.type_name LIKE 'item'
        			 LEFT JOIN stores ON stores.id = messages.item_store_id  AND types.type_name LIKE 'store' ";
    
    	$criteria  = "WHERE (messages.receiver_id='{$_SESSION['phonetmall_id']}' ";
    	$criteria .= "OR messages.sender_id='{$_SESSION['phonetmall_id']}') ";
    	$criteria .= "AND messages.message_id=$message_id";
    	$full_sql  = $join_fields . $join_sql . $criteria;
    
    	//echo $full_sql;exit;
    
    	$message = $this->db->query($full_sql);
    	
    	if(!$message[0]['read_flag']){
    		$this->db->update('messages', array('read_flag'=>1), "message_id=$message_id");
    	}
    	return $message[0];
    }
    
    /**
     * get replies by id
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type
     */
    public function getReplies($parent_id) {
    	global $local;
    	$join_fields = "SELECT * FROM messages ";
    
    	$join_sql = "INNER JOIN accounts ON accounts.id = messages.sender_id
        			 INNER JOIN types ON types.type_id = messages.type_id
        			 LEFT JOIN items ON items.id = messages.item_store_id AND types.type_name LIKE 'item'
        			 LEFT JOIN stores ON stores.id = messages.item_store_id  AND types.type_name LIKE 'store' ";
    
    	$criteria  = "WHERE messages.parent_id=$parent_id ";
    	$criteria .= " ORDER BY messages.date ASC  ";
    	
    	$full_sql  = $join_fields . $join_sql . $criteria;
    
    	//echo $full_sql;exit;
    	
    	$message = $this->getMessage($parent_id); 
    
    	$replies = $this->db->query($full_sql);
    	foreach ($replies as $reply){
	    	if($reply['receiver_id']==$_SESSION['phonetmall_id'] && !$reply['read_flag']){
				$this->db->update('messages', array('read_flag'=>1), "message_id={$reply['message_id']}");
	    	}
    	}
    	return $replies;
    }
    /**
     * get sent messages
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type
     */
    public function getSentMessages($count, $page_no, $filter=false, $account_id = false) {
    	global $local;
    	$join_fields = "SELECT * FROM messages ";
    
    	$join_sql = "INNER JOIN accounts ON accounts.id = messages.sender_id
        			 INNER JOIN types ON types.type_id = messages.type_id
        			 LEFT JOIN items ON items.id = messages.item_store_id AND types.type_name LIKE 'item'
        			 LEFT JOIN stores ON stores.id = messages.item_store_id  AND types.type_name LIKE 'store' ";
    
    	$criteria = "WHERE accounts.id='{$_SESSION['phonetmall_id']}'";
    
    	//$sql .= 'GROUP BY stores.id';
    
    	$criteria .= " ORDER BY messages.date DESC  ";
    	$criteria .= limit($count, $page_no);
    
    	$full_sql = $join_fields . $join_sql . $criteria;
    
    	//echo $full_sql;exit;
    
    	$messages = $this->db->query($full_sql);
    
    	//get Messages Count
    	$this->stores_count = $this->db->query_value("SELECT  FOUND_ROWS() as cnt");
    
    	return $messages;
    }
    
    public function getCountUnreadMessages(){
    	$sql = "SELECT COUNT(*) AS count FROM messages ";
    	
    	$criteria = "WHERE receiver_id='{$_SESSION['phonetmall_id']}' ";
    	$criteria .= "AND read_flag=0";
    	
    	$full_sql = $sql . $criteria;
    	
    	//echo $full_sql;exit;
    	
    	$messages = $this->db->query($full_sql);
    	
    	return $messages[0]['count'];
    }

}

?>
