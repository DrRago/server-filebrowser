<?php
$file = "../../" . $_POST["file"];

// get the absolute path to $file
$path = pathinfo(realpath($file));
$path = $path["dirname"] . "/" . $path["filename"];

$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
	// extract it to the path we determined above
	$zip->extractTo($path);
	$zip->close();
}