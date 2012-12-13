<?php

if ($oUser->admin != 1) {
    go_to();
}

$_SESSION['local'] = 'en'; //SET LOCAL TO EN

/**
 * master page file
 */
$master_page = "views/admin/master.php";




if ($page == 'default') {



    $page_no = ifempty($_GET['page-no'], 1);
    $orders = $oItems->getOrders(LIST_COUNT, $page_no, false, false, $_GET);



    $count = $oItems->orders_item_count;

    $pages_count = ceil($count / LIST_COUNT);
    $inner_page = "views/admin/orders.php";
    include $master_page;
}






if ($page == 'accounts') {

    if ($_POST) {

        if ($_POST['set'])
            $_SESSION['account_filter'] = $_POST['email'];
        else
            unset($_SESSION['account_filter']);

        go_to('?con=admin&page=admin-accounts');
    }

    $page_no = ifempty($_GET['page-no'], 1);
    $accounts = $oUser->getAccounts($_SESSION['account_filter'], LIST_COUNT, $page_no, $_SESSION['account_order'], $_SESSION['account_dir']);

    $count = $oUser->getAccountsCount($_SESSION['account_filter']);
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/accounts.php";
    include $master_page;
}

if ($action == 'set-order') {
    $order = $_GET['order'];
    if ($_SESSION['account_dir'] == 'down')
        $_SESSION['account_dir'] = 'up';
    else
        $_SESSION['account_dir'] = 'down';


    $_SESSION['account_order'] = $order;
    go_to('?con=admin&page=admin-accounts');
}


if ($page == 'stores') {

    $page_no = ifempty($_GET['page-no'], 1);
    $stores = $oStores->getStores(LIST_COUNT, $page_no, $_GET, $oUser->id, false, false, true);



    $count = $oStores->stores_count;

    $pages_count = ceil($count / LIST_COUNT);
    $inner_page = "views/admin/stores.php";
    include $master_page;
    return;
}



if ($action == "delete-store") {
    $id = empty2false($_GET['id']);
    $del = $oStores->deleteStore($id);
    if ($del)
        $notify_msg = l("Store has been deleted !");

    save_session_messages();
    go_to('?con=admin&page=stores');
}





if ($page == 'orders') {

    $page_no = ifempty($_GET['page-no'], 1);
    $orders = $oItems->getOrders(LIST_COUNT, $page_no);



    $count = $oItems->getOrdersCount();

    $pages_count = ceil($count / LIST_COUNT);
    $inner_page = "views/admin/orders.php";
    include $master_page;
}





if ($page == 'items') {

    $page_no = ifempty($_GET['page-no'], 1);
    $items = $oItems->getItems(LIST_COUNT, $page_no, $_GET, false, false);


    $count = $oItems->items_count;
    $pages_count = ceil($count / LIST_COUNT);



    $inner_page = "views/admin/items.php";
    include $master_page;
}




/** Contry Management * */
if ($page == 'countries') {

    $page_no = ifempty($_GET['page-no'], 1);
    $countries = $oDropdown->getCountries(LIST_COUNT, $page_no);

    $count = $oDropdown->getCountriesCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/countries.php";
    include $master_page;
}



if ($ajax == "countryform") {


    $code = empty2false($_GET['code']);
    if ($_POST) {

        if ($code) {
            $oDropdown->updateCountry($code, $_POST);
            $notify_msg = l("item was updated");
        } else {
            $oDropdown->addCountry($_POST);
            $notify_msg = l("item was added");
        }

        save_session_messages();
        go_to('?con=admin&page=countries');
    }


    if ($code)
        $country = $oDropdown->getCountry($code);

    include "views/admin/popup/countriesform.php";
}

if ($action == "deletecountry") {

    $code = empty2false($_GET['code']);
    $oDropdown->deleteCountry($code);
    $notify_msg = "Item was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=countries');
}

