<?php
session_start();
$_SESSION = array();
session_destroy();

$responseToAjax = array(
	"success" => true
);

echo json_encode($responseToAjax);