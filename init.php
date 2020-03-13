<?php

############################
# Session
############################

if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }

$is_connected = (isset($_SESSION["id"]) AND !empty($_SESSION["id"]));

############################
# Import config file
############################

$config = parse_ini_file("./config/config.ini", true);

############################
# Load classes
############################

function loadClasses($classname) { require_once "./classes/$classname.php"; }
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
 * @param       string      $getVars    (optional) GET vars
 * @return      void
 */
function redirectTo($filePath, $getVars = "") {

    $getVars = empty($getVars) ? "" : "?" . $getVars;

    header("Location: $filePath$getVars");
    exit;
}
