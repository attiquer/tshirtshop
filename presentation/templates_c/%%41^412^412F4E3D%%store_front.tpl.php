<?php /* Smarty version 2.6.25-dev, created on 2016-05-09 16:37:10
         compiled from store_front.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'store_front.tpl', 2, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "site.conf"), $this);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php echo $this->_config[0]['vars']['site_title']; ?>
</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link type="text/css" rel="stylesheet" href="styles/tshirtshop.css" />
</head>
<body>
<div id="doc" class="yui-t2">
    <div id="bd">
        <div id="yui-main">
            <div class="yui-b">
                <div id="header" class="yui-g">
                    <a href="index.php">
                        <img src="images/tshirtshop.png" alt="tshirtshop logo" />
                    </a>
                </div>
                <div id="contents" class="yui-g">
                    Place contents here
                </div>
            </div>
        </div>
        <div class="yui-b">
            Place list of departments here
        </div>
    </div>
</div>
</body>
</html>