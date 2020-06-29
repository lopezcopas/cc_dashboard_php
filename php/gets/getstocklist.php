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

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getstocks = $dbConn->prepare("SELECT id, description, coating, width, height, type FROM stocks WHERE 1");
    $getstocks->execute();
    $getstocks = $getstocks->fetchall(PDO::FETCH_ASSOC);
    $stocks = array();
    foreach($getstocks as $stock){
        array_push($stocks, array(
            "ID"=>$stock['id'],
            "Description"=>$stock['description'],
            "Width"=>$stock['width'],
            "Height"=>$stock['height'],
            "Coating"=>ucfirst($stock['coating']),
            "Type"=>ucfirst($stock['type'])
        ));
    }
    $response = json_encode(array(
        "Status"=>200,
        "Response"=>$stocks
    ));
    echo $response;
    return;
?>