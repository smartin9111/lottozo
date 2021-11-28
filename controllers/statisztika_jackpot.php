<?php

class Statisztika_Jackpot_Controller
{
	public $baseName = 'statisztika_jackpot';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>