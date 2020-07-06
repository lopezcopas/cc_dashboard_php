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
            <a href="./orders.php" class="sidebar-link sidebar-link-active"><i class="fas fa-file-invoice sidebar-link-icon"></i><span>Orders</span></a>
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
        <div class="section order-list-section" <?php if(isset($_GET['order'])){echo 'style="display: none;"';}?>>
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
                    <button id="new-order" class="cc-button">+ New</button>
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
        <div class="section customer-orders-section" <?php if(isset($_GET['customer'])){echo 'style="display: flex;"';}?>>
            <div class="card customer-order-list-card">
                <h1 class="card-title">Orders</h1>
            </div>
            <div class="card customer-info-card">
                <h1 class="card-title">Customer</h1>
            </div>
        </div>
        <div class="section single-order-section" <?php if(isset($_GET['order'])){echo 'style="display: flex;"';}?>>
        <div class="card customer-order-list-card">
                <h1 class="card-title">Order <?php if(isset($_GET['order'])){echo $_GET['order'];}?></h1>
                <div class="card-body">
                    <div class="new-order-info">
                        <div class="new-order-dates">
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-taken-date" class="cc-input-label">Taken Date</label>
                                <input name="new-taken-date" type="datetime-local" class="cc-input">
                            </div>
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-proof-date" class="cc-input-label">Proof Date</label>
                                <input name="new-proof-date" type="datetime-local" class="cc-input">
                            </div>
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-due-date" class="cc-input-label">Due Date</label>
                                <input name="new-due-date" type="datetime-local" class="cc-input">
                            </div>
                        </div>
                    </div>
                    <div class="item-list">
                    
                    </div>
                </div>
            </div>
            <div class="card customer-info-card">
                <h1 class="card-title">Customer</h1>
            </div>
        </div>
        <div class="section new-order-section">
            <div class="card customer-order-list-card">
                <h1 id="editable-title" class="card-title">New Order</h1>
                <div class="card-body">
                    <div class="new-order-info">
                        <div class="no-order-number-container">
                            <div class="cc-input-group no-number-input-group">
                                <label for="new-order-number" class="cc-input-label">Order Number</label>
                                <input id="new-order-id" name="new-order-number" type="text" class="cc-input">
                            </div>
                        </div>
                        <div class="new-order-dates">
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-taken-date" class="cc-input-label">Taken Date</label>
                                <input name="new-taken-date" type="datetime-local" class="cc-input">
                            </div>
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-proof-date" class="cc-input-label">Proof Date</label>
                                <input name="new-proof-date" type="datetime-local" class="cc-input">
                            </div>
                            <div class="cc-input-group no-date-input-group">
                                <label for="new-due-date" class="cc-input-label">Due Date</label>
                                <input name="new-due-date" type="datetime-local" class="cc-input">
                            </div>
                        </div>
                    </div>
                    <div class="item-list">
                        <div itemid="1" class="item">
                            <div class="item-collapsed">
                                <div class="item-collapsed-info">
                                    <h1 class="item-name">Item One</h1>
                                    <p class="item-description">Item Description</p>
                                </div>
                                <div class="item-actions">
                                    <button class="item-action"><i class="fas fa-trash-alt co-delete"></i></button>
                                </div>
                            </div>
                            <div class="item-body printing-section">
                                Test
                            </div>
                        </div>
                        <div class="new-item">+ New Item</div>
                    </div>
                </div>
            </div>
            <div class="card customer-info-card">
                <h1 class="card-title">Customer</h1>
            </div>
        </div>
    </div>
    <script src="./js/orders.js"></script>
</body>
</html>