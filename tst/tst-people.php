<?php

require_once "../person.php";

$sire = new \sire\person;

for ($i = 0; $i < 50; $i++)
{
	$stateCode = $sire->stateCode();

	echo "\n". $sire->firstname([ 'gender' => 'Any' ]) . " " . $sire->lastname() . "\n";
	echo $sire->address() . "\n";
	echo $sire->city() . ', ' . $stateCode . ' ' . $sire->zipCode([ 'stateCode' => $stateCode ]) . "\n";
	echo $sire->phone([ 'formatted' => true ]) . "\n";
	echo '     Company: ' . $sire->company() . "\n";
	echo '    Birthday: ' . $sire->birthdate() . "\n";
	echo '    Username: ' . $sire->username() . "\n";
}

?>
