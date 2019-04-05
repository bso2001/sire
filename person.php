<?php

namespace sire;

require_once "geodata.php";

class person extends geodata
{
	private static $maleNames = 
	[
		'Aaron', 'Adam', 'Adrian', 'Aiden', 'Alexander', 'Andrew', 'Angel', 'Anthony', 'Asher', 'Austin', 'Ayden', 'Benjamin', 'Bentley',
		'Blake', 'Brandon', 'Brayden', 'Brody', 'Caleb', 'Camden', 'Cameron', 'Carson', 'Carter', 'Charles', 'Chase', 'Christian', 'Christopher',
		'Colton', 'Connor', 'Cooper', 'Daniel', 'David', 'Dominic', 'Dylan', 'Easton', 'Eli', 'Elijah', 'Ethan', 'Evan', 'Gabriel', 'Gavin',
		'Grayson', 'Henry', 'Hudson', 'Hunter', 'Ian', 'Isaac', 'Isaiah', 'Jace', 'Jack', 'Jackson', 'Jacob', 'James', 'Jason', 'Jaxon',
		'Jayden', 'Jeremiah', 'John', 'Jonathan', 'Jordan', 'Jose', 'Joseph', 'Joshua', 'Josiah', 'Juan', 'Julian', 'Justin', 'Kayden',
		'Kevin', 'Landon', 'Leo', 'Levi', 'Liam', 'Lincoln', 'Logan', 'Lucas', 'Luis', 'Luke', 'Mason', 'Matthew', 'Michael', 'Nathan',
		'Nathaniel', 'Nicholas', 'Noah', 'Nolan', 'Oliver', 'Owen', 'Parker', 'Robert', 'Ryan', 'Ryder', 'Samuel', 'Sebastian', 'Thomas',
		'Tristan', 'Tyler', 'William', 'Wyatt', 'Xavier', 'Zachary'
	];

	private static $femaleNames = 
	[
		'Aaliyah', 'Abigail', 'Addison', 'Alexa', 'Alexandra', 'Alexis', 'Alice', 'Allison', 'Alyssa', 'Amelia', 'Anna', 'Annabelle', 'Aria',
		'Ariana', 'Arianna', 'Ashley', 'Aubree', 'Aubrey', 'Audrey', 'Autumn', 'Ava', 'Avery', 'Bella', 'Brianna', 'Brooklyn', 'Camila',
		'Caroline', 'Charlotte', 'Chloe', 'Claire', 'Eleanor', 'Elizabeth', 'Ella', 'Ellie', 'Emily', 'Emma', 'Eva', 'Evelyn', 'Faith',
		'Gabriella', 'Genesis', 'Gianna', 'Grace', 'Hadley', 'Hailey', 'Hannah', 'Harper', 'Isabella', 'Isabelle', 'Jasmine', 'Julia',
		'Katherine', 'Kaylee', 'Kennedy', 'Khloe', 'Kylie', 'Lauren', 'Layla', 'Leah', 'Lillian', 'Lily', 'London', 'Lucy', 'Lydia',
		'Mackenzie', 'Madeline', 'Madelyn', 'Madison', 'Maya', 'Melanie', 'Mia', 'Mila', 'Naomi', 'Natalie', 'Nevaeh', 'Nora', 'Olivia',
		'Paisley', 'Penelope', 'Peyton', 'Piper', 'Riley', 'Ruby', 'Sadie', 'Samantha', 'Sarah', 'Savannah', 'Scarlett', 'Serenity',
		'Skylar', 'Sofia', 'Sophia', 'Sophie', 'Stella', 'Taylor', 'Victoria', 'Violet', 'Vivian', 'Zoe', 'Zoey'
	];

