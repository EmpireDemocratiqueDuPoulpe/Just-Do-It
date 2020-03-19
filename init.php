<?php

############################
# Const
############################

define("ROOT", ($_SERVER['DOCUMENT_ROOT'] . "/ProjetPHP"));

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
 * PASSWORD_NOT_SECURE :    The password is not secure (1 lower case char, 1 upper case char, 1 number, 1 special char)
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
define("REGISTRATION_COMPLETE", 1);

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
