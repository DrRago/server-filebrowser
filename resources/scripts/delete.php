<?php
session_start();
if ( isset( $_SESSION["username"] ) and isset( $_SESSION["password"] ) and isset( $_SESSION["key"] ) ) {

	$path = "../../" . $_POST["path"];

	if ( is_dir( "../../" . substr( $path, 11 ) ) ) {
		$path = "../../" . substr( $path, 11 );
	}
	$path = realpath( $path );

	if ( ! remove( $path ) ) {
		include "deletionlog.php";
		createLog( $path );

		header( "location: $_SERVER[HTTP_REFERER]" );
	} else {
		echo getPersissionDenied();
	}
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

	return file_exists( $pathname );
}

function getPersissionDenied() {
	$permission_denied_page = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">

<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">

<head>
  <meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />
  <meta http-equiv=\"refresh\" content=\"3;URL='" . $_SERVER["HTTP_REFERER"] ."'\" />    
  <title>Access forbidden (403)</title>
  <style type=\"text/css\">
    body { background-color: #fff; color: #666; text-align: center; font-family: arial, sans-serif; }
    div.dialog {
      width: 25em;
      padding: 0 4em;
      margin: 4em auto 0 auto;
      border: 1px solid #ccc;
      border-right-color: #999;
      border-bottom-color: #999;
    }
    h1 { font-size: 100%; color: #f00; line-height: 1.5em; }
  </style>
</head>

<body>
  <!-- This file lives in public/403.html -->
  <div class=\"dialog\">
    <h1>Access forbidden.</h1>
  </div>
</body>
</html>
";

	return $permission_denied_page;
}