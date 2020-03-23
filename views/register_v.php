<!DOCTYPE html>

<html lang="fr">
    <head>
        <title>ProjetPHP - Inscription</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="./assets/css/normalize.css"/>
        <link rel="stylesheet" href="./assets/css/font-awesome.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans&display=swap"/>
        <link rel="stylesheet" href="./assets/css/main.css"/>
    </head>
    <body id="registerBody">
        <!-- Register container -->
        <div id="registerContainer">
            <!-- Title -->
            <div id="registerHeader">
                <h1>Inscription</h1>
            </div>

            <!-- Errors and success messages -->
            <?= $errorsSuccessMsg ?>

            <!-- Form -->
            <form action="./php/register_user.php" method="post" onsubmit="return checkForm(this)" <?php if($errorsSuccessMsg) echo 'class="errorMsgAbove"'?>>

                <!-- Username -->
                <div class="field">
                    <label for="rUsername">Nom d'utilisateur</label>
                    <input type="text" id="rUsername" name="username" placeholder=" " minlength="1" maxlength="32" onkeydown="this.setCustomValidity('');" required/>
                </div>

                <!-- E-mail -->
                <div class="field">
                    <label for="rEmail">E-mail</label>
                    <input type="email" id="rEmail" name="email" placeholder=" " minlength="5" maxlength="255" onkeydown="this.setCustomValidity('');" required/>
                </div>

                <!-- Passwords -->
                <div class="field double">
                    <div>
                        <label for="rPassword1">Mot de passe</label>
                        <input type="password" id="rPassword1" name="password1" placeholder=" " minlength="8" maxlength="255" onkeydown="this.setCustomValidity(''); document.getElementById('rPassword2').setCustomValidity('');" required/>
                    </div>

                    <div>
                        <label for="rPassword2">Mot de passe (r&eacute;p&eacute;ter)</label>
                        <input type="password" id="rPassword2" name="password2" placeholder=" " minlength="8" maxlength="255" onkeydown="this.setCustomValidity(''); document.getElementById('rPassword1').setCustomValidity('');" required/>
                    </div>
                </div>

                <input type="submit" value="INSCRIPTION"/>

                <p id="switchRegLog"><a href="./login.php">J'ai d&eacute;j&agrave; un compte.</a></p>
            </form>
        </div>

        <!-- Right image -->
        <div id="registerRightImg"></div>

        <!-- Scripts -->
        <script src="./assets/js/FormChecker.js"></script>
    </body>
</html>