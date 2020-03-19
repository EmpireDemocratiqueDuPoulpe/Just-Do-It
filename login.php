<?php
require_once "./init.php";

############################
# Check if user is connected
############################

if ($is_connected) redirectTo("./index.php");

############################
# Get errors and success messages
############################

$errorsSuccessMsg = getErrorsSuccess();

############################
# Import the view
############################

require_once "./views/login_v.php";