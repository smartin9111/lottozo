<?php

class Statisztika_Distribution_Controller
{
	public $baseName = 'statisztika_distribution';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>