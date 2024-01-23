<?php
error_reporting(0);
header('Access-Control-Allow-Origin:*');
header('content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-headers: Content-Type, Access-Control-Allow-Header,Authorization, X-Request-With');

include_once('function.php');


$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod== 'POST'){

    $inputData=json_decode(file_get_contents("php://input"),true);

    if(empty($inputData)){
        $storeCustomer=storeCustomer($_POST);
    }
    else{
        $storeCustomer=storeCustomer($inputData);
        
    }
    // tester
    // echo $inputData['name'];
    echo $storeCustomer;


}else{
    $data=[
        'statut'=>405,
        'message'=>$requestMethod."Method Not Allowed"
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo(json_encode($data));
}
?>