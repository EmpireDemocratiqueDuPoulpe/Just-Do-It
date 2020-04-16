<?php
require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

$task_id = $data[0] ?? null;
$newStatus = $data[1] ?? null;
$newStatus = (int) $newStatus == 0 ? 1 : 0;

############################
# Delete task
############################

$TasksManager = new Tasks($db);
$message = "";

if ($TasksManager->changeStatus($task_id, $newStatus)) $message = "Tâche modifiée !";
else $message = "Erreur pendant la modification de la tâche";

echo json_encode($newStatus);