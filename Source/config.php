<?php

// where now ?
define('LOCAL_MODE', true);


if (LOCAL_MODE) {
    // test configuration
    define("BASE_URL", 'http://localhost/phonetmall/Source/');
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "123@qwe");
    define("DB_DATABASE", "phonetmall");
	
    define("SOAP_CLIENT", "http://localhost/bankphonet/Source/api/users.php?wsdl");
    define("API_CLIENT", "http://localhost/bankphonet/Source/api/?wsdl");
    define('ORDER_LINK', "http://localhost/bankphonet/Source/");
    /*
    define("SOAP_CLIENT", "https://www.bankphonet.com/api/users.php?wsdl");
    define("API_CLIENT", "https://www.bankphonet.com/api/?wsdl");
    define('ORDER_LINK', "https://www.bankphonet.com/");
    */
} else {
    // production configuration
    define("BASE_URL", 'http://www.phonetmall.com/');

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "Hlun&922Urwzq'");
    define("DB_DATABASE", "phonetmall");

    define("SOAP_CLIENT", "https://www.bankphonet.com/api/users.php?wsdl");
    define("API_CLIENT", "https://www.bankphonet.com/api/?wsdl");
    define('ORDER_LINK', "https://www.bankphonet.com/");
}




define('ADMIN_IP','127.0.0.1');

define("CONTACT_EMAIL", "support@phonetmall.com");
define("SETTINGS_FILE", 'settings.txt');
define("EMAIL_HEADERS", 'From: phonetmall.com <no-reply@phonetmall.com> \r\n
						 Reply-To: no-reply@phonetmall.com \r\n');

define("HTML_EMAIL_HEADERS", 'From: no-reply@phonetmall.com' . "\r\n" .
        'Reply-To: no-reply@phonetmall.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=UTF-8' . "\r\n");

define("STORE_LIST", 20);
define("LIST_COUNT", 15 );
define("LIST_COUNT_MINI", 5);
define("LIST_COUNT_MICRO", 2);




// ------------------------ minor options --------------------------
// timezone
date_default_timezone_set('Africa/Cairo');

// local
setlocale(LC_ALL, 'Arabic');

// use unicode
mb_internal_encoding("UTF-8");

// hide notices
error_reporting(E_ALL ^ E_NOTICE);



// defaults
define('DEFAULT_UPLOAD_DIR', 'uploads/');
?>




