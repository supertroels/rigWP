<?php

/*
*********************************
rigWP class
*********************************
*/

class rigWP {

	/**
	 * Returns the url for a given asset.
	 * Set $url to false to retrieve the path instead of the url
	 *
	 * @param (string) the aset to get
	 * @param (boolean) url or path
	 * @return string
	 * @author Troels Abrahamsen
	 **/
	static function get_asset($asset, $url = true){
		$pre = get_stylesheet_directory();
		if($url)
			$pre = get_stylesheet_directory_uri();
		return $pre.'/assets/'.$asset;
	}

	/**
	 * Returns the path for a given snippet.
	 *
	 * @param (string) the aset to get
	 * @return string
	 * @author Troels Abrahamsen
	 **/
	static function get_snippet($snippet){
		$pre = get_stylesheet_directory();
		return $pre.'/snippets/'.$snippet.'.php';
	}
	

}

?>