<?php

header('Access-Control-Allow-Origin:*');
header('content-Type: application/json');
header('Access-Control-Allow-Method: DELETE');
header('Access-Control-Allow-headers: Content-Type, Access-Control-Allow-Header,Authorization, X-Request-With');

include_once('function.php');


$requestMethod=$_SERVER["REQUEST_METHOD"];

if($requestMethod == "DELETE"){ 

        $deleteCustomer=deleteCustomer($_GET);
        echo $deleteCustomer;
    
}
else{
    $data=[
        'status'=>405,
        'message'=>$requestMethod.' Method Not Allowed'
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
};

?>