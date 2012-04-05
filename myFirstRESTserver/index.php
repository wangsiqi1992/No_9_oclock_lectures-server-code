<?php
 //   header('Content-type: application/json');
include_once 'RestServer.php';
include_once 'UserController.php';
include_once 'NewsFeedsController.php';
ob_start();
session_start();

    spl_autoload_register(); // don't load our classes unless we use them
    $mode = 'debug'; // 'debug' or 'production'
    $server = new RestServer($mode);
    // $server->refreshCache(); // uncomment momentarily to clear the cache if classes change in production mode

    $server->addClass('UserController');
    $server->addClass('NewsFeedsController');
    
//    $server->addClass('ProductsController', '/products'); // adds this as a base to all the URLs in this class

    $server->handle();
    
ob_flush();

?>
