<?php

class Admin_Todo_Controller
{
	public $baseName = 'admin_todo';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>