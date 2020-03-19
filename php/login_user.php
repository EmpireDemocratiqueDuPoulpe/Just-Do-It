<?php
/**
 * Log in a user.
 *
 * This script get POST vars sent by the form and log in the user if everything is good. All const are referenced in
 * init.php.
 *
 * @author      Louan L. <292440@supinfo>
 * @version     1.0
 * @see         init.php
 */

require_once "../init.php";

############################
# Check vars
############################

$username = $_POST["username"] ?? null;
$password = $_POST["password"] ?? null;

if (is_null($username))     { redirectTo("../login.php?error=".USR_NOT_VALID); }
if (is_null($password))     { redirectTo("../login.php?error=".PASSWORD_NOT_VALID); }

############################
# Get user
############################

$user = PDOFactory::sendQuery($db, 'SELECT user_id, username, email, password FROM users WHERE username = :username', ["username" => $username])[0];

if (!$user) {
    redirectTo("../login.php?error=".UNKNOWN_USER);
}

############################
# Check password
############################

$password_peppered = hash_hmac("sha256", $password, $config["SECURITY"]["pepper"]);

if (!password_verify($password_peppered, $user["password"])) {
    redirectTo("../login.php?error=".BAD_PASSWORD);
}

############################
# Connect user
############################

$_SESSION["user_id"] = $user["user_id"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];

redirectTo("../index.php");