/** Cities Management * */
if ($page == 'cities') {

    $page_no = ifempty($_GET['page-no'], 1);
    $cities = $oDropdown->getCities(false, LIST_COUNT, $page_no);

    $count = $oDropdown->getCitiesCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/cities.php";
    include $master_page;
}



if ($ajax == "cityform") {


    $code = empty2false($_GET['code']);
    if ($_POST) {

        if ($code) {
            $oDropdown->updateCity($code, $_POST);
            $notify_msg = l("item was updated");
        } else {
            $oDropdown->addCity($_POST);
            $notify_msg = l("item was added");
        }

        save_session_messages();
        go_to('?con=admin&page=cities');
    }


    if ($code)
        $city = $oDropdown->getCity($code);

    include "views/admin/popup/citiesform.php";
}

if ($action == "deletecity") {

    $code = empty2false($_GET['code']);
    $oDropdown->deleteCity($code);
    $notify_msg = "Item was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=cities');
}

/** Areas Management * */
if ($page == 'areas') {

    $page_no = ifempty($_GET['page-no'], 1);
    $areas = $oDropdown->getAreas(false, LIST_COUNT, $page_no);

    $count = $oDropdown->getAreasCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/areas.php";
    include $master_page;
}



if ($ajax == "areaform") {


    $code = empty2false($_GET['code']);
    if ($_POST) {

        if ($code) {
            $oDropdown->updateArea($code, $_POST);
            $notify_msg = l("item was updated");
        } else {
            $oDropdown->addArea($_POST);
            $notify_msg = l("item was added");
        }

        save_session_messages();
        go_to('?con=admin&page=areas');
    }


    if ($code)
        $area = $oDropdown->getArea($code);

    include "views/admin/popup/areasform.php";
}

if ($action == "deletearea") {

    $code = empty2false($_GET['code']);
    $oDropdown->deleteArea($code);
    $notify_msg = "Item was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=areas');
}


/** Categories Management * */
if ($page == 'categories') {

    $page_no = ifempty($_GET['page-no'], 1);
    $categories = $oDropdown->getCategories(LIST_COUNT, $page_no);

    $count = $oDropdown->getCategoriesCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/categories.php";
    include $master_page;
}



if ($ajax == "categoryform") {


    $code = empty2false($_GET['code']);
    if ($_POST) {

        if ($code) {
            $oDropdown->updateCategory($code, $_POST);
            $notify_msg = l("item was updated");
        } else {
            $oDropdown->addCategory($_POST);
            $notify_msg = l("item was added");
        }

        save_session_messages();
        go_to('?con=admin&page=categories');
    }


    if ($code)
        $category = $oDropdown->getCategory($code);

    include "views/admin/popup/categoryform.php";
}

if ($action == "deletecategory") {

    $code = empty2false($_GET['code']);
    $oDropdown->deleteCategory($code);
    $notify_msg = "Item was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=categories');
}


/** Sub Categories Management * */
if ($page == 'subcategories') {

    $page_no = ifempty($_GET['page-no'], 1);
    $subcategories = $oDropdown->getSubCategories(LIST_COUNT, $page_no);

    $count = $oDropdown->getSubCategoriesCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/subcategories.php";
    include $master_page;
}



if ($ajax == "subcategoryform") {


    $code = empty2false($_GET['code']);
    if ($_POST) {

        if ($code) {
            $oDropdown->updateSubCategory($code, $_POST);
            $notify_msg = l("item was updated");
        } else {
            $oDropdown->addSubCategory($_POST);
            $notify_msg = l("item was added");
        }

        save_session_messages();
        go_to('?con=admin&page=subcategories');
    }


    if ($code)
        $subcategory = $oDropdown->getSubCategory($code);

    include "views/admin/popup/subcategoryform.php";
}

if ($action == "deletesubcategory") {

    $code = empty2false($_GET['code']);
    $oDropdown->deleteSubCategory($code);
    $notify_msg = "Item was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=subcategories');
}

