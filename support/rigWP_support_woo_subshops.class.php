<?php

class rigWP_support_woo_subshops {


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function init(){
		add_filter('woo_subshops/locate_template_dirs', array($this, 'add_template_dir'), 999, 2);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function add_template_dir($dirs, $shop){

		global $rigWP;

		/* Append rigWP structure to the dirs */
		$newdirs = array(
			get_stylesheet_directory().'/'.$rigWP->templates_folder.'/subshops/'.$shop->post_name.'/',
			get_stylesheet_directory().'/'.$rigWP->templates_folder.'/subshops/',
			get_template_directory().'/'.$rigWP->templates_folder.'/subshops/'.$shop->post_name.'/',
			get_template_directory().'/'.$rigWP->templates_folder.'/subshops/',
			);
		$dirs = $newdirs+$dirs;

		return $dirs;
	}

}

?>