<?php
require_once(ROOT . "/config/config.php");

error_reporting(~0);
if (INDEVELOPMENT) {
	ini_set("display_errors", true);
} else {
	ini_set("display_errors", false);
}

function getAutoloadFileName ($name) {
	if (file_exists(ROOT . "/application/controllers/" . $name . ".php")) {
		return ROOT . "/application/controllers/" . $name . ".php";
	} else if (file_exists(ROOT . "/application/models/" . $name . ".php")) {
		return ROOT . "/application/models/" . $name . ".php";
	} else if (file_exists(ROOT . "/application/library/" . $name . ".php")) {
		return ROOT . "/application/library/" . $name . ".php";
	}
	return false;
}
function __autoload ($name) {
	$filename = getAutoloadFileName ($name);
	if (!$filename) return;
}