	private static $lastNames = 
	[
		'Adams', 'Allen', 'Anderson', 'Bailey', 'Baker', 'Barnes', 'Bateman', 'Bell', 'Bennett', 'Brooks', 'Brown', 'Butler', 'Campbell',
		'Carter', 'Clark', 'Collins', 'Cook', 'Cooper', 'Cox', 'Cruz', 'Davis', 'Diaz', 'Edwards', 'Evans', 'Fisher', 'Flores', 'Foil',
		'Foster', 'Garcia', 'Gonzalez', 'Gray', 'Green', 'Gutierrez', 'Hall', 'Hansen', 'Harris', 'Hernandez', 'Hill', 'Howard', 'Hughes',
		'Jackson', 'James', 'Jenkins', 'Jones', 'Kelly', 'King', 'Lee', 'Lewis', 'Long', 'Lopez', 'Magee', 'Martin', 'Martinez', 'Miller',
		'Mitchell', 'Moore', 'Morales', 'Morgan', 'Morris', 'Murphy', 'Myers', 'Nelson', 'Ortiz', 'Parker', 'Perez', 'Perry', 'Peterson',
		'Phillips', 'Powell', 'Price', 'Ramirez', 'Reed', 'Richardson', 'Rivera', 'Roberts', 'Robinson', 'Rodriguez', 'Rogers', 'Ross',
		'Russell', 'Sanchez', 'Sanders', 'Scott', 'Smith', 'Stewart', 'Sullivan', 'Taylor', 'Thomas', 'Thompson', 'Torres', 'Turner',
		'Walker', 'Ward', 'Watson', 'White', 'Williams', 'Wilson', 'Wood', 'Wright', 'Young'
	];

	private static $companies = 
	[
		'Ababa', 'Abavee', 'Agiba Tovee', 'Ainder', 'Ainyx', 'Aiyo Latri', 'Aizzy', 'Avaboo', 'Avadel', 'Avavu',
		'Babblespace', 'Babbletune', 'Blogbuzz', 'Blogjam', 'Bloglounge', 'Blognation', 'Blogpath', 'Blogtube',
		'Blogware', 'Bluebridge', 'Bluefire', 'Blueify', 'Bluenation', 'Bluepath', 'Bluetune', 'Blueverse', 'Brightware',
		'Browsebean', 'Browsefish', 'Browsepedia', 'Browsetype', 'BubbleZ', 'Bubblebuzz', 'Bubbleclub', 'Bubblelinks',
		'Bubbleshare', 'Bubbleverse', 'Bubbleware', 'Bubblewire', 'BuzzZ', 'Buzzlounge', 'Buzzpoint', 'Buzzwire',
		'Camilith', 'Caminder', 'Camiva', 'Centimbee', 'Chatfire', 'Chatterfeed', 'Chatterpad', 'Chatterspot',
		'Chattertag', 'Chattertune', 'Cogiboo', 'Cogindo', 'Cogipe', 'Dabbug Yombo', 'Dabpoint', 'Dabpulse', 'Dabzone',
		'Dazzlelinks', 'Dazzlevine', 'Dazzlezone', 'Demimbee', 'Demindo', 'Demitri', 'Devnation', 'Devspot', 'Devtune',
		'Digidog', 'Digifire', 'Digipoint', 'Digister', 'Digitube', 'Digizone', 'Divabox', 'Divata', 'Divavee', 'Divazio',
		'Dynamba', 'Dynatri', 'Ealane Kaynte', 'Eamia', 'Edgecube', 'Edgeworks', 'Eido Open Yonix', 'Fagen', 'Fando',
		'Feedbean', 'Feedbox', 'Feedbug', 'Feedfly', 'Feednation', 'Fivemix', 'Flipcat', 'Fliplounge', 'Fliptype',
		'Gabpad', 'Gabshots', 'Gendu', 'Genu Yakiveo', 'Geyo', 'Gigaclub', 'Gigafeed', 'Gigasphere', 'Inder', 'Innobeat',
		'Innoshots', 'Innotube', 'Innotype', 'Inoodle', 'Jabberspace', 'Jabbertag', 'Jabbertags', 'Jabox', 'Jacero',
		'Jadel', 'Jajo', 'Jalium', 'Janyx', 'Jaxbird', 'Jaxtype', 'Jaxwire', 'Jaxzone', 'Jetbridge', 'Jetcast', 'Jetpedia',
		'Jetstorm', 'Jettune', 'Jumpcast', 'Jumpdrive', 'Jumpspan', 'Jumpvine', 'Kayble Eideo', 'Kaymbo', 'Kibox', 'Kinti',
		'Kiyo', 'Kizz', 'Kizzy', 'Kwiloo', 'Kwinti', 'Kwipe', 'Lalane', 'Lalia', 'Lambu', 'Lamm', 'Lanti Quiyo', 'Lanyx',
		'Laveo', 'Lazio', 'Leedeo', 'Leemba Tava', 'Leeva', 'Leeveo', 'Linkpulse', 'Liveset', 'Livezoom', 'Meevu', 'Mimba',
		'Mindu', 'Minix', 'Mipe', 'Mita', 'Mudel', 'Mudo', 'Mundu', 'Mutz', 'Muxo', 'Mycast', 'Myclub', 'Mytags', 'Myveo',
		'Myverse', 'Myzio', 'Myzzy', 'Ndog', 'Npulse', 'Ntube', 'Oba', 'Ogen', 'Oocero', 'Oodoo', 'Oyombo', 'Oyonoodle',
		'Oyoveo Yanti', 'Photobeat', 'Photoblab', 'Photobox', 'Photonation', 'Phototags', 'Pixombee', 'Pixondu', 'Pixore',
		'Plamm', 'Plander', 'Plata', 'Podclub', 'Podshots', 'Podster', 'Podtube', 'Quacero', 'Quadeo', 'Quamba', 'Quaxo',
		'Quivu', 'Realbridge', 'Realfly', 'Realshare', 'Realspace', 'Realtags', 'Rhymbo', 'Rhyre', 'Rhyva', 'Rhyveo',
		'Rifflinks', 'Riffpath', 'Riffset', 'Riffverse', 'Roodeo', 'Roonoodle', 'Roonte', 'Rooxo', 'Shufflebridge',
		'Shufflebug', 'Shufflecast', 'Shufflechat', 'Shuffleclub', 'Skadoo', 'Skambo', 'Skare', 'Skinti', 'Skipbug',
		'Skiptune', 'Skiveo Oyolane', 'Skomba Vinti', 'Skyzio', 'Snapcast', 'Snapopia', 'Tagbug', 'Tagpoint', 'Tagware',
		'Tagzone', 'Tazu Eazu', 'Tekbeat', 'Tekbird', 'Tekchat', 'Thoughtcast', 'Thoughtfly', 'Thoughtset', 'Thoughtshare',
		'TopZ', 'Topblab', 'Topbridge', 'Topbug', 'Topicblab', 'Topicsphere', 'Topicspot', 'Topstorm', 'Triveo',
		'Triyo Chattag', 'Trylo Zot', 'Trilium', 'Truxo', 'Twixbox', 'Twimba', 'Twimbo', 'Twire', 'Twitterjam', 'Vilium',
		'Vivee', 'Viyo', 'Voolia', 'Wikicero', 'Wikilia', 'Wikimbu', 'Wordbean', 'Worddrive', 'Wordify', 'Wordlist',
		'Wordware', 'Yakiba', 'Yakido', 'Yakinu', 'Yakinyx', 'Yakizzy', 'Yombo', 'Youbuzz', 'Youware', 'Youworks', 'Zooboo',
		'Zoomcast', 'Zoomcube', 'Zoompulse', 'Zoomspace', 'Zoomtag', 'Zoomware', 'Zoonte', 'Zootz', 'Zoovu'
	];


