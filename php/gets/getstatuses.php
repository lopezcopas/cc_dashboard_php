<?php
    require_once('../config/database.php');

    session_start();

    //Authenticate

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getStatuses = $dbConn->prepare("SELECT * FROM statuses WHERE 1");
    $getStatuses->execute();
    if($getStatuses = $getStatuses->fetchall(PDO::FETCH_ASSOC)){
        $response = json_encode(array(
            "Status"=>200,
            "Response"=>$getStatuses
        ));
        echo $response;
        return;
    }else{
        $response = json_encode(array(
            "Status"=>200,
            "Response"=>"No Statuses Found"
        ));
        echo $response;
        return;
    }
?>