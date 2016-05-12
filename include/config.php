<?php
//site root folder
define('SITE_ROOT', dirname(dirname(__FILE__)));

//Application directories
define('PRESENTATION_DIR', SITE_ROOT . '/presentation/');
define('BUSINESS_DIR', SITE_ROOT . '/business/');

//Settings for smarty template engine
define('SMARTY_DIR', SITE_ROOT . '/libs/smarty/');
define('TEMPLATE_DIR', PRESENTATION_DIR . 'templates');
define('COMPILE_DIR', PRESENTATION_DIR . 'templates_c');
define('CONFIG_DIR', SITE_ROOT . '/include/configs');


//set true warnings and errors
define('IS_WARNING_FATAL', true);
define('DEBUGGING', true);

//error types to be reported
define('ERROR_TYPES', E_ALL);

//setting about mailing the error message
define('SEND_ERROR_MAIL', false);
define('ADMIN_ERROR_MAIL', 'admin@example.com');
define('SEND_MAIL_FROM', 'errors@example.com');
ini_set('sendmail_from', SEND_MAIL_FROM);

//error logging settings
define('LOG_ERRORS', true);
define('LOG_ERRORS_FILE', '/var/www/html/tshirtshop/errors.log');

//Generic message to be displayed instead of error when debugging is false
define('SITE_GENERIC_ERROR_MESSAGE', '<h2>Tshirt Error Message</h2>');

//Database connection config
define('DB_PERSISTANCY', 'true');
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'mage7321');
define('DB_DATABASE', 'tshirtshop');
define('PDO_DSN', 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE);
