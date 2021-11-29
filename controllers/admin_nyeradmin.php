<?php

class Admin_Nyeradmin_Controller
{
	public $baseName = 'admin_nyeradmin';  
	public function main(array $vars) 
	{
		$view = new View_Loader($this->baseName."_main");
	}
}

?>