<?php
/**
 * Update a list.
 *
 * This script get POST vars sent by the form and update the name and the color of the list.
 *
 * @author      Alexis L. <293287@supinfo>
 * @version     1.0
 * @see         init.php
 */

require_once "../../init.php";

############################
# Check vars
############################

$id = $_POST["id"] ?? null;
$name = $_POST["name"] ?? null;
$color = $_POST["color"] ?? null;

if (is_null($id) OR is_null($name) OR is_null($color))
    redirectTo("../../view_todo_list.php?list_id=0&error=".CANNOT_UPDATE_LIST);

############################
# Check name
############################

// Check length
$nameLen = strlen($name);

if ($nameLen < 1 OR $nameLen > 32) { redirectTo("../../view_todo_list.php?list_id=$id&error=".LIST_NAME_NOT_VALID); }

############################
# Check color
############################

$color_names = ["purple", "blue", "red", "orange", "pinkorange", "coral", "yellow", "green", "grey", "black"];

if (!in_array($color, $color_names))    {$color = "pinkorange";}

############################
# Update list
############################

// Update
$TodoListsManager = new TodoLists($db);

if ($TodoListsManager->update($id, $name, $color))  { redirectTo("../../view_todo_list.php?list_id=$id");}
else                                                { redirectTo("../../view_todo_list.php?list_id=$id&error=".CANNOT_UPDATE_LIST); }