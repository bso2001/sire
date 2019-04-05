<?php

namespace sire;

class geodata
{
								// $stateInfo entries: [0] = StateCode, [1] = StateName, [2] = ZipCodeRange
	private static $stateInfo = 
	[
		[ 'AL', 'Alabama', [ 350, 369 ] ], [ 'AK', 'Alaska', [ 995, 999 ] ], [ 'AZ', 'Arizona', [ 850, 865 ] ],
		[ 'AR', 'Arkansas', [ 716, 729 ] ], [ 'CA', 'California', [ 900, 961 ] ], [ 'CO', 'Colorado', [ 800, 816 ] ],
		[ 'CT', 'Connecticut', [ 60, 69 ] ], [ 'DE', 'Delaware', [ 197, 199 ] ], [ 'FL', 'Florida', [ 320, 349 ] ],
		[ 'GA', 'Georgia', [ 300, 319 ] ], [ 'HI', 'Hawaii', [ 967, 968 ] ], [ 'ID', 'Idaho', [ 832, 838 ] ],
		[ 'IL', 'Illinois', [ 600, 629 ] ], [ 'IN', 'Indiana', [ 460, 479 ] ], [ 'IA', 'Iowa', [ 500, 528 ] ],
		[ 'KS', 'Kansas', [ 660, 679 ] ], [ 'KY', 'Kentucky', [ 400, 427 ] ], [ 'LA', 'Louisiana', [ 700, 714 ] ],
		[ 'ME', 'Maine', [ 39, 49 ] ], [ 'MD', 'Maryland', [ 206, 219 ] ], [ 'MA', 'Massachusetts', [ 10, 27 ] ],
		[ 'MI', 'Michigan', [ 480, 499 ] ], [ 'MN', 'Minnesota', [ 550, 567 ] ], [ 'MS', 'Mississippi', [ 386, 397 ] ],
		[ 'MO', 'Missouri', [ 630, 658 ] ], [ 'MT', 'Montana', [ 590, 599 ] ], [ 'NE', 'Nebraska', [ 680, 693 ] ],
		[ 'NV', 'Nevada', [ 889, 898 ] ], [ 'NH', 'New Hampshire', [ 30, 38 ] ], [ 'NJ', 'New Jersey', [ 70, 89 ] ],
		[ 'NM', 'New Mexico', [ 870, 884 ] ], [ 'NY', 'New York', [ 100, 149 ] ], [ 'NC', 'North Carolina', [ 270, 289 ] ],
		[ 'ND', 'North Dakota', [ 580, 588 ] ], [ 'OH', 'Ohio', [ 430, 458 ] ], [ 'OK', 'Oklahoma', [ 730, 749 ] ],
		[ 'OR', 'Oregon', [ 970, 979 ] ], [ 'PA', 'Pennsylvania', [ 150, 196 ] ], [ 'RI', 'Rhode Island', [ 28, 29 ] ],
		[ 'SC', 'South Carolina', [ 290, 299 ] ], [ 'SD', 'South Dakota', [ 570, 577 ] ], [ 'TN', 'Tennessee', [ 370, 385 ] ],
		[ 'TX', 'Texas', [ 750, 799 ] ], [ 'UT', 'Utah', [ 840, 847 ] ], [ 'VT', 'Vermont', [ 50, 59 ] ],
		[ 'VA', 'Virginia', [ 220, 246 ] ], [ 'WA', 'Washington', [ 980, 994 ] ], [ 'WV', 'West Virginia', [ 247, 268 ] ],
		[ 'WI', 'Wisconsin', [ 530, 549 ] ], [ 'WY', 'Wyoming', [ 820, 831] ]
	];

