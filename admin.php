<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
if ($_SESSION['user']['role'] != 1) {
    header('Location: dashboard.php');
    exit();
}
include 'db.php';
$coin_list = [];
$user_list = [];
try {
    $sql = 'SELECT * FROM tb_coins;';
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $coin_list[] = $row;
    }
    $sql = 'SELECT * FROM tb_users;';
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $user_list[] = $row;
    }
} catch (Exception $e) {
    echo '<script>alert("Failed to fetch coin or users")</script>';
}
?>
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
                <span>
                    <h2>Soltify</h2>
                </span>
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
            <h2 class="dash-title">Admin Dashboard</h2>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>All Users Wallet</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Wallet Address</th>
                                        <th>Crypto</th>
                                        <th>Balance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($coin_list)) {
                                        echo '<tr><td colspan="4">No coin found</td></tr>';
                                    } else {
                                        $sql = 'SELECT * FROM tb_wallets;';
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $user_list[array_search($row['wallet_owner'], array_column($user_list, 'id'))]['username'] . '</td>';
                                            echo '<td>' . $row['wallet_address'] . '</td>';
                                            echo '<td>' . $coin_list[array_search($row['wallet_coin_id'], array_column($coin_list, 'id'))]['name'] . '</td>';
                                            echo '<td>' . $row['wallet_balance'] . '</td>';
                                            echo '<td><a href="delete-wallet.php?id=' . $row['id'] . '">Delete</a></td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button class="btn btn-primary btn-print" data-print="wallets">Print Wallet</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>Available Coin</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Crypto</th>
                                        <th>Image</th>
                                        <th>Stands</th>
                                        <th>Endpoint</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($coin_list) > 0) {
                                        foreach ($coin_list as $coin) {
                                            echo '<tr>';
                                            echo '<td>' . $coin['id'] . '</td>';
                                            echo '<td>' . $coin['name'] . '</td>';
                                            echo '<td><img src="' . $coin['image'] . '" alt="' . $coin['name'] . '" width="50"></td>';
                                            echo '<td>' . $coin['stands'] . '</td>';
                                            echo '<td>' . $coin['api_endpoint'] . '</td>';
                                            echo '<td><button class="btn btn-primary" onclick="showEditCoin(' . $coin['id'] . ')">Edit</button> | <button class="btn btn-danger" href="delete-coin.php?id=' . $coin['id'] . '">Delete</button></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">No coin found</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                        <button class="btn btn-primary btn-print" data-print="coins">Print Coin</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </section>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
                        <h3>All Users</h3>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($user_list) > 0) {
                                        foreach ($user_list as $user) {
                                            echo '<tr>';
                                            echo '<td>' . $user['id'] . '</td>';
                                            echo '<td>' . $user['username'] . '</td>';
                                            echo '<td>' . $user['email'] . '</td>';
                                            echo '<td>' . ($user['role'] == 1 ? 'Admin' : 'User') . '</td>';
                                            echo '<td><a href="delete-user.php?id=' . $user['id'] . '">Ban</a> | <a href="edit-user.php?id=' . $user['id'] . '">Edit</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">No user found (Kinda Weird Lol, No User??? So... Who are you?)</td></tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button class="btn btn-primary btn-print" data-print="users">Print Users</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </section>
            <section>
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
                                    <?php
                                    function GetStatus($status)
                                    {
                                        switch ($status) {
                                            case 'Success':
                                                return '<span class="badge success">Success</span>';
                                            case 'Pending':
                                                return '<span class="badge warning">Pending</span>';
                                            case 'Failed':
                                                return '<span class="badge danger">Failed</span>';
                                            default:
                                                return '<span class="badge danger">Unknown</span>';
                                        }
                                    }
                                    $sql = 'SELECT * FROM tb_transactions;';
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['wallet_address'] . '</td>';
                                        echo '<td>' . $row['dest_wallet_address'] . '</td>';
                                        echo '<td>' . $coin_list[array_search($row['crypto'], array_column($coin_list, 'id'))]['name'] . '</td>';
                                        echo '<td>' . $row['txid'] . '</td>';
                                        echo '<td>' . GetStatus($row['status']) . '</td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">
                                            <button class="btn btn-primary btn-print" data-print="transactions">Print Transactions</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="modal" id="edit-coin-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" id="hide-edit-coin-modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-container" id="addWalletForm">
                        <div class="form-group">
                            <label for="walletAddress">Wallet Address</label>
                            <input type="text" id="walletAddress" name="walletAddress" class="form-control" placeholder="Enter Wallet Address">
                        </div>
                        <div class="form-group">
                            <button name="submit" type="submit" class="btn btn-primary">Add Wallet</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/wallet-address-validator.min.js"></script>
    <script src="/js/modal-manager.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.js"></script>
    <script>
        const modalManager = new ModalManager();
        const coinModal = new Modal('edit-coin-modal');

        document.getElementById("hide-edit-coin-modal").onclick = () => {
            modalManager.close(coinModal);
        }

        let showEditCoin = (id) => {
            let coin = <?= json_encode($coin_list) ?>.find(coin => coin.id === id);
            // document.getElementById('coinName').value = coin.name;
            // document.getElementById('coinStands').value = coin.stands;
            // document.getElementById('coinEndpoint').value = coin.api_endpoint;
            modalManager.open(coinModal);
        }

        document.querySelectorAll('.btn-print').forEach(btn => {
            btn.onclick = () => {
                let table = btn.getAttribute('data-print');
                window.open('print.php?table=' + table, '_blank');
            }
        });
    </script>
</body>
</html>