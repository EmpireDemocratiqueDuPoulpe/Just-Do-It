<header>
    <div id="logo"></div>

    <div id="user">
        <p><?= htmlspecialchars($_SESSION["username"]) ?></p>
        <a href="./php/disconnect_user.php" id="disconnect"><i class="fas fa-door-open"></i></a>
    </div>
</header>