/** Shipping cost * */
if ($page == "shipping-cost") {
    $page_no = empty2false($_GET['page-no']);
    $all_cost = $oItems->getAllCost(LIST_COUNT, $page_no);

    $count = $oItems->getAllCostCount();
    $pages_count = ceil($count / LIST_COUNT);

    $inner_page = "views/admin/shipping-cost.php";
    include $master_page;
}


if ($ajax == "shipping-form") {
    $id = empty2false($_GET['id']);
    if ($_POST) {

        if ($id) {
            $oItems->updateCost($id, $_POST);
            $notify_msg = l("Cost was updated");
        } else {
            $oItems->addCost($_POST);
            $notify_msg = l("Cost was added");
        }

        save_session_messages();
        go_to('?con=admin&page=shipping-cost');
    }


    if ($id) {
        $cost = $oItems->getCost($id);
        $cities_row = $oUser->getCities($cost['f_country']);
        $cities_to = $oUser->getCities($cost['t_country']);
        $cities = generate_select_options($cities_row, 'title', 'id', $cost['f_city']);
        $cities2 = generate_select_options($cities_to, 'title', 'id', $cost['t_city']);
    }

    $countries_row = $oUser->countries_get();
    $countries = generate_select_options($countries_row, 'title', 'code', $cost['f_country']);
    $countries2 = generate_select_options($countries_row, 'title', 'code', $cost['t_country']);
    include "views/admin/popup/shippingform.php";
}


if ($action == "deletecost") {

    $code = empty2false($_GET['code']);
    $oItems->deleteCost($code);
    $notify_msg = "Cost was deleted successfully";
    save_session_messages();
    go_to('?con=admin&page=shipping-cost');
}





if ($page == 'ads') {

    if ($_POST) {
        if ($_FILES['img1']['name']) {
            if (is_image_ext($_FILES['img1']['name'])) {
                // upload and save
                $img1 = upload($_FILES['img1'], "uploads/ads/", time() . '_' . $_FILES['ad']['name']);
            }
        }

        if ($_FILES['img2']['name']) {
            if (is_image_ext($_FILES['img2']['name'])) {
                // upload and save
                $img2 = upload($_FILES['img2'], "uploads/ads/", time() . '_' . $_FILES['ad']['name']);
            }
        }

        if ($_FILES['img3']['name']) {
            if (is_image_ext($_FILES['img3']['name'])) {
                // upload and save
                $img3 = upload($_FILES['img3'], "uploads/ads/", time() . '_' . $_FILES['ad']['name']);
            }
        }


        if ($img1)
            $_POST['img1'] = $img1;
        if ($img2)
            $_POST['img2'] = $img2;
        if ($img3)
            $_POST['img3'] = $img3;

        $oItems->addAds($_POST);
    }

    $ads = $oItems->getAds();

    $inner_page = 'views/admin/ads.php';
    include $master_page;
}


if ($action == 'delimg') {
    $id = $_GET['id'];

    $oItems->delAd($id);
    go_to('?con=admin&page=ads');
}










if ($action == 'promote') {
    if ($oUser->admin !=1)
        go_to();

    $p = $_GET['p'];
    $item_id = $_GET['id'];
   
    $oItems->promoteItem ($item_id, $p);

    if ($p == 1)
        $notify_msg = 'Item has been promoted !';
    else
        $notify_msg = 'Item has been un-promoted !';


    save_session_messages();
    go_to('?con=admin&page=items');
}




if ($action == 'promote-store') {
    if ($oUser->admin !=1)
        go_to();

    $p = $_GET['pm'];
    $store_id = $_GET['id'];
   
    $oStores->promoteStore ($store_id, $p);

    if ($p == 1)
        $notify_msg = 'Store has been promoted !';
    else
        $notify_msg = 'Store has been un-promoted !';


    save_session_messages();
    go_to('?con=admin&page=stores');
}


if ($ajax == 'cities-list') {
    if (empty2false($_GET['id'])) {
        $cities = $oUser->getCities($_GET['id']);
        echo generate_select_options($cities, 'title', 'id');
    } else {
        echo "<option value=''>" . l('Please Chose city') . "</option>";
    }
}



       