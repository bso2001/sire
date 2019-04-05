<?php

namespace sire;

require_once "sire.php";

class text
{
	private static $lwords = 
	[
		'a', 'ac', 'accumsan', 'ad', 'adipiscing', 'aenean', 'aliquam', 'aliquet', 'amet', 'ante', 'aptent', 'arcu', 'at',
		'auctor', 'augue', 'bibendum', 'blandit', 'class', 'commodo', 'condimentum', 'congue', 'consectetur', 'consequat',
		'conubia', 'convallis', 'cras', 'cubilia', 'cum', 'curabitur', 'curae', 'cursus', 'dapibus', 'diam', 'dictum',
		'dictumst', 'dignissim', 'dis', 'dolor', 'donec', 'dui', 'duis', 'efficitur', 'egestas', 'eget', 'eleifend',
		'elementum', 'elit', 'enim', 'erat', 'eros', 'est', 'et', 'etiam', 'eu', 'euismod', 'ex', 'facilisi', 'facilisis',
		'fames', 'faucibus', 'felis', 'fermentum', 'feugiat', 'finibus', 'fringilla', 'fusce', 'gravida', 'habitant',
		'habitasse', 'hac', 'hendrerit', 'himenaeos', 'iaculis', 'id', 'imperdiet', 'in', 'inceptos', 'integra', 'interdum',
		'ipsum', 'justo', 'lacinia', 'lacus', 'laoreet', 'lectus', 'leo', 'libero', 'ligula', 'litora', 'lobortis', 'lorem',
		'luctus', 'maecenas', 'macon', 'magna', 'magnis', 'malesuada', 'massa', 'mattis', 'mauris', 'maximus', 'metus',
		'mi', 'molestie', 'mollis', 'montes', 'morbi', 'mus', 'nam', 'nascetur', 'natoque', 'nec', 'neque', 'netus', 'nibh',
		'nisi', 'nisl', 'non', 'nostra', 'nulla', 'nullam', 'nunc', 'odio', 'orci', 'ornare', 'parturient', 'pellentesque',
		'penatibus', 'per', 'pharetra', 'phasellus', 'placerat', 'platea', 'porta', 'porttitor', 'posuere', 'potenti',
		'praesent', 'pretium', 'primis', 'proin', 'pulvinar', 'purus', 'quam', 'quis', 'quisque', 'rhoncus', 'ritocolus',
		'risus', 'rutrum', 'sagittis', 'sapien', 'scelerisque', 'sed', 'sem', 'semper', 'senectus', 'sit', 'sociis',
		'sociosqu', 'sodales', 'sollicitudin', 'sum', 'suscipit', 'suspendisse', 'taciti', 'tellus', 'tempor', 'tempus',
		'tincidunt', 'torquent', 'tortor', 'tristique', 'turpis', 'ullamcorper', 'ultrices', 'ultricies', 'urna', 'ut',
		'varius', 'vehicula', 'vel', 'velit', 'venenatis', 'vestibulum', 'vitae', 'vivamus', 'viverra', 'volutpat', 'vulputate'
	];

	private static $commaOdds  = 5;
	private static $periodOdds = 10;


	public function lorem($params)			// params: 'length' = how many words; 'min' = minimum word length; 'punct' controls puncuation
	{
		$len   = isset($params['length']) ? (int) $params['length'] : 0;
		$min   = isset($params['min'])    ? $params['min'] : 0;
		$punct = isset($params['punct'])  ? $params['punct'] : true;
		$res   = '';

		for ($i = 0; $i < 10000; $i++)		// ensure we don't go 4ever (like if min word length or request word count are huge)
		{
			$word = self::$lwords[rand(0, count(self::$lwords) - 1)];
			if ($min && strlen($word) < $min)
				continue;

			if ($res == '')
				$word = ucfirst($word);
			else
			{
				if ($punct)
				{
					if (rand(1, 100) < self::$commaOdds)
						$res .= ', ';
					else if (rand(1, 100) < self::$periodOdds)
					{
						$res .= '. ';
						$word = ucfirst($word);
					}
					else
						$res .= ' ';
				}
				else
					$res .= ' ';
			}

			$res .= $word;

			if ($len && $i >= ($len - 1))
				break;
		}

		if ($punct && $res[strlen($res) - 1] != '.')
			$res .= '.';

		return $res;
	}

	public function genstring($params)
	{
		$length = isset($params['length']) ? $params['length'] : null;
		$prefix = isset($params['prefix']) ? $params['prefix'] : null;
		$suffix = isset($params['suffix']) ? $params['suffix'] : null;

		$str = substr( str_shuffle( str_repeat('abcdefghijklmnopqrstuvwxyz', $length) ), 0, $length );

		return ($prefix ? $prefix : '') . $str . ($suffix ? $suffix : '');
	}
}

?>
