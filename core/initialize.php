<?php 

    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS. 'laragon'.DS. 'www'.DS.'ProductReview');

    // defining the paths

    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT.DS.'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT.DS.'core');

    // loading config file
    require_once(INC_PATH.DS."config.php");

    // loading core file

    require_once(CORE_PATH.DS."product.php");






?>