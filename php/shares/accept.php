<?php
require_once "../../init.php";

############################
# Get data
############################

// List ID and user ID
$list_id = $_GET["list_id"] ?? null;
$user_id = $_GET["user_id"] ?? null;

############################
# Accept the share
############################

$SharesManager = new Shares($db);

if ($SharesManager->accept($list_id, $user_id)) redirectTo("../../index.php");
else redirectTo("../../index.php?error=".CANNOT_ACCEPT_SHARE);