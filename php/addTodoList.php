<?php
require_once "../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

// Title
$title = $data[0] ?? null;
$color = $data[1] ?? null;

############################
# Add todo list
############################

$TodoListManager = new TodoLists($db);
$message = "";

if ($TodoListManager->add($title, $_SESSION["user_id"], $color)) $message = "Todo list ajoutée !";
else $message = "Erreur pendant l'ajout de la todo list";

echo json_encode($message);