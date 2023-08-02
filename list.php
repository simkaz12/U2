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
$title = 'Accounts';
require __DIR__ . '/top.php';
?>

<?php require __DIR__ . '/msg.php' ?>
<?php require __DIR__ . '/menu.php'; ?>

<div class="container">
    <h1>Account</h1>
    <?php $accounts = json_decode(file_get_contents(__DIR__ . '/accounts.json'), 1) ?>
    <div class="countainer-acc">
        <?php foreach($accounts as $acc) : ?>
            <?php if ($_SESSION['id'] == $acc['id']) : ?>
                <div class="form-row">    
                    <div><?= $acc['name'] ?> <?= $acc['last'] ?></div>
                </div>
                <div class="form-row sas">
                    <div><?= $acc['sasId'] ?></div>
                </div>
                <div class="form-row">
                    <div>Likutis: <?= $acc['sum'] ?>&euro;</div>
                    <a class="green" href="<?= URL ?>add.php?id=<?= $acc['id'] ?>">Add</a>
                    <a class="green" href="<?= URL ?>remove.php?id=<?= $acc['id'] ?>">Withdraw</a>
                    <a class="red" href="<?= URL ?>delete.php?id=<?= $acc['id'] ?>">Delete</a>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<?php 
require __DIR__ . '/bottom.php';