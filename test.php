<?php

class SuperEcho
{
	public $echo;
	public $times;
	
	function __construct($echo, $times)
	{
		$this->echo = htmlspecialchars($echo, ENT_QUOTES, 'utf-8');
		$this->times = is_int($times) === true ? $times : 10;
		$this->tenEcho();
	}
	
	public function tenEcho()
	{
		for($i = $this->times; $i > 1; $i--){
			echo $this->echo . '<br>';
		}
	}

}

$echo = new SuperEcho('teseeet',20);