<?php

require_once '../sire.php';
require_once 'tstFields.php';

$sire = new \sire\engine;

for ($i = 0; $i < 10; $i++)
{
	$sire->initialize($_testFields_);
	$obj = new stdClass();
	$sire->fill($obj);
	print_r($obj);
}

?>
