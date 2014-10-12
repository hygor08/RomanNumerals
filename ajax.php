<?php
$entryItem = $_REQUEST["q"];
require_once 'autoloader.php';
$output = new InputValidation();
$output->decipherStringType($entryItem); 
echo json_encode($output);