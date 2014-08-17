<?php

require('helpers.php');

/* Require the template_loader class */
require('rigWP_template_loader.class.php');

/* Require the support class */
require('support/rigWP_support.class.php');

/* Require the rigWP class */
require('rigWP.class.php');

/* Include the theme init file if it exists  */
$init_file = rigwp()->get_path(rigwp()->theme_folder.'/init.php');
include_once($init_file);

?>