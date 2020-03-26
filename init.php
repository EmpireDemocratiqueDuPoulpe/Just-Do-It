<?php

############################
# Const
############################

define("ROOT", str_replace('\\', '/', __DIR__));

/** Register, login errors code
 *
 * USR_NOT_VALID :          Invalid/empty username
 * EMAIL_NOT_VALID :        Invalid/empty email
 * PASSWORD_NOT_VALID :     Invalid/empty password
 *
 * USR_ALREADY_USED :       The username is already taken
 * EMAIL_ALREADY_USED :     The email is already taken
 *
 * PASSWORD_DONT_MATCH :    The two passwords doesn't match
 * PASSWORD_NOT_SECURE :    The password is not secure (1 lower case char, 1 upper case char, 1 number, 1 special char, min 8 chars)
 * BAD_PASSWORD :           The password doesn't match the one is the database
 *
 * UNKNOWN_REGISTER_ERROR : Can't add the user in the database
 * UNKNOWN_USER :           Can't find the user
 *
 * CANNOT_DISCONNECT :      Cannot destroy the user's session
 */
define("USR_NOT_VALID", 1);
define("EMAIL_NOT_VALID", 2);
define("PASSWORD_NOT_VALID", 3);

define("USR_ALREADY_USED", 4);
define("EMAIL_ALREADY_USED", 5);

define("PASSWORD_DONT_MATCH", 6);
define("PASSWORD_NOT_SECURE", 7);
define("BAD_PASSWORD", 8);

define("UNKNOWN_REGISTER_ERROR", 20);
define("UNKNOWN_USER", 21);

define("CANNOT_DISCONNECT", 40);

/** Register, login success code
 *
 * REGISTRATION_COMPLETE :  User successfully registered
 */
define("REGISTRATION_COMPLETE", 100);

/** Todo lists errors code
 *
 * TODO_LIST_NOT_FOUND :    Invalid/empty username
 */
define("TODO_LIST_NOT_FOUND", 200);

############################
# Session
############################

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$is_connected = (isset($_SESSION["user_id"]) AND !empty($_SESSION["user_id"]));

############################
# Import config file
############################

$config = parse_ini_file(ROOT . "/config/config.ini", true);

############################
# Load classes
############################

function loadClasses($classname) { require_once ROOT . "/classes/$classname.php"; }
spl_autoload_register("loadClasses");

############################
# Connect to database
############################

$db = PDOFactory::mySql($config["DB"]["host"], $config["DB"]["dbname"], $config["DB"]["user"], $config["DB"]["password"]);

############################
# Functions
############################

/**
 * Redirect to the specified php file.
 *
 * This function redirects using the header()
 * function with the file path and GET variables
 * if specified. Then the PHP script is stopped
 * with exit().
 *
 * @author      Alexis
 * @version     1.0
 *
 * @function    redirectTo
 * @param       string      $filePath   Path to the php file
 * @return      void
 */
function redirectTo($filePath) {

    header("Location: $filePath");
    exit;
}

/**
 * Get error and success messages in link.
 *
 * This function get errors and success in
 * link and build a box with the corresponding
 * message.
 *
 * @author      Alexis
 * @version     1.0
 *
 * @function    getErrorsSuccess
 * @return      string              HTML code of messages box
 */
function getErrorsSuccess() {

    $messages = [
        USR_NOT_VALID => "Le nom d'utilisateur renseign&eacute; n'est pas valide <em>(max. 32 caract&egrave;res)</em>.",
        EMAIL_NOT_VALID => "L'email renseign&eacute; n'est pas valide. Veuillez respecter le format <em>\"locale@domaine.ext\"</em>.",
        PASSWORD_NOT_VALID => "Le mot de passe renseign&eacute; n'est pas valide <em>(une minuscule, une majuscule, un chiffre, un caract&egrave;re sp&eacute;cial, huit caract&egrave;res)</em>.",
        USR_ALREADY_USED => "Le nom d'utilisateur renseign&eacute; est d&eacute;j&agrave; utilis&eacute;.",
        EMAIL_ALREADY_USED => "L'email renseign&eacute; est d&eacute;j&agrave; utilis&eacute;.",
        PASSWORD_DONT_MATCH => "Les mots de passes ne correspondent pas.",
        PASSWORD_NOT_SECURE => "Le mot de passe n'est pas s&eacute;curis&eacute; <em>(une minuscule, une majuscule, un chiffre, un caract&egrave;re sp&eacute;cial, huit caract&egrave;res)</em>.",
        BAD_PASSWORD => "Le mot de passe renseign&eacute; n'est pas le bon.",
        UNKNOWN_REGISTER_ERROR => "Erreur inconnue, impossible de vous enregistrer. Veuillez r&eacute;essayer plus tard ou contactez le <a href=\"#\">support</a>.",
        UNKNOWN_USER => "Le nom d'utilisateur renseign&eacute; n'existe pas.",
        CANNOT_DISCONNECT => "Erreur inconnue, impossible de finaliser la d&eacute;connexion. Veuillez r&eacute;essayer plus tard ou contactez le <a href=\"#\">support</a>.",
        REGISTRATION_COMPLETE => "Inscription r&eacute;ussie ! Vous pouvez d&eacute;sormais vous connecter.",
        TODO_LIST_NOT_FOUND => "La todo list n'existe pas.<br><a href=\"./index.php\"><i class=\"fas fa-long-arrow-alt-left\"></i> Retour aux todo lists</a>",
        "none" => "<em>Un probl&egrave;me est survenu lors de l'affichage de ce message</em>"
    ];

    // Turn on output buffering
    ob_start();

    // Process errors
    if (isset($_GET["error"]) AND !empty($_GET["error"])) {

        ?>
            <div class="errorBox">
                <p><?= $messages[$_GET["error"]] ?? $messages["none"]; ?></p>
            </div>
        <?php
    }

    // Process success
    if (isset($_GET["success"]) AND !empty($_GET["success"])) {

        ?>
            <div class="successBox">
                <p><?= $messages[$_GET["success"]] ?? $messages["none"] ?></p>
            </div>
        <?php
    }

    // Get the final HTML code and stop the output buffering
    $errorsSuccessMsg = ob_get_contents();
    ob_end_clean();

    return $errorsSuccessMsg;
}