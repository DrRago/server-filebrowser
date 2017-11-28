<?php
$path = "../../" . $_POST["path"];

if ( is_dir( "../../" . substr( $path, 11 ) ) ) {
	$path = "../../" . substr( $path, 11 );
}
remove( $path );

function remove( $pathname ) {
	if ( is_file( $pathname ) ) {
		if ( strpos( $pathname, 'upload' ) !== false ) {
			unlink( $pathname );
		}
	} elseif ( is_dir( $pathname ) ) {
		foreach ( scandir( $pathname ) as $file ) {
			remove( $pathname . "/" . $file );
		}
		if ( strpos( $pathname, 'upload' ) !== false ) {
			rmdir( $pathname );
		}
	}
}