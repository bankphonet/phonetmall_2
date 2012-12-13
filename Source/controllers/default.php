<?php


//if i logged and didn't verify my mobile
if ((!empty($oUser->id) && $oUser->mobile_verified == 0) && ($page != 'verify' && $action != 'logout')) {
    $notify_msg = l('Please verify your mobile number so you can use your account');
    save_session_messages();
    go_to('?page=verify');
}

$master_page = "views/master.php";


if ($page == 'default') {

//echo LIST_COUNT;exit;

    $page_no = ifempty($_GET['page-no'], 1);
    
    $items = $oItems->getItems(LIST_COUNT, $page_no, $_GET, false, $oUser->id);
    $stores = $oStores->getStores(LIST_COUNT, $page_no, $_GET, $oUser->id);

    $count = $oItems->items_count;
    $pages_count = ceil($count / LIST_COUNT);

    
    

    $inner_page = "views/home/default.php";
    include $master_page;
}

// Messaging Router //
if ($page == 'sendreply') {
	$parent_id = $oMessages->sendReply($_POST);
	$message = $oMessages->getMessage($parent_id);
	$replies = $oMessages->getReplies($parent_id);
	$inner_page = 'views/messages/message-view.php';
	include $master_page;
}
if ($page == 'sendmessageajax') {
	$message_id = $oMessages->sendMessage($_POST);
	echo $message_id;
}
if ($page == 'readmessage') {
	$message = $oMessages->getMessage($_GET['id']);
	$replies = $oMessages->getReplies($_GET['id']);
	//echo '<pre>';var_dump($message);exit;
	$inner_page = 'views/messages/message-view.php';
	include $master_page;
}
if ($page == 'inbox') {
	$messages = $oMessages->getReceivedMessages($count, $page_no);
	$inner_page = 'views/messages/inbox.php';
	include $master_page;
}
if ($page == 'outbox') {
	$messages = $oMessages->getSentMessages($count, $page_no);
	$inner_page = 'views/messages/outbox.php';
	include $master_page;
}
// End of Messaging Router //

if ($page == 'register') {

    if ($_POST) {
        $register = $oUser->register($_POST);
        if ($register < 0) {
            $error_msg = l($oError->message($register));
        } else {
            $notify_msg = l('Thank you, your account is ready');
            save_session_messages();
            go_to();
        }
    }


    $countries = $oUser->countries_get();
    $inner_page = 'views/accounts/register.php';
    include $master_page;
}


if ($page == 'login') {



    if ($_POST) {
        $login = $oUser->authenticate($_POST['email'], $_POST['password'], $_POST['remember_me']);

        if ($login < 0) {
            $error_msg = l($oError->message($login));
           
        } else {

            save_session_messages();
            if (empty2false($_GET['ref']))
                go_to(urldecode($_GET['ref']));
            else
                go_to();
        }
    }


    $inner_page = 'views/accounts/login.php';
    include $master_page;
}



if ($page == 'forget-password') {


    if ($_POST) {
        $change_password = $oUser->resetPassword($_POST['email']);

        if ($change_password < 0) {
            $error_msg = l($oError->message($change_password));
        } else {
            $notify_msg = l('Your password was changed and sent to you');
            save_session_messages();
            go_to();
        }
    }

    $inner_page = 'views/accounts/forget-password.php';
    include $master_page;
}



if ($page == 'verify') {


    if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }

    if ($oUser->mobile_verified == 1) {
        $notify_msg = l('You have been verified your mobile');
        save_session_messages();
        go_to();
    }

    if ($_POST) {
        $notify_msg = ''; //Clear notify
        $verify = $oUser->verify_mobile($oUser->id, $_POST['code']);
        if ($verify != 1)
            $error_msg = l($oError->message($verify));
        else {
            $notify_msg = l("Your mobile has been verified");
            save_session_messages();
            go_to();
        }
    }


    $inner_page = 'views/accounts/verify_mobile.php';
    include $master_page;
}



if ($page == 'search') {

    $categories = $oStores->getCategories();
    $countries = $oUser->countries_get();

    $inner_page = 'views/stores/search.php';
    include $master_page;
}


if ($page == 'my-cart') {
    $id = empty2false($_GET['id']);


    if (!$oUser->id) {
        $error_msg = l("You have to login first");
        save_session_messages();
        go_to('?page=login&ref=' . urlencode(BASE_URL . '?page=my-cart&id=' . $id));
    }


    if ($id) {
        $add_to_cart = $oItems->addItemToCart($oUser->id, $id);
        if ($add_to_cart < 0)
            $error_msg = l($oError->message($add_to_cart));
        else
       		 $notify_msg= ('   In case of owner shipping we are not responsible for delivery or refund so make sure that you trust the seller as the money will be transfred to his account and can not be refunded by us!');
    }

    /** Set to country , city **/
     $city_id = empty2false($_GET['city_id']);
    $countries_row = $oUser->countries_get();
    $countries = generate_select_options($countries_row, 'title', 'code',$_GET['country']);
    if($city_id)
    {
      $cities = $oUser->getCities ($_GET['country']);
      $cities = generate_select_options($cities, 'title', 'id',$city_id);
      
    }
    
    $my_cart = $oItems->getCart($oUser->id);
    if ($my_cart)
        $items = $oItems->getCartItems($my_cart['id'], $oUser->id,$city_id);

    
   
    //Flag to replace add to cart to remove from cart
    $remove_link = true;
    
   
    $inner_page = 'views/cart/shoppingcart.php';
    include $master_page;
}



