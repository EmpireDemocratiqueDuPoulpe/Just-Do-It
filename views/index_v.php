<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>ProjetPHP - Connexion</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="./assets/css/normalize.css"/>
        <link rel="stylesheet" href="./assets/css/font-awesome.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans&display=swap"/>
        <link rel="stylesheet" href="./assets/css/main.css"/>
    </head>
    <body>
        <!-- Header -->
        <header>
            <div id="logo"></div>

            <div id="user">
                <p><?= htmlspecialchars($_SESSION["username"]) ?></p>
                <a href="./php/disconnect_user.php" id="disconnect"><i class="fas fa-door-open"></i></a>
            </div>
        </header>

        <!-- Todo list -->
        <div id="todoListContainer">
            <?= $todoListsHTML; ?>
        </div>
    </body>
</html>