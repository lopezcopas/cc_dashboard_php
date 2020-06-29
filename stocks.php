<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <link rel="stylesheet" href="./css/light/core.css">
    <link rel="stylesheet" href="./css/light/stocks.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-title">Dashboard</div>
        <div class="sidebar-links">
            <a href="./dashboard.php" class="sidebar-link"><i class="fas fa-chart-pie sidebar-link-icon"></i><span>Overview</span></a>
            <a href="./orders.php" class="sidebar-link"><i class="fas fa-file-invoice sidebar-link-icon"></i><span>Orders</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-file-invoice-dollar sidebar-link-icon"></i><span>Quote</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-print sidebar-link-icon"></i><span>Presses</span></a>
            <a href="" class="sidebar-link sidebar-link-active"><i class="fas fa-paper-plane sidebar-link-icon"></i><span>Stocks</span></a>
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
        <div class="card stock-list-card">
            <h1 class="card-title">Stock List</h1>
            <div class="card-body">
                <div class="sl-toolbar">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" class="search-input" placeholder="Search Stock here...">
                    </div>
                </div>
                <div class="stock-list">
                    <div class="sl-headers">
                        <h1 class="sl-header sl-description">Description</h1>
                        <h1 class="sl-header sl-size">Width</h1>
                        <h1 class="sl-header sl-size">Height</h1>
                        <h1 class="sl-header sl-type">Type</h1>
                        <h1 class="sl-header sl-coating">Coating</h1>
                    </div>
                    <div class="sl-body"></div>
                    <div class="hidden">
                        <div id="hidden-stock" class="stock">
                            <h1 class="sl-header sl-description description"></h1>
                            <h1 class="sl-header sl-size width"></h1>
                            <h1 class="sl-header sl-size height"></h1>
                            <h1 class="sl-header sl-type type"></h1>
                            <h1 class="sl-header sl-coating coating"></h1>
                            <div class="stock-actions">
                                <button class="stock-action stock-edit"><i class="fas fa-edit stock-action-icon"></i></button>
                                <button class="stock-action stock-delete"><i class="fas fa-trash-alt stock-action-icon"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup">
        <div class="modal"></div>
        <div class="popup-card stock-editor">
            <h1 class="card-title">Current Card</h1>
        </div>
    </div>
    <script src="./js/stocks.js"></script>
</body>
</html>