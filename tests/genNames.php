<?php

require_once "person.php";

$sire = new \sire\person;

for ($i = 0; $i < 1000; $i++)
{
	echo $sire->firstname([ 'gender' => 'Any' ]) . " " . $sire->lastname() . "\n";
}

?>
