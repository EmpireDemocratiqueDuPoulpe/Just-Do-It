<?php
require_once "../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

$task_id = $data[0] ?? null;

############################
# Delete task
############################

$TasksManager = new Tasks($db);
$message = "";

if ($TasksManager->delete($task_id)) $message = "Tâche supprimée !";
else $message = "Erreur pendant la suppression de la tâche";

echo json_encode($message);