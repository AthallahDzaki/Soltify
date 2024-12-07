<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span><h2>Soltify</h2></span>
            </h3> 
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <span>Transactions<span>
                    </a>
                </li>
                <li>
                    <a href="wallet.php">
                        <span>Wallet</span>
                    </a>
                </li>
                <?= $_SESSION['user']['role'] === 1 ? '<li><a href="admin.php"><span>Admin Panel</span></a></li>' : '' ?>
                <?= $_SESSION['user']['role'] === 1 ? '<li><a href="coin.php"><span>Add Coin</span></a></li>' : '' ?>
                <li>
                    <a href="">
                        <span></span>
                        <span>Account</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    
    <div class="main-content">
        
        <header>
            <div class="search-wrapper">
            </div>
            
            <div class="social-icons">
                <div></div>
            </div>
        </header>
        
        <main>
            
            <h2 class="dash-title">Overview</h2>
            
            <div class="dash-cards">
                <div class="card-single">
                    <div class="card-body">
                        <span></span>
                        <div>
                            <h5>Account Balance</h5>
                            <h4>$30,659.45</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                    <div class="card-body">
                        <span></span>
                        <div>
                            <h5>Pending</h5>
                            <h4>$19,500.45</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                    <div class="card-body">
                        <span></span>
                        <div>
                            <h5>Processed</h5>
                            <h4>$20,659</h4>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="">View all</a>
                    </div>
                </div>
            </div>
            
            
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Recent activity</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Wallet</th>
                                        <th>Dest. Wallet</th>
                                        <th>Crypto</th>
                                        <th>TxID</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>BTCGthqeEz5AV1QWcvbgfXCF1Cwhu</td>
                                        <td>BTCZWHDUVDJRSIWSY2VQSFTKIYXNH</td>
                                        <td>BTC</td>
                                        <td>BVxN75QUZxyqmH0yO74XY8ydWn40Q</td>
                                        <td>
                                            <span class="badge success">Success</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>LTC5HZI2Z8K6NI6AM24WOQSUH49EXK</td>
                                        <td>LTCVBUYGGA4RG2O6LUDE96T8RJ19LA</td>
                                        <td>LTC</td>
                                        <td>LxQcisfJ86gQLk6kcexaBJVWSAelbR</td>
                                        <td>
                                            <span class="badge warning">Processing</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>DOGES7BYFBGHQPPARGYWLUUCGKT4DA</td>
                                        <td>DOGELFFUAWDNO3D58NJM3UYD4EN47J</td>
                                        <td>DOGE</td>
                                        <td>DGBNQAeIiv072qwWPs7qqHcIjUw57O</td>
                                        <td>
                                            <span class="badge success">Success</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TRXM91JFXOVYHQELYWAY2QQJVQUGMI</td>
                                        <td>TRXNS7NV8R0DZQQ5MMOFDX0RPN6QDB</td>
                                        <td>TronX</td>
                                        <td>TRXgi4cU8pvCMz69HX6eVDKa5afB6H</td>
                                        <td>
                                            <span class="badge warning">Processing</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>XRPBLRW9P7IIJTASBKXJGKZCTKIWOO</td>
                                        <td>XRP9FZQT416ATUNT3F66HF3DM0RW2F</td>
                                        <td>XRP</td>
                                        <td>XRPFrJCjZeZYX3WCpDW2EL9IxREs9S</td>
                                        <td>
                                            <span class="badge success">Success</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>
        
    </div>
</body>
</html>