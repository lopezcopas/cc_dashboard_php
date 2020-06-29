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

    if(!isset($decoded['stockid'])){
        $response = json_encode(array(
            "Status"=>400,
            "Response"=>"A valid stockid is required for this function"
        ));
        echo $response;
        return;
    }

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getstock = $dbConn->prepare("SELECT * FROM stocks WHERE id=:stockID");
    $getstock->execute(array(':stockID'=>$decoded['stockid']));
    $getstock = $getstock->fetch(PDO::FETCH_ASSOC);
    $stock = array(
        "ID"=>$decoded['stockid'],
        "Description"=>$getstock['description'],
        "Width"=>$getstock['width'],
        "Height"=>$getstock['height'],
        "Coating"=>ucfirst($getstock['coating']),
        "Type"=>ucfirst($getstock['type']),
        "Modified"=>$getstock['modified']
    );
    $response = json_encode(array(
        "Status"=>200,
        "Response"=>$stock
    ));
    echo $response;
    return;
?>