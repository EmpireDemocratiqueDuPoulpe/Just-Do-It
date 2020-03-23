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

            <div class="todoList">
                <div class="tlHead">
                    <p>Titre de la todo list</p>
                </div>
                <div class="tlBody">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum gravida magna
                        sollicitudin molestie. Etiam eget arcu sed metus lobortis volutpat. Curabitur finibus, ipsum non
                        vestibulum ultrices, quam ante scelerisque sem, non pellentesque lorem nisl quis purus. Aenean et
                        lectus rutrum sem euismod lacinia sed at nibh. Nulla facilisi. Nulla at nisi lacus. Nunc in justo
                        vel sapien maximus luctus a sed mauris. Aenean eleifend iaculis massa, vitae fermentum tortor
                        laoreet eget. Nulla nec commodo ex. Nunc quis nulla in nibh vulputate tempor. In tempor non ipsum
                        ac tempor. Pellentesque sapien nisl, tristique vel quam eu, blandit sollicitudin ligula. Fusce
                        viverra, ipsum sit amet imperdiet efficitur, dolor libero ullamcorper nisl, non tincidunt neque
                        magna vel dolor. Maecenas facilisis metus sit amet magna rhoncus, id feugiat massa tempor. Quisque
                        sodales dictum porta. Morbi sed lectus odio.
                    </p>
                </div>
            </div>

        </div>
    </body>
</html>