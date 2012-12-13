<?php

$meta_tags = array ();

$meta_tag ['keywords'] = "Phonetmall,Online Store";
$meta_tag ['description'] = "default description for all pages that has no default decription goes here";

/**
 * To set any page keywords or description you have to append it to $meta_tag array 
 * where 1st dimension is for controller name ,second page name and the third one till if
 * it's keyword or description. 
 */
$meta_tag['default']['default']['keywords'] = "Adbox,box for ads";
$meta_tag['default']['default']['description'] = "Adbox,something";
?>
