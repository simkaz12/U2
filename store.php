<?php
require __DIR__ . '/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405);    // Method Not Allowed
    die;
}

$name = $_POST['name'] ?? '';
$last = $_POST['last'] ?? '';
$sex = $_POST['sex'] ?? '';
$day = $_POST['day'] ?? '';
$month = $_POST['month'] ?? '';
$year = $_POST['year'] ?? '';
$email = $_POST['email'] ?? '';
$psw = $_POST['psw'] ?? '';

if (strlen($name) < 4) {
    $_SESSION['message'] = [
        'text' => 'Name must be at least 4 characters long!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'create.php');
    die;
}

if (strlen($last) < 4) {
    $_SESSION['message'] = [
        'text' => 'Last name must be at least 4 characters long!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'create.php');
    die;
}

if (strlen($psw) < 8) {
    $_SESSION['message'] = [
        'text' => 'Password must be at least 8 characters long!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'create.php');
    die;
}

function lastNums($num) {
    $res = '';
    $nums = '0123456789';
    foreach(range(1, $num) as $_) {
        $res .= $nums[(rand(0, 9))];
    }
    return $res;
}

function createPersonal($sex, $day, $month, $year) {
    $century = '';
    $sexNum = '';

    if ($year >= 1945 && $year <= 1999) {
        $century = "20";
    } else {
        $century = "21";
    }  

    if ($sex == "male") {
        $sexNum = ($century == "20") ? "3" : "5";
    } elseif ($sex == "female") {
        $sexNum = ($century == "20") ? "4" : "6";
    }

    $formatedDate = substr($year, -2) . str_pad($month, 2, '0', STR_PAD_LEFT) . str_pad($day, 2, '0', STR_PAD_LEFT);

    $last4 = lastNums(4);

    $personal = $sexNum . $formatedDate . $last4;

    return $personal;
}

function createIBAN() {
    $pre = '01';
    $accNum = $pre . lastNums(16);
    return $accNum;
}

$sasID = 'LT' . createIBAN();
$personal = createPersonal($sex, $day, $month, $year);

$accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);

$acc = [
    'id' => uniqid(),
    'name' => $name,
    'last' => $last,
    'personal' => $personal,
    'sasId' => $sasID,
    'email' => $email,
    'psw' => md5($psw),
    'sum' => 0,
    'role' => 1,
];

$accounts[] = $acc;
file_put_contents(__DIR__ . '/accounts.json', json_encode($accounts));

$_SESSION['message'] = [
    'text' => 'User account created!',
    'type' => 'limegreen'
];

header('Location: ' . URL . 'list.php');
die;