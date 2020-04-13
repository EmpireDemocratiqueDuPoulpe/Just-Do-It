<?php
require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

// User name or e-mail
$user = $data[0] ?? null;

############################
# Determinate user input type and add friend
############################

$FriendsManager = new Friends($db);
$message = "";

// Add by e-mail or username
if (filter_var($user, FILTER_VALIDATE_EMAIL))
    $returnValue = $FriendsManager->addByEmail($_SESSION["user_id"], $user);
else
    $returnValue = $FriendsManager->addByUsername($_SESSION["user_id"], $user);

// Return a message
if ($returnValue)   $message = "Ami ajoutée !";
else                $message = "Erreur pendant l'ajout de l'ami";

echo json_encode($message);