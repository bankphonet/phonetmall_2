<?php

/** Calculate shipping * */
function getShipping($weight, $firstkilo, $extra, $qty) {
    $weight = $weight * $qty;
    $total_shipping = $firstkilo;
    $extra_weight = $weight - 1;
    $extra_price = $extra_weight * $extra;

    return $total_shipping + $extra_price;
}

/** Boxes * */

/** get Careers * */
function getCategoriesBox($selected = FALSE) {
    global $oStores;
    /** Select Boxes Content * */
    $categories = "<option value='' " . (($selected == '') ? 'SELECTED' : '') . ">" . l('All Categories') . "</option>";
    $categories .= generate_select_options($oStores->getCategories(), 'title', 'id', $selected);
    return $categories;
}

/** get Careers * */
function getSubCategoriesBox($id, $selected = FALSE) {
    global $oStores;
    /** Select Boxes Content * */
    $categories = "<option value='' " . (($selected == '') ? 'SELECTED' : '') . ">" . l('All Sub Categories') . "</option>";
    $categories .= generate_select_options($oStores->getSubCategory($id), 'title', 'id', $selected);
    return $categories;
}

/** get Countries * */
function getCountriesBox($selected = FALSE) {
    global $oUser;
    /** Select Boxes Content * */
    $countries = "<option value='' " . (($selected == '') ? 'SELECTED' : '') . ">" . l('All Countries') . "</option>";
    $countries .= generate_select_options($oUser->countries_get(), 'title', 'code', $selected);
    return $countries;
}

/** get Cities * */
function getCitiesBox($id, $selected = FALSE) {
    global $oUser;
    /** Select Boxes Content * */
    $cities = "<option value='' " . (($selected == '') ? 'SELECTED' : '') . ">" . l('All Cities') . "</option>";
    $cities .= generate_select_options($oUser->getCities($id), 'title', 'id', $selected);
    return $cities;
}

/** get Countries * */
function getAreasBox($id, $selected = FALSE) {
    global $oUser;
    /** Select Boxes Content * */
    $areas = "<option value='' " . (($selected == '') ? 'SELECTED' : '') . ">" . l('All Areas') . "</option>";
    $areas .= generate_select_options($oUser->getAreas($id), 'title', 'id', $selected);
    return $areas;
}

function AmazonEmail($to, $subject, $message) {

    require_once('includes/Amazon/AmazonSESMailer.php');

    // Create a mailer class with your Amazon ID/Secret in the constructor
    $mailer = new AmazonSESMailer('AKIAJNWHMPZPBOIMNSFA', '/A9J2hcctciKellmlVvCLjhfsLdoppDYXfynEsmr');

    // Then use this object like you would use PHPMailer normally!
    $mailer->AddAddress($to);
    $mailer->SetFrom('info@bankphonet.com');
    $mailer->Subject = $subject;
    $mailer->MsgHtml($message);
    $send = $mailer->Send();
    if (!$send) {
        return false;
    }

    return true;
}

function detectUrl ($text) {
    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";


// Check if there is a url in the text
    if (preg_match($reg_exUrl, $text, $url)) {
        // make the urls hyper links
        return preg_replace($reg_exUrl, "<a href=\"{$url[0]}\" target=\"_blank\">{$url[0]}</a> ", $text);
    } else {

        // if no urls in the text just return the text
        return $text;
    }
}

?>
