<?php

############################
# Check if file was included
############################

if (!isset($is_included)) {
    require_once "../../init.php";
    $data = json_decode(file_get_contents("php://input"));
    $list_id = $data[0] ?? null;
}

############################
# Get ongoing tasks
############################

// Init managers
$TasksManager = new Tasks($db);

// Get Todo lists and tasks
$list_tasks = $TasksManager->get($_SESSION["user_id"], $list_id, "ongoing");
$list_tasks_count = count($list_tasks);
$tasks_count = 0;

// HTML of tasks
$ongoing_task_html = "";

foreach ($list_tasks as $task) {

    // Get formatted task properties
    $task_id = $task["task_id"];
    $task_name = htmlspecialchars($task["name"]);
    $task_status = $task["status"];
    $HTMLid = "l" . $list_id . "t" . $task_id;

    $ongoing_task_html .= '<li class="task" data-task-id="'.$task_id.'" data-task-status="'.$task_status.'">
                                <div class="tDeleteContainer ongoing">
                                    <i class="fas fa-trash"></i>
                                </div>
                                <input type="checkbox" id="'.$HTMLid.'"/>
                                <label for="'.$HTMLid.'">'.$task_name.'</label>
                           </li>';

    $tasks_count++;
}

$ongoing_task_html .= '<li class="task addTask noBottomMargin">
                            <input type="checkbox" id="addTask">
                            <label for="addTask">Ajouter une t&acirc;che</label>
                       </li>';

if (!isset($is_included)) echo $ongoing_task_html;