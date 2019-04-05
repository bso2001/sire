<?php

require_once "../geodata.php";

$sire = new \sire\geodata;

for ($i = 0; $i < 50; $i++)
{
	$stateCode = $sire->stateCode();
	echo "\n" ;
	echo $sire->address() . "\n";
	echo $sire->city() . ', ' . $stateCode . ' ' . $sire->zipCode([ 'stateCode' => $stateCode ]) . "\n";
	echo $sire->phone([ 'formatted' => true ]) . "\n";
}

?>
