<?php
    if(isset($_GET['order'])){

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="./css/core.css">
    <link rel="stylesheet" href="./css/orders.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="page-title-container">
            <h1 class="page-title">Orders</h1>
        </div>
        <div class="navbar">
            <a href="./dashboard.php" class="navbar-link"><i class="fas fa-chart-pie navbar-link-icon"></i><span>Overview</span></a>
            <a href="" class="navbar-link navbar-link-active"><i class="fas fa-file-invoice navbar-link-icon"></i><span>Orders</span></a>
            <a href="" class="navbar-link"><i class="fas fa-file-invoice-dollar navbar-link-icon"></i><span>Quotes</span></a>
            <a href="" class="navbar-link"><i class="fas fa-print navbar-link-icon"></i><span>Presses</span></a>
            <a href="" class="navbar-link"><i class="fas fa-paper-plane navbar-link-icon"></i><span>Stocks</span></a>
            <a href="" class="navbar-link"><i class="fas fa-hammer navbar-link-icon"></i><span>Finishing</span></a>
        </div>
        <p class="version">Version 0.0001</p>
    </div>
    <div class="wrapper">
        <div class="top-bar">
            <div class="search-container">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" class="search" placeholder="Search keyword here...">
                </div>
                <div class="search-results"></div>
            </div>
            <div class="user-tray">
                <div class="profile">
                    <div class="profile-img-container">
                        <img src="https://coplop.dreamhosters.com/resources/account-placeholder.png" alt="">
                    </div>
                    <div class="profile-name"><span>Copas Lopez</span> <i class="fas fa-chevron-down"></i></div>
                </div>
                <div class="notifications-container">
                    <i class="fas fa-bell notifications-bell"></i>
                    <div class="notifications-bubble">1</div>
                </div>
            </div>
        </div>
        <?php
            if(isset($_GET['order'])){
                echo '<div class="container customer">
                        <div class="card customer-order-list">
                            <h1 class="card-title">Orders | ' . $_GET['order'] . '</h1>
                        </div>
                        <div class="card customer-info">
                            <h1 class="card-title">Customer</h1>
                        </div>
                    </div>';
            }else{
                echo '<div class="container order-search">
                        <div class="card order-list">
                            <h1 class="card-title">Orders</h1>
                        </div>
                    </div>';
            }
        ?>
    </div>
</body>
</html>