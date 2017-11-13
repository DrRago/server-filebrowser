<?php
session_start();

if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {
	if ( $_SERVER["REQUEST_URI"] == "/filebrowser/login.php" ) {
		header( "Location: https://$_SERVER[SERVER_NAME]/filebrowser/browse.php" );
	}
} else {
	if ( $_SERVER["REQUEST_URI"] != "/filebrowser/login.php" ) {
		header( "Location: https://$_SERVER[SERVER_NAME]/filebrowser/login.php" );
	}
}
