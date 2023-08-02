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
    <h1>Accounts</h1>
    <?php $accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1) ?>
    <div class="countainer-acc">
        <?php foreach($accounts as $acc) : ?>
            <?php if ($acc['id'] != 'admin') : ?>
                <div class="underline">    
                    <div><?= $acc['name'] ?> <?= $acc['last'] ?> <span class="pasitrauk"><?= $acc['personal'] ?></span> <span class="pasitrauk"><?= $acc['sasId'] ?></span> <span class="pasitrauk">Balance: <?= $acc['sum'] ?>&euro;</span></div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<?php 
require __DIR__ . '/bottom.php';