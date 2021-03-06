<?php

session_start();

// config file
require_once __DIR__.'/config.php';

// includes
require_once __DIR__.'/includes/common.php';
require_once __DIR__.'/includes/app_common.php';

require_once __DIR__.'/includes/db.php';
require_once __DIR__.'/includes/locals.php';
require_once __DIR__.'/includes/upload.php';
require_once __DIR__.'/includes/thumb_core.php';
require_once __DIR__.'/includes/meta_tags.php';


require_once __DIR__.'/models/User.php';
require_once __DIR__.'/models/Stores.php';
require_once __DIR__.'/models/items.php';
require_once __DIR__.'/models/dropdown.php';
require_once __DIR__.'/models/Errors.php';
require_once __DIR__.'/models/Messages.php';



// ------------------------ start --------------------------
// db
$db = Cdb::singleton();//initiate singlton class from db
$db->execute("SET time_zone = '+02:00'");


//Models
$oUser = new User($db);
$oStores = new stores($db);
$oItems = new items ($db);
$oDropdown = new DropDown ($db);
$oMessages = new messages($db);

$oError = new return_from_error ();

if($oUser->id){
    $my_drops_count = $oItems->getDropRequestsCount ($oUser->id);
    $my_indrops_count = $oItems->getDropRequestsCount ($oUser->id,1);
    $cart_count = $oItems->getCartCount ($oUser->id);
    $my_inbox_count = $oMessages->getCountUnreadMessages();
}



$ads = $oItems->getAds ();

// ------------------------ error and notification messages --------------------------
$error_msg = "";
$notify_msg = "";

if ($_SESSION['error_msg']) {
	$error_msg = $_SESSION['error_msg'];
	$_SESSION['error_msg'] = '';
}

if ($_SESSION['notify_msg']) {
	$notify_msg = $_SESSION['notify_msg'];
	$_SESSION['notify_msg'] = '';
}



// ------------------------ anti injection hacking --------------------------
clean_html ($_POST, $db);
clean_html ($_GET, $db);
clean_html ($_REQUEST, $db);









?>