if ($action == 'remove-from-cart') {
      if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    
    $id = empty2false($_GET['id']);
    if ($id) {
        $my_cart = $oItems->getCart($oUser->id);
        $remove = $oItems->removeCartItem($my_cart['id'], $id);
        if ($remove)
            $notify_msg = l('Item was removed from your cart !');
    }

    save_session_messages();
    go_to('?page=my-cart');
}


if ($action == 'update-cart') {
      if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    
    $itemid = empty2false($_GET['itemid']);
    if ($itemid) {
        $qty = ifempty($_GET['qty'], 1);

        $my_cart = $oItems->getCart($oUser->id);
        $update = $oItems->updateCartItem($my_cart['id'], $itemid, $qty);
        if ($update)
            $notify_msg = l('Your cart was updated !');
    }

    save_session_messages();
    go_to('?page=my-cart&country='.$_GET['country'].'&city_id='.$_GET['city_id']);
}

/** Orders Page * */
if ($page == 'orders') {
  if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    
    $type = empty2false($_GET['type']);
    $page_no = ifempty($_GET['page-no'], 1);

    $orders = $oItems->getOrders (LIST_COUNT, $page_no, $oUser->id, $type,$_GET);
    $count = $oItems->orders_item_count;
    $pages_count = ceil ($count / LIST_COUNT);

    $inner_page = 'views/cart/orders.php';
    include $master_page;
}

if ($page == 'createorder') {
    if (!$oUser->id)
        go_to();
    
    if ($_POST) {
        $user = $oUser->get_user_by_id($_POST['account_id']);
        if ($user > 0) {
            $order = $oItems->closeOrder($oUser->id,$_POST);
            $public_key = $oUser->generate_public_key($_POST['account_id']);
            if($_POST['cod'])
            	$url = '?page=orderdetails&id=' . $order;
            else
            	$url = ORDER_LINK . '?page=order&pk=' . urlencode($public_key) . '&am=' . $_POST['total_price'] .'&shp='.$_POST['shipping']. '&gb=' . urlencode(BASE_URL . '?page=orderdetails&id=' . $order);
			
            go_to($url);
        } else {
            $error_msg = l($oError->message($user));
            save_session_messages();
            go_to();
        }
    }
}




/** Orders Page * */
if ($page == 'orderdetails') {
      if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login&ref='.getUrl());
    }
    
    
    if ($oUser->admin == 1)
        $master_page = "views/admin/master.php";
    
    $id = empty2false($_GET['id']);
    $tid = empty2false($_GET['tid']);
    $order = $oItems->getOrderDetails ($id, (($oUser->admin == 1) ? false : $oUser->id), $tid);
//echo'<pre>';var_dump($order);exit;
    $inner_page = 'views/cart/order-details.php';
    include $master_page;
}


if ($page == 'droprequests') {


	if(!$oUser->id)
	 go_to();

    $type = empty2false($_GET['type']);
    $page_no = empty2false($_GET['page-no']);

    if ($_POST) {
        $oItems->editRequest($_POST['req_id'], $oUser->id, 1, $_POST['price']);
        $notify_msg = l('This drop request was changed and accepted');
        save_session_messages();
        go_to('?page=droprequests&type=in');
    }

    $drop_requests = $oItems->getDropRequests(LIST_COUNT, $page_no, $oUser->id, $type);

    $count = $oItems->getDropRequestsCount($oUser->id, $type);
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/items/droprequests.php";
    include $master_page;
}


if ($action == 'acceptrequest') {
  if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    
    $oItems->editRequest ($_GET['id'], $oUser->id, 1);
    $notify_msg = l('This drop request was accepted');
    save_session_messages();
    go_to('?page=droprequests&type=in');
}

if ($action == 'rejectrequest') {
      if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    
    $oItems->editRequest($_GET['id'], $oUser->id, 2);
    $notify_msg = l('This drop request was rejected');
    save_session_messages();
    go_to('?page=droprequests&type=in');
}


if ($action == 'changeprice') {
  if (!$oUser->id) {
        $error_msg = l('You have to login first');
        save_session_messages();
        go_to('?page=login');
    }
    include 'views/items/popup-change-price.php';
}

/** Logout action * */
if ($action == 'logout') {
    $oUser->logout();
    go_to();
}


if($page=='mypub')
{
	echo $oUser-> generate_public_key ($oUser->id);
}
