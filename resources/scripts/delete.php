<?php
session_start();
if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {

	$path = "../../" . $_POST["path"];

	if ( is_dir( "../../" . substr( $path, 11 ) ) ) {
		$path = "../../" . substr( $path, 11 );
	}
	$path = realpath( $path );
	remove( $path );

	include "deletionlog.php";

	createLog($path);

	header( "location: $_SERVER[HTTP_REFERER]" );

}

function remove( $pathname ) {
	if ( is_file( $pathname ) ) {
		unlink( $pathname );
	} elseif ( is_dir( $pathname ) ) {
		foreach ( array_diff( scandir( $pathname ), array( '..', '.' ) ) as $file ) {
			remove( $pathname . "/" . $file );
		}
		if ( strpos( $pathname, 'upload' ) !== false ) {
			rmdir( $pathname );
		}
	}
}