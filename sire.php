<?php

namespace sire;

require_once "date.php";
require_once "geodata.php";
require_once "person.php";
require_once "text.php";

class engine
{
	private $fields = null;
	private $keys = null;
	private $helpers = null;
	public $savedData = [];

	public function initialize($f, $k = null)
	{
		$this->fields = $f;
		$this->keys   = $k;

		$this->helpers[] = new \sire\date;
		$this->helpers[] = new \sire\geodata;
		$this->helpers[] = new \sire\person;
		$this->helpers[] = new \sire\text;
	}

	public function fill($obj)
	{
		if ($this->fields)
		{
			foreach ($this->fields as &$f)
				$obj->$f['fname'] = $this->genval($f);
		}
	}

	public function insert($tableName, $key = null)
	{
		$r = '';

		if ($tableName && $this->fields)
			$r = 'INSERT INTO `' . $tableName . '` ' . $this->cols($key) . ' VALUES ' . $this->vals($key) . ";\n";

		return $r;
	}

	private function cols($key)
	{
		$r = '(';

		if ($this->fields)
		{
			foreach ($this->fields as $f)
			{
				if (isset($f['key']) && $f['key'] === true && !$key)
					continue;

				$r .= (($r != '(') ? ', ' : '') . $f['fname'];
			}
		}

		return $r . ')';
	}

	private function vals($key)
	{
		$r = '(';

		if ($this->fields)
		{
			foreach ($this->fields as &$f)
			{
				$rawv = null;

				if (isset($f['key']) && $f['key'] === true && $key)
					$rawv = $key;

				if ($rawv === null)
					$rawv = $this->genval($f);

				if ($rawv !== null)
					$r .= (($r != '(') ? ', ' : '') . (($f['type'] != 'integer') ?  "'$rawv'" : $rawv);
			}
		}

		return $r . ')';
	}

	private function genval(&$f)
	{
		$v = null;

		if (isset($f['generator']))
			$v = $this->evaluate($f['generator']);

		if ($v === false && isset($f['default']))
			$v = $f['default'];

		if ($v === false)
			$v = ($f['type'] == 'integer') ? 0 : '';

		$f['value'] = $v;

		return $v;
	}

	private function evaluate($v)
	{
		$r = null;

		if (is_array($v))
		{
			if (isset($v['f']))
			{
				$f = $v['f'];
				$params = $v;
				unset($params['f']);

				foreach ($params as $key => $val)
				{
					if ( ($nval = $this->evaluate($val)) !== null )
						$params[$key] = $nval;
				}

				if (method_exists($this, $f))
					$r = $this->$f($params);
				else if ( ($helper = $this->searchHelpers($f)) )
					$r = $helper->$f($params);
				else if (function_exists($f))
					$r = $f($params);
			}
		}
		else if ($v[0] == '#')
		{
			$fname = substr($v, 1); 

			if ( ($f = $this->findField($fname)) && isset($f['value']) )
				return $f['value'];
		}
		else if (method_exists($this, $v))
			$r = $this->$v();
		else if ( ($helper = $this->searchHelpers($v)) )
			$r = $helper->$v();
		else if (function_exists($v))
			$r = $v();
		else
			$r = $v;

		return $r;
	}

	private function findField($fname)
	{
		if ($this->fields)
		{
			foreach ($this->fields as $f)
			{
				if ($f['fname'] == $fname)
					return $f;
			}
		}

		return false;
	}

	private function searchHelpers($mname)
	{
		if ($this->helpers)
		{
			foreach ($this->helpers as $h)
			{
				if (method_exists($h, $mname))
					return $h;
			}
		}

		return false;
	}

	public function random($params)			// either the 'domain' or 'range' param defines the array from which a random value is chosen
	{
		$a = null;

		if (isset($params['domain']))
			$a = $params['domain'];
		if (isset($params['range']))
			$a = $params['range'];

		if ($a === null)
			return null;

		return $a[rand(0, count($a) - 1)];
	}

	public static function randomImage($params)
	{
		$type = (isset($params['type'])) ? $params['type'] : 'logos';		// pick any old default type if need be
		$files = glob(dirname(__FILE__) . "/assets/$type/*.*");
		return $files[ array_rand($files) ];
	}

	public function save()
	{
		$this->savedData = [];

		if ($this->fields)
		{
			foreach ($this->fields as $f)
			{
				if (isset($f['value']))
					$this->savedData[ $f['fname'] ] = $f['value'];
			}
		}
	}

	public function saved($params)
	{
		if ( isset($params['field']) && count($this->savedData) > 0 && isset($this->savedData[ $params['field'] ]) )
			return $this->savedData[ $params['field'] ];

		return "";
	}
}

?>
