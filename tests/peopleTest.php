<?php

require_once dirname(__FILE__) . '/../person.php';

use PHPUnit\Framework\TestCase;

final class peopleTest extends TestCase
{
        public function testGeneration()
        {
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
	}
}

?>
