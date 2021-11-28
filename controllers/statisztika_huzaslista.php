<?php

class Statisztika_Huzaslista_Controller
{
	public $baseName = 'statisztika_huzaslista';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>