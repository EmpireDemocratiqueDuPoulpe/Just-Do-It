<?php
/**
 * Disconnect a user.
 *
 * This will delete SESSION vars, cookies and stop the current session
 *
 * @author      Alexis L. <293287@supinfo>
 * @version     1.0
 * @see         init.php
 */

require_once "../init.php";

############################
# Destroy session
############################

$_SESSION = array();

// Completely erase the session and remove the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

if (session_status() === PHP_SESSION_ACTIVE) {

    if (!session_destroy()) redirectTo("../index.php?error=".CANNOT_DISCONNECT);
    else                    redirectTo("../login.php");

}