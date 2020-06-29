<?php
    require_once('../config/database.php');

    session_start();

    //Authenticate

    //SQL
    $db = new Database();
    $dbConn = $db->connect();

    $getOrder = $dbConn->prepare("SELECT id, customer_id, organization_id, proof_date, due_date, location, editing_user, payment_status, total FROM orders WHERE true");
    $getOrder->execute();
    if($getOrder = $getOrder->fetchall(PDO::FETCH_ASSOC)){
        $orders = array();
        foreach($getOrder as $order){
            $getUserName = null;
            if(!isset($order['due_date'])){
                $order['due_date'] = $order['proof_date'];
            }

            $getCustomer = $dbConn->prepare("SELECT id, first, last FROM customers WHERE id=:customerID");
            $getCustomer->execute(array(':customerID'=>$order['customer_id']));
            $getCustomer = $getCustomer->fetch(PDO::FETCH_ASSOC);

            if($order['organization_id'] != 0){
                $getOrganization = $dbConn->prepare("SELECT name FROM organizations WHERE id=:organizationID");
                $getOrganization->execute(array(':organizationID'=>$order['organization_id']));
                $getOrganization = $getOrganization->fetch(PDO::FETCH_ASSOC);
            }else{
                $getOrganization = array(
                    "name"=>null
                );
            }

            if(isset($order['editing_user'])){
                $getUserName = $dbConn->prepare("SELECT user_first FROM users WHERE user_id=:userID");
                $getUserName->execute(array(':userID'=>$order['editing_user']));
                $getUserName = $getUserName->fetch(PDO::FETCH_ASSOC);
            }

            if($order['due_date'])

            array_push($orders, array(
                "OrderID"=>$order['id'],
                "DueDate"=>$order['due_date'],
                "Customer"=>array(
                    "First"=>$getCustomer['first'],
                    "Last"=>$getCustomer['last'],
                    "OrganizationName"=>$getOrganization['name']
                ),
                "Status"=>$order['location'],
                "CurrentUser"=>$getUserName['user_first'],
                "PaymentStatus"=>$order['payment_status'],
                "Total"=>$order['total']
            ));
        }

        usort($orders, 'sort_by_date');

        $response = json_encode(array(
            "Status"=>200,
            "Response"=>$orders
        ));
        echo $response;
        return;
    }else{
        $response = json_encode(array(
            "Status"=>200,
            "Response"=>"No orders found"
        ));
        echo $response;
        return;
    }

    $date = new DateTime();

    function sort_by_date($a, $b){
        if($a['DueDate'] == $b['DueDate']){return 0;}
        return ($a['DueDate'] < $b['DueDate']) ? -1 : 1;
    }
?>