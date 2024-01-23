<?php
require_once('../inc/dbcon.php');

// create data
function error422($message){
    $data=[
        'data'=>422,
        'message'=>$message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
    exit();
}

function storeCustomer($customerInput){
    global $conn;

    // recuperer les informations du formData
    $name=mysqli_real_escape_string($conn, $customerInput["name"]);
    $email=mysqli_real_escape_string($conn, $customerInput["email"]);
    $phone=mysqli_real_escape_string($conn, $customerInput["phone"]);

    if(empty(trim($name))){
        return error422("enter your name");
    }
    elseif(empty(trim($email))){
        return error422("enter your email");
    }
    elseif(empty(trim($phone))){
        return error422("enter your phone");
    }

    else{
        $query="INSERT INTO costumers(name,email,phone)VALUES ('$name','$email','$phone')";
        $result=mysqli_query($conn, $query);

        if($result){



            $data=[
                'status'=>201,
                'message'=>'Customer Created successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);

        }else{
            $data=[
                'status'=>500,
                'message'=>'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }

}


// Read data
function getCustomerList(){
    global $conn;

    $query="SELECT * FROM costumers";
    $query_run=mysqli_query($conn, $query);

    if($query_run){
        if(mysqli_num_rows($query_run)>0){
            $res=mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            
            $data=[
                'status'=>200,
                'message'=>'Customer List Fetched Successfully',
                'data'=>$res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        }else{
            $data=[
                'status'=>404,
                'message'=>'No Customer Found'
            ];
            header("HTTP/1.0 404 No Customer Found");
            return json_encode($data);

        }
    }else{
        $data=[
            'status'=>500,
            'message'=>'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }

}

// Read data par id
function getCustomer($customerParams){
    global $conn;

    if($customerParams['id']== null){
        return error422("Enter your customer id");
    }

    $customerId=mysqli_real_escape_string($conn, $customerParams['id']);
    $query="SELECT * FROM costumers WHERE id='$customerId'LIMIT 1";
    $result=mysqli_query($conn, $query);

    if($result){
        if(mysqli_num_rows($result)==1){
            $res=mysqli_fetch_assoc($result);

            $data=[
                'status'=>200,
                'message'=>'Customer fetched Successfully',
                'data'=> $res
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);


        }else{
            $data=[
                'status'=>404,
                'message'=>'customer not found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }else{
        $data=[
            'status'=>500,
            'message'=>'Interal server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

// Update data
function updateCustomer($customerInput, $customerParams){
    global $conn;


    if(!isset($customerParams['id'])){
        return error422('customer id not found in URL');
    }elseif($customerParams['id']==null){
        return error422('Enter the customer id');
    }

    $customerId=mysqli_real_escape_string($conn, $customerParams['id']);


    // recuperer les informations du formData
    $name=mysqli_real_escape_string($conn, $customerInput["name"]);
    $email=mysqli_real_escape_string($conn, $customerInput["email"]);
    $phone=mysqli_real_escape_string($conn, $customerInput["phone"]);

    if(empty(trim($name))){
        return error422("enter your name");
    }
    elseif(empty(trim($email))){
        return error422("enter your email");
    }
    elseif(empty(trim($phone))){
        return error422("enter your phone");
    }

    else{
        $query="UPDATE costumers SET name='$name',email='$email',phone='$phone' WHERE id='$customerId' LIMIT 1";
        $result=mysqli_query($conn, $query);

        if($result){



            $data=[
                'status'=>201,
                'message'=>'Customer Updated successfully',
            ];
            header("HTTP/1.0 200 Success");
            return json_encode($data);

        }else{
            $data=[
                'status'=>500,
                'message'=>'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }

}

// delete data
function deletecustomer($customerParams){
    global $conn;

    if(!isset($customerParams['id'])){
        return error422('costumer id not found in URL');
    }elseif($customerParams['id']==null){
        return error422('Enter the customer id');
    }

    $customerId=mysqli_real_escape_string($conn, $customerParams['id']);

    $query="DELETE FROM costumers WHERE id='$customerId'LIMIT 1";
    $result=mysqli_query($conn, $query);

    if($result){

        $data=[
            'status'=>200,
            'message'=>'costumer deleted successfully',
        ];
        header("HTTP/1.0 200 OK");
        return json_encode($data);
    }else{
        $data=[
            'status'=>404,
            'message'=>'customer not found',
        ];
        header("HTTP/1.0 404 Not Found");
        return json_encode($data);
    }
}


?>