	private static $streetNames =
	[
		'Birch', 'Cedar', 'Center', 'Cherry', 'Chestnut', 'Church', 'Davis', 'Dogwood', 'Elm', 'Evergreen', 'Forest', 'Hickory',
		'Highland', 'Hill', 'Hillcrest', 'Jackson', 'Jefferson', 'Johnson', 'Lake', 'Lakeview', 'Lincoln', 'Magnolia', 'Main',
		'Maple', 'Meadow', 'Mountain', 'North', 'Oak', 'Orchard', 'Park', 'Pine', 'Poplar', 'Railroad', 'Ridge', 'River',
		'Smith', 'South', 'Spring', 'Spruce', 'Sunset', 'Sycamore', 'Taylor', 'Valley', 'Walnut', 'Washington', 'West',
		'Williams', 'Willow', 'Wilson', 'Woodland'
	];
	private static $streetSuffix =
	[
		'Ave',
		'Blvd',
		'Court','Court',
		'Drive','Drive','Drive',
		'Lane',
		'Place','Place',
		'Road','Road','Road','Road',
		'Street','Street','Street','Street',
		'Way'
	];

	private static $commonCities =
	[
		'Arlington', 'Ashland', 'Auburn', 'Bethel', 'Bristol', 'Burlington', 'Cedar Grove', 'Centerville', 'Clayton', 'Clinton',
		'Concord', 'Dayton', 'Dover', 'Fairfield', 'Fairview', 'Forest Hills', 'Franklin', 'Georgetown', 'Glendale', 'Greenville',
		'Greenwood', 'Highland Park', 'Hope', 'Hudson', 'Jackson', 'Kingston', 'Lakeview', 'Lakewood', 'Lexington', 'Madison',
		'Manchester', 'Milford', 'Milton', 'Monmouth', 'Mount Pleasant', 'Mount Vernon', 'Newport', 'Oak Grove', 'Oak Hill', 'Oakland',
		'Oxford', 'Pine Grove', 'Pleasant Grove', 'Pleasant Hill', 'Pleasant Valley', 'Riverside', 'Salem', 'Shady Grove', 'Shiloh',
		'Springfield', 'Troy', 'Union', 'Washington', 'Winchester'
	];
	private static $city1 = [ 'Center', 'Fair', 'Forest', 'George', 'Glen', 'Green', 'Lake', 'Mountain', 'Oak', 'Pine', 'Pleasant', 'River', 'Spring', 'Sunny' ];
	private static $city2 = [ 'brook', 'dale', 'field', ' Grove', ' Hills', 'land', 'park', 'town', ' Valley', 'view', 'wood' ];
	private static $commonCityOdds = 40;


	public static function address()
	{
		return rand(2, 222) . ' ' . self::$streetNames[rand(0, count(self::$streetNames) - 1)] . ' ' .
										self::$streetSuffix[rand(0, count(self::$streetSuffix) - 1)];
	}

	public static function city()
	{
		if (rand(1, 100) < self::$commonCityOdds)
			return self::$commonCities[rand(0, count(self::$commonCities) - 1)];

		return self::$city1[rand(0, count(self::$city1) - 1)] . self::$city2[rand(0, count(self::$city2) - 1)];
	}

	public static function stateCode()
	{
		return self::$stateInfo[rand(0, 49)][0];
	}

	public static function state()
	{
		return self::$stateInfo[rand(0, 49)][1];
	}

	public static function zipCode($params)
	{
		if (isset($params['stateCode']))
			$a = self::findZipRange($params['stateCode']);
		else
			$a = range(30, 981);

		$z = rand($a[0], $a[1]) . str_pad(rand(1, 99), 2, '0', STR_PAD_LEFT);

		return str_pad($z, 5, '0', STR_PAD_LEFT);
	}

	public static function phone($params)
	{
		$p = rand(2, 9) . rand(0,1) . rand(1, 9) . rand(211, 999) . rand(1000, 9999);

		if (isset($params['formatted']) && $params['formatted'] == true)
			return substr($p, 0, 3) . '-' . substr($p, 3, 3) . '-' . substr($p, 6);

		return $p;
	}


	private static function findZipRange($stateCode)
	{
		foreach (self::$stateInfo as $s)
		{
			if ($s[0] == $stateCode)
				return $s[2];
		}

		return null;
	}
}

?>
