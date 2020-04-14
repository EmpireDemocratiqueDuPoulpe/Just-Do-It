<?php if (!isset($classes)) $classes = ""; ?>

<header class="<?= $classes ?>">
    <div id="logo"></div>

    <div id="user">
        <p><?= htmlspecialchars($_SESSION["username"]) ?></p>
        <div id="themeSwitcher">
            <i class="fas fa-moon"></i>
        </div>
        <a href="./php/disconnect_user.php" id="disconnect"><i class="fas fa-door-open"></i></a>
    </div>
</header>