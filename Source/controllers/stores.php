<?php

/** Stores Controler * */
// if i logged and didn't verify my mobile
if ((!empty($oUser->id) && $oUser->mobile_verified == 0) && ($page != 'verify' && $action != 'logout')) {
    $notify_msg = l('Please verify your mobile number so you can use your account');
    save_session_messages();
    go_to('?page=verify');
}


if ($page == 'default') {

    $page_no = ifempty($_GET['page-no'], 1);
    $stores = $oStores->getStores(LIST_COUNT, $page_no, $_GET, $oUser->id);

    $categories = $oStores->getCategories();
    $countries = $oUser->countries_get();

    $count = $oStores->stores_count;

    $pages_count = ceil($count / LIST_COUNT);
    $inner_page = "views/stores/stores.php";
    include $master_page;
}


if ($page == 'store-form') {

    if (!$oUser->id) {
        $error_msg = l('You Must log in to add store !');
        save_session_messages();
        go_to('?page=login&ref=' . urlencode(BASE_URL . '?con=stores&page=store-form'));
    }
    /** Store id * */
    $id = empty2false($_GET['id']);
    $user_id = empty2false($_GET['user']);

    if ($_POST) {

        if ($user_id && $oUser->admin == 1)
            $_POST['account_id'] = $user_id;
        else
            $_POST['account_id'] = $oUser->id; //User id



        if ($oUser->admin != 1) {
            unset($_POST['trusted']);
        } else {
            if (!$_POST['trusted'])
                $_POST['trusted'] = 0;
        }


        //Upload cover and store image
        //Upload cover
        if ($_FILES['cover_photo']['name']) {
            if (is_image_ext($_FILES['cover_photo']['name'])) {

                // upload and save
                $cover_image = upload($_FILES['cover_photo'], "uploads/stores/" . $_POST['account_id'] . '/', time() . '_' . $_FILES['cover_photo']['name']);
            }
        }

        //upload profile
        if ($_FILES['profile_photo']['name']) {
            if (is_image_ext($_FILES['profile_photo']['name'])) {

                // upload and save
                $profile_image = upload($_FILES['profile_photo'], "uploads/stores/" . $_POST['account_id'] . '/', time() . '_' . $_FILES['profile_photo']['name']);
            }
        }

        if ($cover_image)
            $_POST['cover_photo'] = $cover_image;
        if ($profile_image)
            $_POST['profile_photo'] = $profile_image;






        if (!$id) {
            $addstore = $oStores->addStore($_POST);
            if ($addstore < 0) {
                $error_msg = l($oError->message($addstore));
            } else {
                $notify_msg = l('Store added successfully !');
                save_session_messages();
                go_to('?con=stores');
            }
        } else {
            $editstore = $oStores->editStore($id, $_POST);

            if ($editstore < 0) {
                $error_msg = l($oError->message($editstore));
            } else {
                $notify_msg = l('Store modefied successfully !');
                save_session_messages();
                go_to('?con=stores');
            }
        }
    }

    $categories = $oStores->getCategories();
    $countries = $oUser->countries_get();

    if ($id) {
        $store = $oStores->getStore($id, $oUser->id);

        //Offline load data if in edit mode
        if ($store) {
            /** TODO
             * Check if iam admin or owner of store to contenue editing it ! 
             */
            if ($store['account_id'] != $oUser->id && $oUser->admin == 0) {
                $error_msg = l('You can not edit others stores');
                save_session_messages();
                go_to();
            }

            $subcategories = $oStores->getSubCategory($store['category_id']);
            $cities = $oUser->getCities($store['country_code']);
            $areas = $oUser->getAreas($store['city_id']);
        } else {
            $error_msg = l('There are no store with this id');
            save_session_messages();
            go_to('?con=stores');
        }
    }

    $inner_page = 'views/stores/store-form.php';
    include $master_page;
}


if ($page == 'store') {
    $id = empty2false($_GET['id']);
   
    if ($id)
        $store = $oStores->getStore($id, $oUser->id);

    if ($store) {
        $page_no = ifempty($_GET['page-no'], 1);
        if($_GET['keyword'])
        	$items =$oItems->getItems(LIST_COUNT, $page_no, $_GET,$id ,$oUser->id);
        else
        	$items = $oItems->getItems(12, $page_no, false, $id, $oUser->id);
        
        $pages_count = ceil($oItems->items_count / 12);
    }

    $page_title = $store['title'];
    $meta_tag['stores']['store']['description'] = substr($store['description'], 0, 150);
    $inner_page = 'views/stores/store-view.php';
    include $master_page;
    return;
}


if ($page == 'store-map') {

    $id = empty2false($_GET['id']);
    if ($id)
        $store = $oStores->getStore($id);

    include 'views/stores/store-map.php';
}


if ($action == 'add-to-favorite') {
    if (!$oUser->id)
        return false;

    $id = empty2false($_GET['id']);

    if (!$id)
        return false;

    $oStores->addToFavorite($oUser->id, $id);

    echo 1;
}


if ($action == 'remove-from-favorite') {
    if (!$oUser->id)
        return false;

    $id = empty2false($_GET['id']);

    if (!$id)
        return false;

    $oStores->removeFromFavorite($oUser->id, $id);

    echo 1;
}


if ($page == 'mystore') {
    if (!$oUser->id)
        go_to();

    $page_no = ifempty($_GET['page-no'], 1);
    $stores = $oStores->getStores(LIST_COUNT, $page_no, false, $oUser->id, true);

    $count = $oStores->stores_count;
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = 'views/stores/mystore.php';
    include $master_page;
}



if ($page == 'favoritestores') {
    if (!$oUser->id)
        go_to();

    $page_no = ifempty($_GET['page-no'], 1);
    $stores = $oStores->getStores(LIST_COUNT, $page_no, false, $oUser->id, false, true);

    $count = $oStores->stores_count;
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = 'views/stores/favoritestores.php';
    include $master_page;
}
?>
