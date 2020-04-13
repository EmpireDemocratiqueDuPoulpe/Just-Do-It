<?php
require_once "./init.php";

############################
# Check if user is connected
############################

if (!$is_connected) redirectTo("./login.php");

############################
# Get TODOList
############################

$is_included = true;
require_once "./php/todoLists/get.php";

############################
# Get friends
############################

$FriendsManager = new Friends($db);
$friends = $FriendsManager->getAll($_SESSION["user_id"]);

ob_start();

foreach ($friends as $friend) {
    $friend_id = $friend["user_id"];
    $friend_name = $friend["username"];

    echo '<li class="friend" data-friend-id="'.$friend_id.'">'.$friend_name.'</li>';
}

$friendsHTML = ob_get_contents();
ob_end_clean();

############################
# Import the view
############################

require_once "./views/index_v.php";