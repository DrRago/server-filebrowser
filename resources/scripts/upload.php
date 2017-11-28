<?php
session_start();
if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {

	$target_dir    = "../../uploads/";
	$target_file   = $target_dir . basename( $_FILES["fileToUpload"]["name"] );
	$uploadOk      = 1;
	$imageFileType = pathinfo( $target_file, PATHINFO_EXTENSION );

	if ( move_uploaded_file( $_FILES["fileToUpload"]["tmp_name"], $target_file ) ) {
		header( "location: $_SERVER[HTTP_REFERER]" );
	}
}