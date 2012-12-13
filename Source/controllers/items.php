<?php

/** items Controler * */
//if i logged and didn't verify my mobile
if ((!empty($oUser->id) && $oUser->mobile_verified == 0) && ($page != 'verify' && $action != 'logout')) {
    $notify_msg = l('Please verify your mobile number so you can use your account');
    save_session_messages();
    go_to('?page=verify');
}




if ($page == 'default') {
   
    $page_no = ifempty($_GET['page-no'], 1);
	if($store_id){
   				 $items =$oItems->getItems(LIST_COUNT, $page_no, $_GET,$store_id , $oUser->id);
  			  	}else {
  			  	 $items =$oItems->getItems(LIST_COUNT, $page_no, $_GET, false, $oUser->id);
  			  }

    
    $count = $oItems->items_count;
    $pages_count = ceil($count / LIST_COUNT);

    $categories = $oStores->getCategories();
    $countries = $oUser->countries_get();

    $inner_page = "views/items/items.php";
    include $master_page;
}


if ($page == 'ajax') {

	$page_no = ifempty($_GET['page-no'], 1);
	$items = $oItems->getsearchitem(LIST_COUNT, $page_no, $_POST, false, $oUser->id);


	$count = $oItems->items_count;
	$pages_count = ceil($count / LIST_COUNT);

	$categories = $oStores->getCategories();
	$countries = $oUser->countries_get();

	echo json_encode($items);
}
if ($page == 'items-form') {
    if (!$oUser->id) {
        $error_msg = l('You Must log in to add item !');
        save_session_messages();
        go_to('?page=login&ref=' . urlencode(BASE_URL . '?con=items&page=items-form'));
    }

    $id = empty2false($_GET['id']);
    $user_id = empty2false($_GET['user']);

    if ($_POST) {
        
         if ($user_id && $oUser->admin == 1)
            $_POST['account_id'] = $user_id;
        else
            $_POST['account_id'] = $oUser->id; //User id
        //Upload images
        //upload Images
        if ($_FILES) {
            $files = multiple($_FILES);

            $f_names = array(); //HOLD FILE NAMES
            foreach ($files['image'] as $file) {
                //CHEK IMAGE EXTENSION
                $filename = ""; //Clear Last Name
                if (is_image_ext($file['name'])) {
                    $filename = upload($file, "uploads/items/" . $_POST['account_id'] . '/', time().'_'.$file['name']);
                    if ($filename)
                        $f_names[] = $filename;
                }
            }
        }

      
        //Check files
        if ($f_names[0])
            $_POST['image1'] = addslashes ($f_names[0]);
        if ($f_names[1])
            $_POST['image2'] = addslashes ($f_names[1]);
        if ($f_names[2])
            $_POST['image3'] = addslashes ($f_names[2]);
        if ($f_names[3])
            $_POST['image4'] = addslashes ($f_names[3]);

      

        if (!$id) {
            $oItems->addItem($_POST,$_POST['account_id']);
            $notify_msg = l('item was added successfully !');
        } else {
        	if(!isset($_POST['cod']))
        		$_POST['cod'] = $_POST['coupon'] = 0;
        	if(!isset($_POST['coupon']))
        		$_POST['coupon'] = 0;
        	
            $oItems->editItem($id, $_POST);
            $notify_msg = l('item was updated successfully !');
        }
        //TODO : GO TO ITEM PAGE
        save_session_messages();
        go_to('?con=items');
    }

    $categories = $oStores->getCategories();
    $countries = $oUser->countries_get();

    if ($id) {
        $item = $oItems->getItem($id, (($user_id) ? $user_id : $oUser->id));
        if ($item) {
             /** TODO
             * Check if iam admin or owner of store to contenue editing it ! 
             */
            if ($item['account_id'] != $oUser->id && $oUser->admin == 0) {
                $error_msg = l('You can not edit others stores');
                save_session_messages();
                go_to();
            }
            
            $subcategories = $oStores->getSubCategory($item['category_id']);
            $cities = $oUser->getCities($item['country_code']);
            $areas = $oUser->getAreas($item['city_id']);
        }
    }
    
    $inner_page = "views/items/items-form.php";
    include $master_page;
}


