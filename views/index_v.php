<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>ProjetPHP - Connexion</title>
        <?php include_once(ROOT."/views/models/head.php"); ?>
    </head>
    <body>
        <!-- Header -->
        <?php include_once(ROOT."/views/models/header.php"); ?>

        <!-- Todo list -->
        <div id="todoListContainer">
            <?= $todoListsHTML; ?>
        </div>

        <!-- Friends list -->
        <div id="friendList">
            <div id="friendListGradientBg">
                <div  id="friendListGradientBorder">
                    <div id="friendListHead">
                        <h3>Amis</h3>
                    </div>

                    <div id="friendListBody">
                        <ul>
                            <?= $friendsHTML ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="./assets/js/bluebird.min.js"></script>
        <script src="./assets/js/AJAX.js"></script>
        <script src="./assets/js/TodoList.js"></script>
        <script src="./assets/js/Tasks.js"></script>
    </body>
</html>