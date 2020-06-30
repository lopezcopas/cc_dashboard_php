<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/light/core.css">
    <link rel="stylesheet" href="./css/light/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-title">Dashboard</div>
        <div class="sidebar-links">
            <a href="" class="sidebar-link sidebar-link-active"><i class="fas fa-chart-pie sidebar-link-icon"></i><span>Overview</span></a>
            <a href="./orders.php" class="sidebar-link"><i class="fas fa-file-invoice sidebar-link-icon"></i><span>Orders</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-file-invoice-dollar sidebar-link-icon"></i><span>Quote</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-print sidebar-link-icon"></i><span>Presses</span></a>
            <a href="./stocks.php" class="sidebar-link"><i class="fas fa-paper-plane sidebar-link-icon"></i><span>Stocks</span></a>
            <a href="" class="sidebar-link"><i class="fas fa-hammer sidebar-link-icon"></i><span>Finishing</span></a>
        </div>
    </div>
    <div class="topbar">
        <div class="search-tray">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search Keyword here...">
            </div>
        </div>
        <div class="user-tray">
            <div class="user-icon-container">
                <img src="https://coplop.dreamhosters.com/resources/account-placeholder.png" alt="" class="user-icon">
            </div>
            <p class="user-name">Copas Lopez <span><i class="fas fa-chevron-down"></i></span></p>
        </div>
    </div>
    <div class="wrapper">
        <div class="wrapper-left">
            <div class="card current-order-card">
                <h1 class="card-title">Order |</h1>
                <div class="card-body co-body">
                    <div class="co-info">
                        <div class="co-customer">
                            <h1 class="co-customer-info name"><i class="fas fa-user co-customer-icon"></i>  <span></span></h1>
                            <h1 class="co-customer-info organization"><i class="fas fa-building co-customer-icon"></i>  <span></span></h1>
                            <h1 class="co-customer-info phone"><i class="fas fa-phone co-customer-icon"></i>  <span></span></h1>
                            <h1 class="co-customer-info email"><i class="fas fa-envelope co-customer-icon"></i>  <span></span></h1>
                        </div>
                        <div class="co-dates">
                            <div class="cc-input-group co-date-group">
                                <label for="takendate" class="cc-input-label">Taken Date</label>
                                <input type="datetime-local" name="takendate" class="cc-input co-date takendate">
                            </div>
                            <div class="cc-input-group co-date-group">
                                <label for="proofdate" class="cc-input-label">Proof Date</label>
                                <input type="datetime-local" name="proofdate" class="cc-input co-date proofdate">
                            </div>
                            <div class="cc-input-group co-date-group">
                                <label for="duedate" class="cc-input-label">Due Date</label>
                                <input type="datetime-local" name="duedate" class="cc-input co-date duedate">
                            </div>
                        </div>
                        <div class="co-location">
                            <div class="cc-input-group co-location-group">
                                <label for="newlocation" class="cc-input-label">New Location</label>
                                <input type="text" name="newlocation" class="cc-input location">
                            </div>
                        </div>
                    </div>
                    <div class="co-items"></div>
                    <div class="hidden">
                        <div id="hidden-item" itemid="0" itemtype="Shipping" class="co-item">
                            <div class="co-item-collapsed">
                                <div class="co-item-collapsed-info">
                                    <h1 class="co-item-name"></h1>
                                    <p class="co-item-description"></p>
                                </div>
                                <div class="co-item-collapsed-actions">
                                    <a class="co-item-collapsed-action"><i class="fas fa-check-circle co-complete"></i></a>
                                    <a class="co-item-collapsed-action"><i class="fas fa-edit co-edit"></i></a>
                                    <a class="co-item-collapsed-action"><i class="fas fa-trash-alt co-delete"></i></a>
                                </div>
                            </div>
                            <div class="co-item-print">
                                <p class="co-item-text note"></p>
                                <p class="co-item-text print"></p>
                                <p class="co-finishing">Finishing</p>
                            </div>
                            <div class="co-item-shipping">
                                <p class="co-item-text addresslineone"></p>
                                <p class="co-item-text addresslinetwo"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="co-buttons">
                    <button class="cc-button">Submit</button>
                    <button class="cc-button">Discard</button>
                </div>
                <h1 class="co-user">Currently being edited by <span>Copas</span></h1>
            </div>
            <div class="card order-list-card">
                <h1 class="card-title">Order List</h1>
                <div class="card-body">
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
                                <a class="order-list-content ol-order"></a>
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
        </div>
        <div class="wrapper-right">
            <div class="card statistics-card">
                <h1 class="card-title">Statistics</h1>
            </div>
        </div>
    </div>
    <script src="./js/dashboard.js"></script>
</body>
</html>