<?php
require "connect.php";

session_start();

$password = hash("sha512", $_POST["password"]);

$query_result = $mysqli->query("UPDATE `user` SET `password`='$password' WHERE `username`='$_SESSION[username]'");

if ($_POST["redirect"] != "false") {
	header( "location: $_SERVER[HTTP_REFERER]" );
} else {
	echo "true";
}