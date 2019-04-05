<?php

require_once "../sire.php";

$text = new \sire\text;

for ($i = 0; $i < 10; $i++)
{
	echo $text->lorem([ 'length' => rand(40, 100) ]) . "\n\n";
}

?>
