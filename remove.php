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
    header('Location: ' . URL . 'login.php');
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
    header('Location: ' . URL . 'login.php');
    die;
}

$title = 'Withdraw Funds';
require __DIR__ . '/top.php';

?>
<?php require __DIR__ . '/msg.php' ?>
<?php require __DIR__ . '/menu.php' ?>
<div class="create">
    <form action="<?= URL ?>minus.php?id=<?= $acc['id'] ?>" method="post">
        <h1>Withdraw Funds</h1>
        <div class="form-row">
            <div><?= $acc['name'] ?> <?= $acc['last'] ?></div>
            <div><?= $acc['sasId'] ?></div>
            <div class="form-row">
                <label for="sum">Amount:</label>
                <input type="text" name="sum">
            </div>
        </div>
        <div class="form-row">
            <button class="green" type="submit">Save</button>
            <a class="red" href="<?= URL ?>list.php">Cancel</a>
        </div>
    </form>
</div>
<?php
require __DIR__ . '/bottom.php';