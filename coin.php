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
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['id']) && isset($_POST['action'])) {
        $id = $_POST['id'];
        switch($_POST['action']) {
            case "update" : {
                $data = [];
                if(isset($_POST['name'])) {
                    $data['name'] = $_POST['name'];
                }
                if(isset($_POST['stands'])) {
                    $data['stands'] = $_POST['stands'];
                }
                if(isset($_POST['endpoint'])) {
                    $data['api_endpoint'] = $_POST['endpoint'];
                }
                if(isset($_FILES['icon'])) {
                    $icon = $_FILES['icon'];
                    $icon_name = $icon['name'];
                    $icon_tmp = $icon['tmp_name'];
                    $icon_size = $icon['size'];
                    $icon_error = $icon['error'];
                    $icon_ext = explode('.', $icon_name);
                    $icon_actual_ext = strtolower(end($icon_ext));
                    $allowed = ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'];
                    if (in_array($icon_actual_ext, $allowed)) {
                        if ($icon_error === 0) {
                            if ($icon_size < 1000000) {
                                $icon_name_new = uniqid('', true) . '.' . $icon_actual_ext;
                                $icon_destination = 'uploads/' . $icon_name_new;
                                move_uploaded_file($icon_tmp, $icon_destination);
                                $data['image'] = $icon_destination;
                            }
                        }
                    }
                }
                $sql = 'UPDATE tb_coins SET ';
                $params = [];
                foreach($data as $key => $value) {
                    $params[] = $key . ' = "' . $value . '"';
                }
                $sql .= implode(', ', $params);
                $sql .= ' WHERE id = ' . $id;
                try {
                    $conn->query($sql);
                    echo json_encode(['status' => 'success']);
                } catch (Exception $e) {
                    if(isset($icon_destination)) {
                        unlink($icon_destination); // delete the uploaded file
                    }
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
                die();
            }
            case "del" : {
                $sql = 'SELECT image FROM tb_coins WHERE id = ' . $id;
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $icon = $row['image'];
                $sql = 'DELETE FROM tb_coins WHERE id = ' . $id;
                try {
                    $conn->query($sql);
                    unlink($icon); // delete the uploaded file
                    echo json_encode(['status' => 'success']);
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
                die();
            }
        }
    }
    $crypto = $_POST['name'];
    $stands = $_POST['stands'];
    $endpoint = $_POST['endpoint'];
    $icon = $_FILES['icon'];
    $icon_name = $icon['name'];
    $icon_tmp = $icon['tmp_name'];
    $icon_size = $icon['size'];
    $icon_error = $icon['error'];
    $icon_ext = explode('.', $icon_name);
    $icon_actual_ext = strtolower(end($icon_ext));
    $allowed = ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'];
    if (in_array($icon_actual_ext, $allowed)) {
        if ($icon_error === 0) {
            if ($icon_size < 1000000) {
                $icon_name_new = uniqid('', true) . '.' . $icon_actual_ext;
                $icon_destination = 'uploads/' . $icon_name_new;
                move_uploaded_file($icon_tmp, $icon_destination);
                try {
                    $sql = 'INSERT INTO tb_coins (name, stands, api_endpoint, image) VALUES (?, ?, ?, ?);';
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('ssss', $crypto, $stands, $endpoint, $icon_destination);
                    $stmt->execute();
                    echo json_encode(['status' => 'success']);
                } catch (Exception $e) {
                    unlink($icon_destination); // delete the uploaded file
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'File size too large']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error uploading file']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
    }
    die();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
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
            
            <h2 class="dash-title">Coin</h2>
            <section class="recent">
                <div class="activity-grid">
                    <div class="activity-card">
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
                                    if(count($coin_list) > 0) {
                                        foreach($coin_list as $coin) {
                                            echo '<tr>';
                                            echo '<td>' . $coin['id'] . '</td>';
                                            echo '<td>' . $coin['name'] . '</td>';
                                            echo '<td><img src="' . $coin['image'] . '" alt="' . $coin['name'] . '" width="50"></td>';
                                            echo '<td>' . $coin['stands'] . '</td>';
                                            echo '<td>' . $coin['api_endpoint'] . '</td>';
                                            echo '<td><a href="coin.php?id=' . $coin['id'] . '&action=edit">Edit</a> | <a href="coin.php?id=' . $coin['id'] . '&action=del">Delete</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">No coin found</td></tr>';
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
                        <h3>Add Coin</h3>
                        <form class="form-container" id="add-coin">
                            <div class="form-group">
                                <label for="name">Crypto</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Crypto Name">
                            </div>
                            <div class="form-group">
                                <label for="stands">Stands</label>
                                <input type="text" id="stands" name="stands" class="form-control" placeholder="Enter Stands">
                            </div>
                            <div class="form-group">
                                <label for="endpoint">Endpoint</label>
                                <input type="text" id="endpoint" name="endpoint" class="form-control" placeholder="Enter Endpoint">
                            </div>
                            <div class="form-group">
                                <label for="icon">Image</label>
                                <input type="file" id="icon" name="image" class="form-control">
                                <small>Allowed file types: jpg, jpeg, png, svg, gif, webp</small>
                            </div>
                            <div class="form-group">
                                <button name="submit" type="submit" class="btn btn-primary">Add Coin</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </section>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script>
        const addCoinForm = document.getElementById('add-coin');
        addCoinForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const stands = document.getElementById('stands').value;
            const endpoint = document.getElementById('endpoint').value;
            const icon = document.getElementById('icon').files[0];
            const formData = new FormData();
            formData.append('name', name);
            formData.append('stands', stands);
            formData.append('endpoint', endpoint);
            formData.append('icon', icon);
            const response = await fetch('coin.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Coin Added Successfully',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(() => {
                    window.location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Add Coin',
                    text: result.message,
                });
            }
        });
    </script>
</body>
</html>