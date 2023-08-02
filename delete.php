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

if (!isset($_GET['id'])) {
    header('Location: ' . URL . 'list.php');
    die;
}

$accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1);

$acc = false;

foreach ($accounts as $a) {
    if ($a['id'] == $_GET['id']) {
        $acc = $a;
        break;
    }
}

if ($acc === false) {
    header('Location: ' . URL . 'list.php');
    die;
}
if ($acc['sum'] != '0') {
    $_SESSION['message'] = [
        'text' => 'You can\'t delete account that has funds!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'list.php');
    die;
}

$title = 'Confirm delete';
require __DIR__ . '/top.php';
?>
<?php require __DIR__ . '/menu.php' ?>
<div class="delete">
    <div class="confirm-delete confirm">
        <h3>Are you sure you want to delete this account?</h3>
        <h3><?= $acc['name'] ?> <?= $acc['last'] ?></h6>
        <div class="buttons">
            <form action="<?= URL ?>destroy.php?id=<?= $acc['id'] ?>" method="post">
                <button class="red" type="submit">Yes, delete!</button>
            </form>
            <a class="green" href="<?= URL ?>list.php">No, go back!</a>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/bottom.php';