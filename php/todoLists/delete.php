<?php
require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

$list_id = $data[0] ?? null;

############################
# Delete todo list
############################

$TodoListManager = new TodoLists($db);
$message = "";

if ($TodoListManager->delete($list_id)) $message = "Todo list supprimée !";
else $message = "Erreur pendant la suppression de la todo list";

echo json_encode($message);