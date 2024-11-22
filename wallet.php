<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span><h2>Soltify</h2></span>
            </h3> 
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
                <li>
                    <a href="">
                        <span></span>
                        <span>Account</span>
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
            
            <h2 class="dash-title">Wallet</h2>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>My Wallet</h3>
                        
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Wallet Address</th>
                                        <th>Crypto</th>
                                        <th>Balance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>BTCGthqeEz5AV1QWcvbgfXCF1Cwhu</td>
                                        <td>BTC</td>
                                        <td>0.0000000000</td>
                                        <td>
                                            <span><a href="" class="btn btn-primary">Deposit</a></span>
                                            <span></span><a href="" class="btn btn-primary">Withdraw</a></span>
                                        </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Add Wallet</h3>
                        <form class="form-container">
                            <div class="form-group">
                                <label for="walletAddress">Wallet Address</label>
                                <input type="text" id="walletAddress" name="walletAddress" class="form-control" placeholder="Enter Wallet Address">
                            </div>
                            <div class="form-group">
                                <label for="crypto">Crypto</label>
                                <input type="text" id="crypto" name="crypto" class="form-control" placeholder="Enter Crypto Type">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Wallet</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </section>
        </main>
        
    </div>
    
</body>
</html>