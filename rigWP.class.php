<?php

/*
*********************************
rigWP class
*********************************
*/

class rigWP {


	protected $assets_dir;
	protected $theme_dir;


	/**
	 * Runs on class construction
	 *
	 * @return void
	 * @author Troels Abrahamsen
	 **/
	function __construct(){

		$this->set_dirs();

	}


	/**
	 * Set the resource dirs for rigWP
	 *
	 * @return void
	 * @author Troels Abrahamsen
	 **/
	private function set_dirs(){
		$this->theme_folder  = apply_filters('rigWP/theme_folder',  'theme');
		$this->assets_folder = apply_filters('rigWP/assets_folder', 'assets');
	}


	/**
	 * Returns the url for a given asset.
	 * Set $url to false to retrieve the path instead of the url
	 *
	 * @param (string) the aset to get
	 * @param (boolean) url or path
	 * @return string
	 * @author Troels Abrahamsen
	 **/
	public function get_asset($asset, $url = true){
		$pre = get_stylesheet_directory();
		if($url)
			$pre = get_stylesheet_directory_uri();
		return $pre.'/'.$this->assets_dir.'/'.$asset;
	}

	/**
	 * Returns the path for a given snippet.
	 *
	 * @param (string) the aset to get
	 * @return string
	 * @author Troels Abrahamsen
	 **/
	public function get_snippet($snippet){
		$pre = get_stylesheet_directory();
		return $pre.'/snippets/'.$snippet.'.php';
	}
	
}

$rigWP = new rigWP();

?>