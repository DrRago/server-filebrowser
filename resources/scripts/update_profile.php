<?php
require "connect.php";
if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {
	$password = hash( "sha512", $_POST["password"] );

	$query_result = $mysqli->query( "UPDATE `user` SET `password`='$password' WHERE `username`='$_SESSION[username]'" );

	if ( $_POST["redirect"] != "false" ) {
		header( "location: $_SERVER[HTTP_REFERER]" );
	} else {
		echo "true";
	}
}