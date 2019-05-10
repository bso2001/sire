<?php

// CREATE TABLE test_table ( id INTEGER, description TEXT, time_zone VARCHAR(30), industry INTEGER, city VARCHAR(100), state VARCHAR(100), zipcode VARCHAR(10) );

$_testFields_ = 
[
	[
		'fname' => 'id',
		'type' => 'integer',
		'key' => true
	],
	[
		'fname' => 'start_date',
		'type' => 'datetime',
		'generator' => 'randomFutureDate'
	],
	[
		'fname' => 'end_date',
		'type' => 'datetime',
		'generator' => 
		[
			'f' => 'offsetDateByDays',
			'baseline' => '#start_date',
			'offset' => [ 'f' => 'random', 'domain' => range(2, 7) ]
		]
	],
	[
		'fname' => 'checkin_time',
		'type' => 'datetime',
		'generator' => 
		[
			'f' => 'offsetDateByHours',
			'baseline' => '#start_date',
			'offset' => [ 'f' => 'random', 'domain' => range(-4, 0) ]
		]
	],
	[
		'fname' => 'description',
		'type' => 'string',
		'generator' =>
		[
			'f' => 'lorem',
			'length' => [ 'f' => 'random', 'domain' => range(12, 36) ]
		]
	],
	[
		'fname' => 'time_zone',
		'type' => 'string',
		'generator' =>
		[
			'f' => 'random',
			'domain' => [ 'eastern', 'central', 'mountain', 'pacific' ]
		]
	],
	[
		'fname' => 'industry',
		'type' => 'integer',
		'generator' => [ 'f' => 'random', 'domain' => range(1, 50)
		]
	],
	[
		'fname' => 'city',
		'type' => 'string',
		'generator' => 'city'
	],
	[
		'fname' => 'state',
		'type' => 'string',
		'generator' => 'stateCode'
	],
	[
		'fname' => 'zipcode',
		'type' => 'string',
		'generator' => [ 'f' => 'zipCode', 'stateCode' => '#state' ]
	],
	[
		'fname' => 'website',
		'type' => 'string',
		'generator' => 
		[
			'f' => 'genstring',
			'prefix' => 'http://www.',
			'suffix' => [ 'f' => 'random', 'domain' => [ '.com', '.net', '.org' ] ],
			'length' => [ 'f' => 'random', 'domain' => range(3, 10) ]
		]
	]
];

?>
