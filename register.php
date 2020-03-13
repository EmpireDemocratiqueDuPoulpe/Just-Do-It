<?php
require_once "./init.php";

############################
# Check if user is connected
############################

if ($is_connected) redirectTo("./index.php");

############################
# Import the view
############################

require_once "./views/register_v.php";