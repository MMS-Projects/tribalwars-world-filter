<?php
class Application_Model_World {
	public $speed;
	public $unitspeed;
	
	public function randomize ()
	{
		$this->speed     = 1.0 + rand(0, 2) * 0.5;
		$this->unitspeed = rand(1, 3) * (1 / 3);
	}
}
