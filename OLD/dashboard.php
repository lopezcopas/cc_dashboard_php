<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/core.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="page-title-container">
            <h1 class="page-title">Dashboard</h1>
        </div>
        <div class="navbar">
            <a href="" class="navbar-link navbar-link-active"><i class="fas fa-chart-pie navbar-link-icon"></i><span>Overview</span></a>
            <a href="./orders.php" class="navbar-link"><i class="fas fa-file-invoice navbar-link-icon"></i><span>Orders</span></a>
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
        <div class="welcome">
            <p class="welcome-message">Hello Copas, welcome.</p>
            <div class="shift-message">Your shift ends at <span>05:30</span></div>
        </div>
        <div class="cards">
            <div class="cards-left">
                <div class="card current-order-container">
                    <h1 class="card-title">Order</h1>
                    <div class="current-order-body">
                        <div class="current-order-data">
                            <div class="current-order-customer">
                                <div class="customer-row"><i class="fas fa-user customer-row-icon"></i><span id="current-customer-name"></span></div>
                                <div class="customer-row"><i class="fas fa-building customer-row-icon"></i><span id="current-customer-organization"></span></div>
                                <div class="customer-row"><i class="fas fa-phone customer-row-icon"></i><span id="current-customer-phone"></span></div>
                                <div class="customer-row"><i class="fas fa-envelope customer-row-icon"></i><span id="current-customer-email"></span></div>
                            </div>
                            <div class="current-order-dates">
                                <label class="order-label" for="current-takendate">Taken Date</label>
                                <input id="current-takendate" type="datetime-local" class="order-date-input">
                                <label class="order-label" for="current-takendate">Proof Date</label>
                                <input id="current-proofdate" type="datetime-local" class="order-date-input">
                                <label class="order-label" for="current-takendate">Due Date</label>
                                <input id="current-duedate" type="datetime-local" class="order-date-input">
                            </div>
                        </div>
                        <div class="current-order-items"></div>
                    </div>
                    <div class="order-buttons">
                        <button class="cc-button current-order-submit">Submit</button>
                        <button class="cc-button current-order-discard">Discard</button>
                    </div>
                    <div class="order-editor">Being edited by <span>Copas</span></div>
                    <input type="text" class="order-new-location" placeholder="New Location...">
                    <div class="hidden">
                        <div id="hidden-order-item" class="order-item">
                            <div class="order-item-collapsed">
                                <div class="order-item-info">
                                    <h1 class="order-item-name"></h1>
                                    <p class="order-item-description"></p>
                                </div>
                                <div class="order-item-actions">
                                    <button class="order-item-action"><i class="fas fa-check-circle order-item-action-complete"></i></button>
                                    <button class="order-item-action"><i class="fas fa-edit order-item-action-edit"></i></button>
                                    <button class="order-item-action"><i class="fas fa-trash order-item-action-delete"></i></button>
                                </div>
                            </div>
                            <div class="order-item-printing">
                                <h1 class="order-item-text stock"></h1>
                                <p class="order-item-text note"></p> 
                            </div>
                            <div class="order-item-shipping">
                                <h1 class="order-item-text address-line-one"></h1>
                                <h1 class="order-item-text city-state-zip"></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card order-list-container">
                    <h1 class="card-title">Order List</h1>
                    <div class="order-table-headers">
                        <p class="order-table-header order-number">Order</p>
                        <p class="order-table-header order-date">Due Date</p>
                        <p class="order-table-header order-customer">Customer</p>
                        <p class="order-table-header order-status">Status</p>
                        <p class="order-table-header order-user">User</p>
                        <p class="order-table-header order-pay-status">Payment Status</p>
                        <p class="order-table-header order-total">Total</p>
                    </div>
                    <div class="order-table-body">
                        <div class="hidden">
                            <div id="hidden-order" OrderID="" class="order-table-row">
                                <div class="order-table-row-content order-number">
                                    <a href="" class="order-table-link order-number-text"></a>
                                </div>
                                <div class="order-table-row-content order-date">
                                    <div class="order-date-time">
                                        <p class="order-table-text order-date-text"></p>
                                        <p class="order-table-text order-time-text"></p>
                                    </div>
                                </div>
                                <div class="order-table-row-content order-customer">
                                    <div class="order-customer-name">
                                        <p class="order-table-text customer-name-text"></p>
                                        <p class="order-table-text customer-organization-text"></p>
                                    </div>    
                                </div>
                                <div class="order-table-row-content order-status">
                                    <p class="order-table-text order-status-text"></p>
                                </div>
                                <div class="order-table-row-content order-user">
                                    <p class="order-table-text order-user-text"></p>
                                </div>
                                <div class="order-table-row-content order-pay-status">
                                    <p class="order-table-text order-pay-status-text"></p>
                                </div>
                                <div class="order-table-row-content order-total">
                                    <p class="order-table-text order-total-text"></p>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cards-right">
                <div class="card calendar-container">
                    <h1 class="card-title">Calendar</h1>
                </div>
                <div class="card order-chart-container">
                    <h1 class="card-title">Order Statistics</h1>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/dashboard.js"></script>
</body>
</html>