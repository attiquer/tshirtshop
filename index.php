<?php
//include utility files
require_once 'include/config.php';
require_once BUSINESS_DIR . '/error_handler.php';

//set error handler
ErrorHandler::SetHandler();

//load the application file template
require_once PRESENTATION_DIR . 'application.php';

//load smarty template file
$application = new Application();

//Display the page
$application->display('store_front.tpl');

//require_once 'nonexistant.php';