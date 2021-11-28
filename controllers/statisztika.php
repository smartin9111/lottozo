<?php

class Statisztika_Controller
{
	public $baseName = 'statisztika';  
	public function main(array $vars) 
	{
		
		$view = new View_Loader($this->baseName."_main");
	}
}

?>