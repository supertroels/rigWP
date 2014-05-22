<?php

require('helpers.php');

/* Require the template_loader class */
require('rigWP_template_loader.class.php');

/* Require the support class */
require('support/rigWP_support.class.php');

/* Require the rigWP class */
require('rigWP.class.php');

/* Require the theme init file  */
require(get_stylesheet_directory().'/'.$rigWP->theme_folder.'/init.php');

?>