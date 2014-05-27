<?php

/*
*********************************
rigWP class
*********************************
*/

class rigWP {


	/**
	 * Runs on class construction
	 *
	 * @return void
	 * @author Troels Abrahamsen
	 **/
	function __construct(){

		$this->set_dirs();
		$this->template = new rigWP_template_loader();
		$this->support = new rigWP_support();
		
		add_filter('template_include', array($this, 'set_template_vars'), 999, 1);
		add_action('init', array($this, 'init'));

		$this->support->init();

	}


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function init(){
		global $rigWP;
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function set_template_vars($template){

		if($template){
			$path = pathinfo($template);
			$this->template_name = $path['filename'];
		}

		return $template;
	}


	/**
	 * Proxy for get_header() that looks for header.php in the templates folder
	 * of the current theme and includes it if found.
	 * Falls back to get_header() on failure.
	 *
	 * @return void
	 **/
	function get_header($name = false){

		$tmpl = 'header';
		if($name){
			$tmpl .= '-'.$name;
		}
		$tmpl .= '.php';

		if($tmpl = $this->template->locate_template($tmpl)){
			do_action('get_header');
			load_template($tmpl);
		}
		else{
			get_header($name);
		}
	
	}


	/**
	 * Proxy for get_header() that looks for footer.php in the templates folder
	 * of the current theme and includes it if found.
	 * Falls back to get_footer() on failure.
	 *
	 * @return void
	 **/
	function get_footer($name = false){

		$tmpl = 'footer';
		if($name){
			$tmpl .= '-'.$name;
		}
		$tmpl .= '.php';
		
		if($tmpl = $this->template->locate_template($tmpl)){
			do_action('get_footer');
			load_template($tmpl);
		}
		else{	
			get_footer($name);
		}
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
		$this->templates_folder = apply_filters('rigWP/templates_folder', 'templates');
	}


	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	public function get_template($template, $look_in_root = true){
		$template = str_ireplace('.php', '', $template);
		$template = $template.'.php';
		return $this->template->locate_template($template, $look_in_root);
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
	public function get_asset($asset){
		return $this->locate_file($this->assets_folder.'/'.$asset);
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function get_path($where = false){
		$path = get_template_directory();
		if($where)
			$path .= '/'.$where;
		return $path;
	}

	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function locate_file($file){
		
		$stylepath = get_stylesheet_directory().'/';
		$styleurl  = get_stylesheet_directory_uri().'/';
		$templpath = get_template_directory().'/';
		$templurl  = get_template_directory_uri().'/';

		if(file_exists($stylepath.$file))
			return $styleurl.$file;
		elseif(file_exists($templpath.$file))
			return $templurl.$file;
		else
			return false;

	}

}

$rigWP = new rigWP();
$rigwp = &$rigWP;
?>