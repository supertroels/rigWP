<?php

/*
********************************
HELPER FUNCTIONS
********************************
*/

/**
 * Prints the given variables to the screen
 * in a very readable way.
 *
 * @author Troels Abrahamsen
 * @param $print - the variable to print
*/

function aprint($print){
	echo '<pre>';
	print_r($print);
	echo '</pre>';
}

/**
 * Same as above but kills script after completion.
 *
 * @author Troels Abrahamsen
 * @param $print - the variable to print
*/

function die_aprint($print){
	echo '<pre>';
	print_r($print);
	echo '</pre>';
	die();
}


/**
 * undocumented function
 *
 * @return void
 **/
function rigwp(){
	$backtrace = debug_backtrace();
	$tmpl = $backtrace[1]['args'][0];
	$tmpl = explode('/', $tmpl);
	$tmpl = $tmpl[count($tmpl) - 1];
	$tmpl = str_ireplace('.php', '', $tmpl);
	
	$fix = array('header', 'footer');
	if(in_array($tmpl, $fix)){
		global $rigWP;
		if($tmpl = $rigWP->get_template($tmpl, false)){
			require($tmpl);
		}
	}

}


?>