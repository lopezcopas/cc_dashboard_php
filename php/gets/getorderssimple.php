<?php
    require_once(dirname(__FILE__) . '/database.php');

    session_start();

    //Authenticate

    //Check Content
    $contentType = isset($_SERVER['CONTENT_TYPE']) ?
    trim($_SERVER['CONTENT_TYPE']) : '';

    if($contentType === 'application/json'){
        //Receive the RAW post data
        $content = trim(file_get_contents('php://input'));
        $decoded = json_decode($content, true);
    }

    //Check Inputs
    
?>