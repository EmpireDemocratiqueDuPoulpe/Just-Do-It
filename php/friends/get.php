<?php

############################
# Check if file was included
############################

if (!isset($is_included)) require_once "../../init.php";

############################
# Get Friends
############################

$FriendsManager = new Friends($db);
$friends = $FriendsManager->getAll($_SESSION["user_id"]);

// Start output buffering
ob_start();

foreach ($friends as $friend) {

    $friend_id = htmlspecialchars($friend["user_id"]);
    $friend_name = htmlspecialchars($friend["username"]);

    echo '<li class="friend" data-friend-id="'.$friend_id.'">'.$friend_name.'</li>';
}

echo '<li class="friend addFriend noBottomMargin"><i class="fas fa-user-plus"></i> Ajouter un ami</li>';

// Get the content of output buffering and stop it.
$friendsHTML = ob_get_contents();
ob_end_clean();

if (!isset($is_included)) echo $friendsHTML;