if ($page == 'item') {

    $id = intval ($_GET['id']);
    $id = empty2false($id);
    
    if ($id)
        $item = $oItems->getItem($id, $oUser->id);

    if ($item['store_id'])
        $store = $oStores->getStore($item['store_id']);

    
    $records = $oItems->getRecords ($id);
    
    $page_title = $item['title'];
    $meta_tag['items']['item']['description'] = substr($item['description'],0,150);
    $inner_page = 'views/items/item.php';
    include $master_page;
}


if ($action == 'add-to-favorite') {
    if (!$oUser->id)
        return false;

    $id = empty2false($_GET['id']);

    if (!$id)
        return false;

    $oItems->addToFavorite($oUser->id, $id);

    echo 1;
}


if ($action == 'remove-from-favorite') {
    if (!$oUser->id)
        return false;

    $id = empty2false($_GET['id']);

    if (!$id)
        return false;

    $oItems->removeFromFavorite($oUser->id, $id);

    echo 1;
}



if ($action == 'del-item') {
    $id = empty2false($_GET['id']);

    if (!$id) {
        $error_msg = l('Sorry there is no item with this id');
        save_session_messages();
        go_to('?con=items');
    }

    $item = $oItems->getItem($id);

    if ($item['account_id'] != $oUser->id && $oUser->admin == 0) {
        $error_msg = l('Sorry you can not delete this item !');
        save_session_messages();
        go_to('?con=items');
    }

    $oItems->deleteItem($id);
    $notify_msg = l('The selected item was deleted successfully !');
    save_session_messages();
    go_to('?con=items');
}




if ($action == 'drop-request') {

    if (!$oUser->id)
        return false;

    $id = empty2false($_GET['id']);
    if (!$id)
        return false;

    $drop_price = $_POST['dropto'];
    if (!$drop_price)
        return false;

    $oItems->requestDrop($oUser->id, $id, $drop_price);
    echo "<span class= 'successmessage'>Request Sent</span>";
}


if ($page == 'myitems') {
    if(!$oUser->id)
        go_to ();
    
    $page_no =  ifempty($_GET['page-no'], 1);
    $items = $oItems->getItems (LIST_COUNT,$page_no,false,false,$oUser->id,true );
    $count = $oItems->items_count;
    $pages_count = ceil($count/LIST_COUNT);
    
    $inner_page = 'views/items/myitems.php';
    include $master_page;
}


if($action == 'addrecord'){
    if(!$oUser->id)
        go_to ();
    
   $item_id = empty2false($_GET['id']);
   
   
    $add_rec = $oItems->addRecord ($item_id,$oUser->id,$_POST);   
    if($add_rec < 0)
        $error_msg = $oError->message ($add_rec);
    else
       $notify_msg = l('Record has ben added');
   
    
   save_session_messages();
   go_to('?con=items&page=item&id='.$item_id);
}


if($action == 'delrecord'){
    if(!$oUser->id)
        go_to ();
    
   $item_id = empty2false($_GET['id']);
   $rec_id = empty2false($_GET['rec_id']);
   
   
    $del_record = $oItems->delRecord ($item_id,$oUser->id,$rec_id);   
    if($del_record < 0)
        $error_msg = $oError->message ($del_record);
    else
       $notify_msg = l('Record has ben deleted');
   
    
   save_session_messages();
   go_to('?con=items&page=item&id='.$item_id);
}




if ($page == 'favoriteitems') {
    if(!$oUser->id)
        go_to ();
    
    $page_no =  ifempty($_GET['page-no'], 1);
    $items = $oItems->getItems (LIST_COUNT,$page_no,false,false,$oUser->id,false,true );
    $count = $oItems->items_count;
    $pages_count = ceil($count/LIST_COUNT);
    
    $inner_page = 'views/items/favoriteitems.php';
    include $master_page;
}


?>
