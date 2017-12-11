<?php
session_start();
$_SESSION = array();
session_destroy();
header( "Location: https://$_SERVER[SERVER_NAME]/login.php" );