<?php

require_once '../sire.php';
require_once 'tstFields.php';

$sire = new \sire\engine;

for ($i = 0; $i < 10; $i++)
{
	$sire->initialize($_testFields_);
	echo $sire->insert('test_table', 1000 + $i);
}

?>
