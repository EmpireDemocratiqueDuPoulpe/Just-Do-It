<?php

############################
# Check if file was included
############################

if (!isset($is_included)) require_once "../../init.php";

############################
# Get data
############################

$data = json_decode(file_get_contents("php://input"));

$list_id = $data[0] ?? null;

############################
# Get friends which hasn't access to the list
############################

$FriendsManager = new Friends($db);
$friendsNotShared = $FriendsManager->getAllNotShared($_SESSION["user_id"], $list_id);
$friends_count = count($friendsNotShared);
$i = 1;

// Start output buffering
ob_start();

foreach ($friendsNotShared as $friend) {

    $user_id = htmlspecialchars($friend["user_id"]);
    $username = htmlspecialchars($friend["username"]);
    $classes = $i == $friends_count ? "shareFriend noBottomMargin" : "shareFriend";

    echo '<li class="'.$classes.'" data-friend-id="'.$user_id.'" data-list-id="'.$list_id.'">'.$username.'</li>';

    $i++;
}

// Get the content of output buffering and stop it.
$friendsHTML = ob_get_contents();
ob_end_clean();

if (!isset($is_included)) echo $friendsHTML;