<?php

header('Access-Control-Allow-Origin:*');
header('content-Type: application/json');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-headers: Content-Type, Access-Control-Allow-Header,Authorization, X-Request-With');

include_once('function.php');


$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod == "GET"){ 
// Obtenir l'id
    if(isset($_GET['id'])){
        $customer=getCustomer($_GET);
        echo $customer;
    }else{
        $customerList=getCustomerList();
        echo $customerList;
    }

    
}
else{
    $data=[
        'status'=>405,
        'message'=>$requestMethod.'Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
};

?>