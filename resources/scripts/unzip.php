<?php
session_start();
if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {
	$file = "../../" . $_POST["file"];

// get the absolute path to $file
	$path = pathinfo( realpath( $file ) );
	$path = $path["dirname"] . "/" . $path["filename"];

	$zip = new ZipArchive;
	$res = $zip->open( $file );
	if ( $res === true ) {
		// extract it to the path we determined above
		$zip->extractTo( $path );
		$zip->close();
	}
}