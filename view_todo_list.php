
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

    // Get Todo lists and tasks
    $todo_list = $TodoListManager->get($_SESSION["user_id"], $list_id)[0];
    $list_name = htmlspecialchars($todo_list["name"]);
    $list_color = htmlspecialchars($todo_list["color"]);
    $list_tasks = [];

    if (!$todo_list) {
        $_GET["error"] = TODO_LIST_NOT_FOUND;
    } else {
        $list_tasks = $TasksManager->getAll($_SESSION["user_id"]);
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