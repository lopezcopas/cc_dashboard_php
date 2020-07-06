<?php
    require_once('../config/database.php');

    session_start();

    //Authenticate

    //Check Inputs
    $contentType = isset($_SERVER['CONTENT_TYPE']) ?
    trim($_SERVER['CONTENT_TYPE']) : '';

    if($contentType === 'application/json'){
        //Receive the RAW post data
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
    }

    if(!isset($decoded['OrderID'])){
        $response = json_encode(array(
            "Status"=>201,
            "Response"=>"A proper order-id must be provided"
        ));
        echo $response;
        return;
    }

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getOrderID = $dbConn->prepare("SELECT id FROM orders WHERE id=:OrderID");
    $getOrderID->execute(array(':OrderID'=>$decoded['OrderID']));
    if($getOrderID = $getOrderID->fetch(PDO::FETCH_ASSOC)){
        $response = json_encode(array(
            "Status"=>208,
            "Response"=>"Order number in use!"
        ));
        echo $response;
        return;
    }

    $response = json_encode(array(
        "Status"=>200,
        "Response"=>"Valid Order Number"
    ));
    echo $response;
    return;

?>