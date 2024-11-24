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

if(!isset($_GET['table']))
{
    header('Location: admin.php');
    exit();
}

$table = $_GET['table'];

switch($table) {
    case 'users':
        $sql = 'SELECT * FROM tb_users';
        $title = 'Users';
        break;
    case 'transactions':
        $sql = 'SELECT * FROM tb_transactions';
        $title = 'Transactions';
        break;
    case 'wallets':
        $sql = 'SELECT * FROM tb_wallets';
        $title = 'Wallets';
        break;
    case 'coins':
        $sql = 'SELECT * FROM tb_coins';
        $title = 'Coins';
        break;
    default:
        header('Location: admin.php');
        exit();
}

$result = $conn->query($sql);

$html = '<center><h3>Data ' . $title . '</h3></center>';
$html .= '<table border="1" width="100%" cellpadding="5" cellspacing="0">';

$field = $result->fetch_fields();
$html .= '<tr>';
foreach($field as $f) {
    $html .= '<th>' . $f->name . '</th>';
}
$html .= '</tr>';

while($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    foreach($row as $r) {
        $html .= '<td>' . $r . '</td>';
    }
    $html .= '</tr>';
}

$html .= '</table>';

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($html);

$dompdf->setPaper('A3', 'landscape');

$dompdf->render();

$dompdf->stream('data_' . $table . '.pdf');

?>

