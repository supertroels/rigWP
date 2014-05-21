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



?>