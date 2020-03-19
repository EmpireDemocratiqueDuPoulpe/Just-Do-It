<!DOCTYPE>

<html lang="fr">
<head>
    <title>ProjetPHP - Connexion</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="./assets/css/normalize.css"/>
    <link rel="stylesheet" href="./assets/css/main.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans&display=swap"/>

</head>
<body id="registerBody">
<!-- Register container -->
<div id="registerContainer">
    <!-- Title -->
    <div id="registerHeader">
        <h1>Connexion</h1>
    </div>

    <!-- Errors and success messages -->
    <?= $errorsSuccessMsg ?>

    <!-- Form -->
    <form action="./php/login_user.php" method="post" <?php if($errorsSuccessMsg) echo 'class="errorMsgAbove"'?>>

        <!-- Username -->
        <div class="field">
            <label for="rUsername">Nom d'utilisateur</label>
            <input type="text" id="rUsername" name="username" placeholder=" " minlength="1" maxlength="32" required/>
        </div>

        <!-- Passwords -->
        <div class="field">
            <div>
                <label for="rPassword">Mot de passe</label>
                <input type="password" id="rPassword" name="password" placeholder=" " minlength="8" maxlength="255" required/>
            </div>

        </div>

        <input type="submit" value="CONNEXION"/>

        <p id="switchRegLog"><a href="./register.php">Je n'ai pas de compte.</a></p>
    </form>
</div>

<!-- Right image -->
<div id="registerRightImg"></div>
</body>
</html>