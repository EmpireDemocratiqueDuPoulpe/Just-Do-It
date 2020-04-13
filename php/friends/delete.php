<?php
require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

$friend_id = $data[0] ?? null;

############################
# Delete friend
############################

$FriendsManager = new Friends($db);
$message = "";

if ($FriendsManager->delete($_SESSION["user_id"], $friend_id)) $message = "Ami supprimée !";
else $message = "Erreur pendant la suppression de l'ami";

echo json_encode($message);