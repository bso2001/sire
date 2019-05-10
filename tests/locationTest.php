<?php

require_once dirname(__FILE__) . '/../geodata.php';

use PHPUnit\Framework\TestCase;

final class locationTest extends TestCase
{
        public function testGeneration()
        {
		$sire = new \sire\geodata;

		for ($i = 0; $i < 50; $i++)
		{
			$stateCode = $sire->stateCode();
			echo "\n" ;
			echo $sire->address() . "\n";
			echo $sire->city() . ', ' . $stateCode . ' ' . $sire->zipCode([ 'stateCode' => $stateCode ]) . "\n";
			echo $sire->phone([ 'formatted' => true ]) . "\n";
		}
	}
}

?>
