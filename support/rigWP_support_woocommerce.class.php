<?php

class rigWP_support_woocommerce {


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function init(){
		add_filter('woocommerce_locate_template', array($this, 'locate_template'), 999, 3);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function locate_template($template, $template_name, $template_path){	

		

		return $template;
	}

}

?>