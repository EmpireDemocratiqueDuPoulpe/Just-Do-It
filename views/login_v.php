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
    <body id="loginBody">
        <!-- Register container -->
        <div id="loginContainer">
            <!-- Title -->
            <div id="loginHeader">
                <h1>Connexion</h1>
            </div>

            <!-- Errors and success messages -->
            <?= $errorsSuccessMsg ?>

            <!-- Form -->
            <form action="./php/login_user.php" method="post" onsubmit="return checkForm(this)" <?php if($errorsSuccessMsg) echo 'class="errorMsgAbove"'?>>

                <!-- Username -->
                <div class="field">
                    <label for="lUsername">Nom d'utilisateur</label>
                    <input type="text" id="lUsername" name="username" placeholder=" " minlength="1" maxlength="32" onkeydown="this.setCustomValidity('');" required/>
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="lPassword">Mot de passe</label>
                    <input type="password" id="lPassword" name="password" placeholder=" " minlength="8" maxlength="255" onkeydown="this.setCustomValidity('');" required/>
                </div>

                <input type="submit" value="CONNEXION"/>

                <p id="switchRegLog"><a href="./register.php">Je n'ai pas de compte.</a></p>
            </form>
        </div>

        <!-- Right image -->
        <div id="loginRightImg"></div>

        <!-- Scripts -->
        <script src="./assets/js/FormChecker.js"></script>
    </body>
</html>