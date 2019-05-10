<?php

require_once dirname(__FILE__) . '/../sire.php';
require_once dirname(__FILE__) . '/fieldData.php';

use PHPUnit\Framework\TestCase;

final class insertTest extends TestCase
{

        public function testGeneration()
        {
		global $_testFields_;

		$sire = new \sire\engine;

		for ($i = 0; $i < 10; $i++)
		{
			$sire->initialize($_testFields_);
			echo $sire->insert('test_table', 1000 + $i);
		}
	}
}

?>
