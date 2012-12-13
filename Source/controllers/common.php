<?php


if($oUser->id){
    $my_cart = $oItems->getCart($oUser->id);
    $cart_count = $oItems->getCartItemsCount ($my_cart['id']);
}

if($ajax =='subcategory-list'){

    if(empty2false($_GET['id'])){
        $subcategories = getSubCategoriesBox ($_GET['id']);
        echo $subcategories;
    }else{
        echo "<option value=''>".l('Please Choose sub-category')."</option>";
    }
}


if($ajax == 'cities-list'){
    if(empty2false($_GET['id'])){
        $cities = getCitiesBox ($_GET['id']);
        echo $cities;
    }else{
        echo "<option value=''>".l('Please Chose city')."</option>";
    }
}


if($ajax == 'area-list'){
    if(empty2false($_GET['id'])){
        $areas = getAreasBox ($_GET['id']);
        echo $areas;
    }else{
        echo "<option value=''>".l('Please Chose area')."</option>";
    }
}

?>