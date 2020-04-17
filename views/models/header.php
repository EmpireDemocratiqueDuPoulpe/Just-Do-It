<?php if (!isset($classes)) $classes = ""; ?>

<header class="<?= $classes ?>">
    <a id="webNameContainer" href="./index.php">
        <div id="logo"></div>
        <h1>Just Do It</h1>
    </a>

    <div id="user">
        <p><?= htmlspecialchars($_SESSION["username"]) ?></p>
        <div id="themeSwitcher">
            <i class="fas fa-moon"></i>
        </div>
        <a href="./php/disconnect_user.php" id="disconnect"><i class="fas fa-door-open"></i></a>
    </div>
</header>