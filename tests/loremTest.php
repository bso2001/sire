<?php

require_once dirname(__FILE__) . '/../sire.php';

use PHPUnit\Framework\TestCase;

final class loremTest extends TestCase
{
        public function testGeneration()
        {
		$text = new \sire\text;

		for ($i = 0; $i < 10; $i++)
		{
			echo $text->lorem([ 'length' => rand(40, 100) ]) . "\n\n";
		}
	}
}

?>
