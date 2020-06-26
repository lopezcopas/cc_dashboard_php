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

    if(!isset($decoded['order-id'])){
        $response = json_encode(array(
            "Status"=>201,
            "Response"=>"A proper order-id must be provided"
        ));
        echo $response;
        return;
    }

    $orderID = $decoded['order-id'];

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getOrder = $dbConn->prepare("SELECT id, description, customer_id, organization_id, taken_date, proof_date, due_date, location, editing_user, payment_status, total FROM orders WHERE id=:orderID");
    $getOrder->execute(array(':orderID'=>$orderID));
    if($getOrder = $getOrder->fetch(PDO::FETCH_ASSOC)){
        //Get Customer
        $getCustomer = $dbConn->prepare("SELECT first, last FROM customers WHERE id=:customerID");
        $getCustomer->execute(array(':customerID'=>$getOrder['customer_id']));
        $getCustomer = $getCustomer->fetch(PDO::FETCH_ASSOC);

        //Get Phone Numbers
        $getPhones = $dbConn->prepare("SELECT * FROM customers_phone WHERE customer_id=:customerID");
        $getPhones->execute(array(':customerID'=>$getOrder['customer_id']));
        $getPhones = $getPhones->fetchall(PDO::FETCH_ASSOC);
        $phones = array();
        foreach($getPhones as $phone){
            array_push($phones, array(
                "PhoneNumber"=>$phone['phone_number'],
                "Extension"=>$phone['extension'],
                "Type"=>$phone['type']
            ));
        }

        //Get Email Addresses
        $getEmails = $dbConn->prepare("SELECT email_address FROM customers_email WHERE customer_id=:customerID");
        $getEmails->execute(array(':customerID'=>$getOrder['customer_id']));
        $getEmails = $getEmails->fetchall(PDO::FETCH_ASSOC);
        $emails = array();
        foreach($getEmails as $email){
            array_push($emails, array(
                "EmailAddress"=>$email['email_address']
            ));
        }

        //Get Organization
        if($getOrder['organization_id'] != 0){
            $getOrganization = $dbConn->prepare("SELECT name FROM organizations WHERE id=:organizationID");
            $getOrganization->execute(array(':organizationID'=>$getOrder['organization_id']));
            $getOrganization = $getOrganization->fetch(PDO::FETCH_ASSOC);
            $organization = array(
                "Name"=>$getOrganization['name']
            );
        }else{
            $organization = null;
        }

        //Get Items
        $getItems = $dbConn->prepare("SELECT * FROM orders_items WHERE order_id=:orderID");
        $getItems->execute(array(':orderID'=>$getOrder['id']));
        $getItems = $getItems->fetchall(PDO::FETCH_ASSOC);
        $items = array();
        foreach($getItems as $item){
            //Get Stock
            if($item['stock'] != 0){
                $getStock = $dbConn->prepare("SELECT description FROM stocks WHERE id=:stockID");
                $getStock->execute(array(':stockID'=>$item['stock']));
                $getStock = $getStock->fetch(PDO::FETCH_ASSOC);
            }

            //Get Finishing
            $getFinishing = $dbConn->prepare("SELECT finishing_id FROM orders_finishing WHERE order_item_id=:itemID");
            $getFinishing->execute(array(':itemID'=>$item['id']));
            $getFinishing = $getFinishing->fetchall(PDO::FETCH_ASSOC);
            $finishing = array();
            foreach($getFinishing as $finishing){
                //Get Finishing Name
                $getFinishingName = $dbConn->prepare("SELECT description FROM finishing WHERE id=:finishingID");
                $getFinishingName->execute(array(':finishingID'=>$finishing['finishing_id']));
                array_push($finishing, array(
                    "Type"=>$getFinishingName
                ));
            }

            array_push($items, array(
                "ID"=>$item['id'],
                "Name"=>$item['name'],
                "Type"=>$item['type'],
                "Status"=>$item['status'],
                "Total"=>$item['total'],
                "Quantity"=>$item['quantity'],
                "Width"=>$item['width'],
                "Height"=>$item['height'],
                "Duplex"=>$item['duplex'],
                "Color"=>$item['color'],
                "Stock"=>$getStock['description'],
                "Note"=>$item["note"],
                "Finishing"=>$finishing,
                "AddressLineOne"=>$item['address_line_one'],
                "AddressLineTwo"=>$item['address_line_two'],
                "City"=>$item['city'],
                "State"=>$item['state'],
                "Zip"=>$item['zip']
            ));
        }

        $order = array(
            "OrderID"=>$getOrder['id'],
            "OrderName"=>$getOrder['description'],
            "Customer"=>array(
                "First"=>$getCustomer['first'],
                "Last"=>$getCustomer['last'],
                "Organization"=>$organization,
                "Phone"=>$phones,
                "Email"=>$emails
            ),
            "TakenDate"=>$getOrder['taken_date'],
            "ProofDate"=>$getOrder['proof_date'],
            "DueDate"=>$getOrder['due_date'],
            "CurrentUser"=>$getOrder['editing_user'],
            "Location"=>$getOrder['location'],
            "PaymentStatus"=>$getOrder['payment_status'],
            "Total"=>$getOrder['total'],
            "Items"=>$items
        );

        $response = json_encode(array(
            "Status"=>200,
            "Response"=>$order
        ));
        echo $response;
        return;
    }else{
        $response = json_encode(array(
            "Status"=>201,
            "Response"=>"No order found with that id"
        ));
        echo $response;
        return;
    }
?>