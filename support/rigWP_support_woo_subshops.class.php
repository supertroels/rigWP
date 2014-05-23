<?php

class rigWP_support_woo_subshops {


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function init(){
		add_filter('wss/locate_template_dirs', array($this, 'add_template_dir'), 999, 2);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function add_template_dir($dirs){

		global $rigWP;

		$newdirs = array();

		if($shop = wss::get_current_shop()){
			$newdirs[] = get_stylesheet_directory().'/'.$rigWP->templates_folder.'/subshops/'.$shop->post_name.'/';
			$newdirs[] = get_stylesheet_directory().'/'.$rigWP->templates_folder.'/subshops/';
			$newdirs[] = get_template_directory().'/'.$rigWP->templates_folder.'/subshops/'.$shop->post_name.'/';
			$newdirs[] = get_template_directory().'/'.$rigWP->templates_folder.'/subshops/';
		}

		$newdirs[] = get_stylesheet_directory().'/'.$rigWP->templates_folder.'/';
		$newdirs[] = get_template_directory().'/'.$rigWP->templates_folder.'/';

		/* Append rigWP structure to the dirs */
		$dirs = $newdirs+$dirs;

		return $dirs;
	}

}

?>