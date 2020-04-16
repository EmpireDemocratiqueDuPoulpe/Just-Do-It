<?php
require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

// List ID and user ID
$list_id = $data[0] ?? null;
$user_id = $data[1] ?? null;

############################
# Get the user's email
############################

$UsersManager = new Users($db);
$email = $UsersManager->getEmail($user_id);

############################
# Add the user to the list
############################

$SharesManager = new Shares($db);
$message = "";

if ($SharesManager->add($list_id, $user_id)) {
    $message = "Partage ajouté !";
    Mail::sendShareConfirmation($_SESSION["username"], $email, $list_id, $user_id);
} else $message = "Erreur pendant la création du partage";

echo json_encode($message);