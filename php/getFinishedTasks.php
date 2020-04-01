<?php

############################
# Check if file was included
############################

if (!isset($is_included)) {
    require_once "../init.php";
    $data = json_decode(file_get_contents("php://input"));
    $list_id = $data[0] ?? null;
}

############################
# Get ongoing tasks
############################

// Init managers
$TasksManager = new Tasks($db);

// Get Todo lists and tasks
$list_tasks = $TasksManager->get($_SESSION["user_id"], $list_id, "finished");
$list_tasks_count = count($list_tasks);
$tasks_count = 0;

// HTML of tasks
$finished_task_html = "";

foreach ($list_tasks as $task) {

    // Get formatted task properties
    $task_id = $task["task_id"];
    $task_name = htmlspecialchars($task["name"]);
    $HTMLid = "l" . $list_id . "t" . $task_id;
    $class = $tasks_count + 1 == $list_tasks_count ? "task noBottomMargin" : "task";

    $finished_task_html .= '<li class="'.$class.'"><input type="checkbox" id="'.$HTMLid.'" checked/><label for="'.$HTMLid.'">'.$task_name.'</label></li>';

    $tasks_count++;
}

if (!isset($is_included)) echo $finished_task_html;