<?php
require __DIR__ . '/bootstrap.php';

if (!isset($_SESSION['login']) && $_SESSION['login'] != 2) {
    $_SESSION['message'] = [
        'text' => 'Only ADMIN allowed!',
        'type' => 'crimson'
    ];
    header('Location: ' . URL . 'index.php');
    die;
} 
$title = 'ADMIN';
require __DIR__ . '/top.php';
?>

<?php require __DIR__ . '/msg.php' ?>
<?php require __DIR__ . '/menu.php'; ?>

<div class="container">
    <h1>Account</h1>
    <?php $accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1) ?>
    <div class="countainer-acc">
        <div class="acc">
            <div class="info">Name</div>
            <div class="info num">Acc Number</div>
            <div class="info bal">Balance</div>
        </div>
        <?php foreach($accounts as $acc) : ?>
            <?php if ($acc['id'] != 'admin') : ?>
            <div class="acc">
                <div class="info"><?= $acc['name'] ?> <?= $acc['last'] ?></div>
                <div class="info numb"><?= $acc['numb'] ?></div>
                <div class="info balance"><?= $acc['sum'] ?></div>
            </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<?php 
require __DIR__ . '/bottom.php';