	public function firstname($params = null)
	{
		$gender = ($params && isset($params['gender'])) ? strtoupper($params['gender']) : 'Any';

		if ($gender[0] == 'M')
			return self::$maleNames[rand(0, count(self::$maleNames) - 1)];

		if ($gender[0] == 'F')
			return self::$femaleNames[rand(0, count(self::$femaleNames) - 1)];

		if (rand(0, 1))
			return self::$femaleNames[rand(0, count(self::$femaleNames) - 1)];

		return self::$maleNames[rand(0, count(self::$maleNames) - 1)];
	}

	public function lastname()
	{
		return self::$lastNames[rand(0, count(self::$lastNames) - 1)];
	}

	public function company()
	{
		return self::$companies[rand(0, count(self::$companies) - 1)];
	}

	public function birthdate()
	{
		return rand(1, 12) . '/' . rand(1, 27) . '/' . (2015 - rand(20, 70));
	}

	public function username()
	{
		$length = rand(3, 7);
		$chars1 = 'abcdefghijklmnopqrstuvwxyz';
		$chars2 = 'abcdefghijklmnopqrstuvwxyz0123456789';

		return  $chars1[rand(0, 25)] . substr( str_shuffle( str_repeat($chars2, $length) ), 0, $length );
	}
}

?>
