<?php

namespace sire;

class date
{
	public function randomFutureDate()
	{
		$day = 24 * 60 * 60;
		$min = time() + $day;
		$max = $min + (365 * $day);

		return date('Y-m-d H:00:00', rand($min, $max));
	}

	public function randomDateBetween($params)		// the 'range' param must exist to define date range
	{
		if ( !($range = isset($params['range']) ? $params['range'] : null) )
			return null;

		if (count($range) < 2)
			return null;

		$t1 = ($range[0] == '@now') ? time() : strtotime($range[0]);
		$t2 = ($range[1] == '@now') ? time() : strtotime($range[1]);

		return (count($range) == 2) ? date('Y-m-d H:i:s', rand($t1, $t2)) : null;
	}

	public function randomDateBeyond($params)
	{
		if (!isset($params['baseline']))
			return null;

		$baseline = $params['baseline'];
		$min = ($baseline == '@now') ? time() : strtotime($baseline);
		$max = $min + (365 * 24 * 60 * 60);

		return date('Y-m-d H:i:s', rand($min, $max));
	}

	public function offsetDateByDays($params)	// the 'baseline' param must exist to define source date; 'offset' defines offset in days
	{
		$baseline = isset($params['baseline']) ? $params['baseline'] : null;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		if ($baseline === null || $offset === null)
			return null;

		$t = ($baseline == '@now') ? time() : strtotime($baseline);

		return date('Y-m-d H:i:s', $t + (24 * 60 * 60 * $offset));
	}

	public function offsetDateByHours($params)	// the 'baseline' param must exist to define source date; 'offset' defines offset in hours
	{
		$baseline = isset($params['baseline']) ? $params['baseline'] : null;
		$offset = isset($params['offset']) ? $params['offset'] : null;
		if ($baseline === null || $offset === null)
			return null;

		$t = ($baseline == '@now') ? time() : strtotime($baseline);

		return date('Y-m-d H:i:s', $t + (60 * 60 * $offset));
	}
}

?>
