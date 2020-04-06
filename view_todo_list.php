
<?php
require_once "./init.php";

############################
# Check if user is connected
############################

if (!$is_connected) redirectTo("./login.php");

############################
# Get the list id
############################

$list_id = isset($_GET["list_id"]) && !empty($_GET["list_id"]) ? $_GET["list_id"] : null;

if (!$list_id) {
    $_GET["error"] = TODO_LIST_NOT_FOUND;
}

############################
# Get the TODOList
############################

else {
    // Init managers
    $TodoListManager = new TodoLists($db);
    $TasksManager = new Tasks($db);

    // Get Todo list and tasks
    $todo_list = $TodoListManager->get($_SESSION["user_id"], $list_id)[0];
    $list_name = htmlspecialchars($todo_list["name"]);
    $list_color = htmlspecialchars($todo_list["color"]);
    $ongoing_task_html = "";
    $finished_task_html = "";

    if (!$todo_list) {
        $_GET["error"] = TODO_LIST_NOT_FOUND;
    } else {
        $is_included = true;
        require_once "./php/tasks/getOngoing.php";
        require_once "./php/tasks/getFinished.php";
    }
}

############################
# Get errors and success messages
############################

$errorsSuccessMsg = getErrorsSuccess();

############################
# Import the view
############################

require_once "./views/view_todo_list_v.php";