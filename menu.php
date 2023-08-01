<nav>
    <ul>
        <li><a href="<?= URL ?>index.php">Home</a></li>
        <li><a href="<?= URL ?>list.php">Account</a></li>
        <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 1) : ?>
            <li >
                <form action="<?= URL ?>logout.php" method="post">
                    <button type="submit">Logout, <?= $_SESSION['name'] ?></button>
                </form>
            </li>
        <?php elseif (isset($_SESSION['login']) && $_SESSION['login'] == 2): ?>
            <li >
                <form action="<?= URL ?>logout.php" method="post">
                    <button type="submit">Logout, <?= $_SESSION['name'] ?></button>
                </form>
            </li>
        <?php else : ?>
            <li ><a href="<?= URL ?>login.php">Login</a></li>
        <?php endif ?>
    </ul>
</nav>