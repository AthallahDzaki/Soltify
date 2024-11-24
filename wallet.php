<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $walletAddress = $_POST['walletAddress'];
        $crypto = $_POST['crypto'];
        $sql_check = 'SELECT * FROM tb_wallets WHERE wallet_address = ? AND wallet_coin_id = ?;';
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param('si', $walletAddress, $crypto);
        if($stmt_check->execute()) {
            $result = $stmt_check->get_result();
            if($result->num_rows > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Wallet already exists']);
                die();
            }
        }
        $sql = 'INSERT INTO tb_wallets (wallet_address, wallet_owner, wallet_coin_id) VALUES (?, ?, ?);';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sii', $walletAddress, $_SESSION['user']['id'], $crypto);
        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Wallet added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add wallet']);
        }
        die();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        die();
    }
}

$coin_list = [];

try {
    $sql = 'SELECT * FROM tb_coins;';
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $coin_list[] = $row;
    }
} catch (Exception $e) {
    echo '<script>alert("Failed to fetch coin list")</script>';
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
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
                                    <?php
                                    if(empty($coin_list)) {
                                        echo '<tr><td colspan="4">No coin found</td></tr>';
                                    } else {
                                        $sql = 'SELECT * FROM tb_wallets WHERE wallet_owner = ?;';
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param('i', $_SESSION['user']['id']);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if($result->num_rows === 0) {
                                            echo '<tr><td colspan="4">No wallet found</td></tr>';
                                        } else {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row['wallet_address'] . '</td>';
                                                echo '<td>' . $coin_list[array_search($row['wallet_coin_id'], array_column($coin_list, 'id'))]['name'] . '</td>';
                                                echo '<td>' . $row['wallet_balance'] . ' ' . $coin_list[array_search($row['wallet_coin_id'], array_column($coin_list, 'id'))]['stands'] . '</td>';
                                                echo '<td><a href="deposit.php?id=' . $row['id'] . '">Deposit</a> | <a href="withdraw.php?id=' . $row['id'] . '">Withdraw</a></td>';
                                                echo '</tr>';
                                            }
                                        }
                                    }
                                    ?>
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
                        <form class="form-container" id="addWalletForm">
                            <div class="form-group">
                                <label for="walletAddress">Wallet Address</label>
                                <input type="text" id="walletAddress" name="walletAddress" class="form-control" placeholder="Enter Wallet Address">
                            </div>
                            <div class="form-group">
                                <label for="crypto">Crypto</label>
                                <select id="crypto" name="crypto" class="form-control">
                                    <?php
                                    if(count($coin_list) > 0) {
                                        foreach($coin_list as $coin) {
                                            echo '<option value="' . $coin['id'] . '|'.$coin['name'].'">' . $coin['name'] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="">No coin found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <button name="submit" type="submit" class="btn btn-primary">Add Wallet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="/js/wallet-address-validator.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
    <script>
        let addWalletForm = document.getElementById('addWalletForm');
        addWalletForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            let walletAddress = document.getElementById('walletAddress').value.trim();
            let crypto = document.getElementById('crypto').value.trim();
            let crypto_id = crypto.split('|')[0].trim();
            let crypto_name = crypto.split('|')[1].toLowerCase().trim();

            if(walletAddress.trim() === '' || crypto.trim() === '') {
                Swal.fire({
                    title: 'Error',
                    text: 'Please fill all fields',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            console.log(walletAddress, crypto_id, crypto_name);

            try {
                if(!WAValidator.validate(walletAddress, crypto_name))
                    throw new Error('Invalid wallet address');
            } catch (e) {
                Swal.fire({
                    title: 'Error',
                    text: e.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
            
            let formData = new FormData();
            formData.append('walletAddress', walletAddress);
            formData.append('crypto', crypto_id);
            let response = await fetch('wallet.php', {
                method: 'POST',
                body: formData
            });
            let result = await response.json();
            if (result.status === 'success') {
                Swal.fire({
                    title: 'Success',
                    text: result.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: result.message,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
</body>
</html>