<?php
    include 'Zend/Soap/Client.php';
    $client = new Zend_Soap_Client("http://localhost/bankphonet/Source/api/users.php?wsdl",
                array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_DEFLATE));

    
    $data['firstname'] = 'asas';
    $data['lastname'] = 'Massoud';
    $data['email'] = 'samy1@tqniat.com';
    $data['mobile'] = '230108975587';
    $data['password'] = '111111';
    $data['repassword']= '111111';
    $data['country_code'] = 'EG';
    
    
    $res = $client->register ($data,false,true,true);
    //$res = $client->authenticate ('seller@bankphonet.com','123456',false,true);
   
    
    if($res < 0)
        echo $res;
    else
        print_r ($res);
   
     
    
?>

      