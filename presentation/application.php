<?php
//Reference smarty library
require_once SMARTY_DIR . 'Smarty.class.php';

/**
 * Class that extends Smarty and is used to display smarty files
 */
class Application extends Smarty {
    //constructor
    public function __construct(){
        //call Smarty constructor
        parent::Smarty();

        //change the default template directories
        $this->template_dir = TEMPLATE_DIR;
        $this->compile_dir = COMPILE_DIR;
        $this->config_dir = CONFIG_DIR;
    }
}