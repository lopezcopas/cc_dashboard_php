<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="./css/light/core.css">
    <link rel="stylesheet" href="./css/light/orders.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-title">Dashboard</div>
        <div class="sidebar-links">
            <a href="./dashboard.php" class="sidebar-link"><i class="fas fa-chart-pie sidebar-link-icon"></i><span>Overview</span></a>
            <a href="" class="sidebar-link sidebar-link-active"><i class="fas fa-file-invoice sidebar-link-icon"></i><span>Orders</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-file-invoice-dollar sidebar-link-icon"></i><span>Quote</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-print sidebar-link-icon"></i><span>Presses</span></a>
            <a href="./stocks.php" class="sidebar-link"><i class="fas fa-paper-plane sidebar-link-icon"></i><span>Stocks</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-hammer sidebar-link-icon"></i><span>Finishing</span></a>
        </div>
    </div>
    <div class="topbar">
        <div class="search-tray"></div>
        <div class="user-tray">
            <div class="user-icon-container">
                <img src="https://coplop.dreamhosters.com/resources/account-placeholder.png" alt="" class="user-icon">
            </div>
            <p class="user-name">Copas Lopez <span><i class="fas fa-chevron-down"></i></span></p>
        </div>
    </div>
    <div class="wrapper">
        <div class="card order-list-card">
            <h1 class="card-title">Order list</h1>
            <div class="ol-toolbar">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search Keyword here...">
                </div>
                <div class="page-controls-container">
                    <a href="" class="page-control"><i class="fas fa-chevron-left"></i></a>
                    <a href="" class="page-control">1</a>
                    <a href="" class="page-control">2</a>
                    <a href="" class="page-control">3</a>
                    <a href="" class="page-control"><i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="order-list">
                <div class="order-list-headers">
                    <h1 class="order-list-header ol-order">Order</h1>
                    <h1 class="order-list-header ol-date">Due Date</h1>
                    <h1 class="order-list-header ol-customer">Customer</h1>
                    <h1 class="order-list-header ol-status">Status</h1>
                    <h1 class="order-list-header ol-user">User</h1>
                    <h1 class="order-list-header ol-payment">Payment Status</h1>
                    <h1 class="order-list-header ol-total">Total</h1>
                </div>
                <div class="order-list-body"></div>
                <div class="hidden">
                    <div id="hidden-order" oderid="" class="order">
                        <h1 class="order-list-content ol-order"></h1>
                        <div class="ol-date">
                            <h1 class="order-list-content ol-date-date"></h1>
                            <h1 class="order-list-content ol-date-time"></h1>
                        </div>
                        <div class="ol-customer">
                            <h1 class="order-list-content ol-customer-name"></h1>
                            <h1 class="order-list-content ol-customer-organization"></h1>
                        </div>
                        <h1 class="order-list-content ol-status"></h1>
                        <h1 class="order-list-content ol-user"></h1>
                        <h1 class="order-list-content ol-payment"></h1>
                        <h1 class="order-list-content ol-total"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>