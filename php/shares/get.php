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
# Get Shares of a list
############################

$SharesManager = new Shares($db);
$shares = $SharesManager->getAll($list_id);
$shares_count = count($shares);
$i = 1;

// Start output buffering
ob_start();

foreach ($shares as $share) {

    $user_id = $share["user_id"];
    $username = htmlspecialchars($share["username"]);
    $accepted = (int) $share["accepted"];

    // Process classes
    $classes = "shareFriend";

    if ($accepted == 0) $classes .= " notAccepted";
    if ($i == $shares_count) $classes .= " noBottomMargin";

    echo '<li class="'.$classes.'" data-friend-id="'.$user_id.'" data-list-id="'.$list_id.'">'.$username.'</li>';

    $i++;
}

// Get the content of output buffering and stop it.
$sharesHTML = ob_get_contents();
ob_end_clean();

if (!isset($is_included)) echo $sharesHTML;