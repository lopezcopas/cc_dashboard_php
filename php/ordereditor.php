<?php
    require_once('./config/database.php');

    session_start();

    //Authenticate

    //Variables
    $decoded = '';
    $db = new Database();
    $dbConn = $db->connect();

    //Check Inputs
    $contentType = isset($_SERVER['CONTENT_TYPE']) ?
    trim($_SERVER['CONTENT_TYPE']) : '';

    if($contentType === 'application/json'){
        //Receive the RAW post data
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
    }

    if(isset($decoded['order-id'])){
        //Look for order
        $getOrder = $dbConn->prepare("SELECT * FROM orders WHERE id=:orderid");
        $getOrder->execute(array(':orderid'=>$decoded['order-id']));
    }

    if($_GET['neworder']){
        //New Order
        $html = '<div class="order-body">';
        $response = json_encode(array(
            "Status" => 200,
            "Response" => $html
        ));
        echo $response;
        return;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>