<?php

interface imessages {
    
    const ERR_ALPHA_NUM = -41;
    const ERR_STORE_EXIST = -42;
    /**
     * Send new Message 
     */
    public function sendMessage($data);
    public function sendReply($data);
    
    /**
     * get all messages
     * @param type $count
     * @param type $page_no
     * @param type $filter
     * @return type 
     */
    public function getReceivedMessages($count, $page_no, $filter = false, $account_id = false);
    
    public function getSentMessages($count, $page_no, $filter = false, $account_id = false);
    
    public function getCountUnreadMessages();
    
    public function getMessage($message_id);
    
    public function getReplies($message_id);
    
}
?>
