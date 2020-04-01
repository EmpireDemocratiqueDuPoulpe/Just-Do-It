<?php
require_once "../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

// Title
$list_id = $data[0] ?? null;
$name = $data[1] ?? null;
$status = (int) $data[2] ?? null;

############################
# Add todo list
############################

$TaskManager = new Tasks($db);
$message = "";

if ($TaskManager->add($_SESSION["user_id"], $list_id, $name, $status)) $message = "Tâche ajoutée !";
else $message = "Erreur pendant l'ajout de la tâche";

echo json_encode($message);