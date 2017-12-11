<?php

function createLog($file) {
	require "connect.php";

	$query_result = $mysqli->query( "INSERT INTO `delete_history`(`username`, `file`) VALUES ('$_SESSION[username]', '$file')" );
}