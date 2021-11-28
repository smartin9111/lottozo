<?php

class Szelveny_Controller
{
	public $baseName = 'szelveny';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>