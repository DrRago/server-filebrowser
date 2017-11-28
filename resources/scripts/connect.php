<?php
$mysqli = new mysqli( "localhost", "leonhard", "oosae1ch", "filebrowser" );

if ( ! $mysqli ) {
	die( "Connection Failed" );
}
