<?php
require __DIR__ . '/bootstrap.php';
$title = 'Create New Account';
require __DIR__ . '/top.php';
?>


<?php require __DIR__ . '/msg.php' ?>
<?php require __DIR__ . '/menu.php' ?>
<div class="create">
    <form action="<?= URL ?>store.php" method="post">
        <h1>Create New Account</h1>
        <div class="form-row">
            <label for="name">Name:</label>
            <input type="text" name="name">
        </div>
        <div class="form-row">
            <label for="last">Last Name:</label>
            <input type="text" name="last">
        </div>
        <div class="form-row">
            <label for="sex">Sex:</label>
            <select name="sex">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="form-row">
            <label for="day">Day of Birth:</label>
            <select name="day">
                <?php foreach(range(1, 31) as $value) : ?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-row">
            <label for="month">Month of Birth:</label>
            <select name="month">
                <?php foreach(range(1, 12) as $value) : ?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-row">
            <label for="year">Year of Birth:</label>
            <select name="year">
                <?php foreach(range(1945, 2023) as $value) : ?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-row">
            <label for="email">Email:</label>
            <input type="email" name="email">
        </div>
        <div class="form-row">
            <label for="psw">Password:</label>
            <input type="password" name="psw">
        </div>
        <div class="form-row">
            <button class="green" type="submit">Create</button>
        </div>
    </form>
</div>


<?php
require __DIR__ . '/bottom.php';