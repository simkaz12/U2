<?php
require __DIR__ . '/bootstrap.php';
if (!isset($_SESSION['login']) || $_SESSION['login'] != 1) {
    $_SESSION['message'] = [
        'text' => 'Please login first!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'login.php');
    die;
}

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);    // Method Not Allowed
    die;
}

if (!isset($_GET['id'])) {
    header('Location: ' . URL . 'login.php');
    die;
}

$sum = $_POST['sum'] ?? '';


if ($sum == '') {
    $_SESSION['message'] = [
        'text' => 'Please fill in all fields!',
        'type' => 'crimson'
    ];
   
    header('Location: ' . URL . 'add.php?id=' . $_GET['id'] . '');
    die;
}

$accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);





$find = false;
foreach ($accounts as $key => $c) {
    if ($c['id'] == $_GET['id']) {
        $find = true;
        $accounts[$key] = [
            'id' => $c['id'],
            'sum' => $hex,
            
        ];
        file_put_contents(__DIR__ . '/accounts.json', json_encode($accounts));
        break;
    }
}

$_SESSION['message'] = [
    'text' => $find ? 'Balance updated!' : 'Account not found!',
    'type' => $find ? 'limegreen' : 'crimson'
];

header('Location: ' . URL . 'list.php');
die;