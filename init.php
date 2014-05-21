<?php

require('helpers.php');

/* Require the rigWP class */
require('rigWP_template_loader.class.php');

/* Require the rigWP class */
require('rigWP.class.php');

/* Require the theme init file  */
require(get_stylesheet_directory().'/'.$rigWP->theme_folder.'/init.php');

?>