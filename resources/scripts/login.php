<?php
require "connect.php";

session_start();

if ($_SESSION["key"] != $_POST["key"]) {
	echo "401";
	exit();
}

$username = $_POST["username"];
$password = hash("sha512", $_POST["password"]);

$query_result = $mysqli->query("SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password'");
if ($query_result->num_rows != 1) {
	echo "401";
} else {
	echo "200";
	$_SESSION["username"] = $username;
	$_SESSION["password"] = $password;
}