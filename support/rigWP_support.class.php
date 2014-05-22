<?php

/**
* 
*/
class rigWP_support {
	
	function init(){

		$support_plugins = array('woo_subshops');


		$this->handlers = (object) array();
		foreach($support_plugins as $plug){
			$classname = 'rigWP_support_'.$plug;
			require($classname.'.class.php');
			$this->handlers->{$plug} = new $classname();
			$this->handlers->{$plug}->init();
		}

	}

}


?>