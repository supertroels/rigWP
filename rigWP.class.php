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
		
		add_filter('template_include', array($this, 'template_redirect'), 1, 1);
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
	function template_redirect($template){

		if     ( is_404()            && $tmpl = $this->template->get_404_template()            ) :
		elseif ( is_search()         && $tmpl = $this->template->get_search_template()         ) :
		elseif ( is_front_page()     && $tmpl = $this->template->get_front_page_template()     ) :
		elseif ( is_home()           && $tmpl = $this->template->get_home_template()           ) :
		elseif ( is_post_type_archive() && $tmpl = $this->template->get_post_type_archive_template() ) :
		elseif ( is_tax()            && $tmpl = $this->template->get_taxonomy_template()       ) :
		elseif ( is_attachment()     && $tmpl = $this->template->get_attachment_template()     ) :
			remove_filter('the_content', 'prepend_attachment');
		elseif ( is_single()         && $tmpl = $this->template->get_single_template()         ) :
		elseif ( is_page()           && $tmpl = $this->template->get_page_template()           ) :
		elseif ( is_category()       && $tmpl = $this->template->get_category_template()       ) :
		elseif ( is_tag()            && $tmpl = $this->template->get_tag_template()            ) :
		elseif ( is_author()         && $tmpl = $this->template->get_author_template()         ) :
		elseif ( is_date()           && $tmpl = $this->template->get_date_template()           ) :
		elseif ( is_archive()        && $tmpl = $this->template->get_archive_template()        ) :
		elseif ( is_comments_popup() && $tmpl = $this->template->get_comments_popup_template() ) :
		elseif ( is_paged()          && $tmpl = $this->template->get_paged_template()          ) :
		elseif ( $tmpl = $this->template->get_index_template() ) :
		endif;

		if($tmpl){
			$template = $tmpl;
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

?>