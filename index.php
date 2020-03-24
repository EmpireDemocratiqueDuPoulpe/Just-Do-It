<?php
require_once "./init.php";

############################
# Check if user is connected
############################

if (!$is_connected) redirectTo("./login.php");

############################
# Get TODOList
############################

// Init managers
$TodoListsManager = new TodoLists($db);
$TasksManager = new Tasks($db);

// Get Todo lists and tasks
$todoLists = $TodoListsManager->getAll($_SESSION["user_id"]);
$tasksList = $TasksManager->getAll($_SESSION["user_id"]);

// Start output buffering
ob_start();

foreach ($todoLists as $todoList) {

    // Get formatted todo list properties
    $todo_id = $todoList["list_id"];
    $todo_name = htmlspecialchars($todoList["name"]);
    $todo_color = strlen($todoList["color"]) != 0 ? htmlspecialchars($todoList["color"]) : "grey";
    $todo_tasks = array_keys(array_column($tasksList, 'list_id'), $todo_id);

    // Process HTML code of the todo list
    ?>
        <div class="todoList <?= $todo_color ?>">
            <div class="tlHead">
                <h2><?= $todo_name ?></h2>
            </div>
            <div class="tlBody">
                <ul>
                    <?php
                        $tasks_limit = 4;
                        $tasks_count = 0;

                        // Add tasks
                        foreach ($todo_tasks as $task) {

                            // Prevent to display too many tasks
                            if ($tasks_count == $tasks_limit) break;

                            // Get formatted task properties
                            $task = $tasksList[$task];
                            $task_id = $task["task_id"];
                            $task_name = htmlspecialchars($task["name"]);
                            $task_status = $task["status"] == "1" ? "checked" : "";
                            $HTMLid = "l" . $todo_id . "t" . $task_id;

                            echo '<li><input type="checkbox" id="'.$HTMLid.'" '.$task_status.'/><label for="'.$HTMLid.'">'.$task_name.'</label></li>';

                            $tasks_count++;
                        }
                    ?>
                </ul>
            </div>
        </div>
    <?php
}

// Get the content of output buffering and stop it.
$todoListsHTML = ob_get_contents();
ob_end_clean();

############################
# Import the view
############################

require_once "./views/index_v.php";