<?php

/**
 * Simple Autoloader to grab class files only as they are required.
 * 
 */
function __autoload($className){
    if(file_exists('classes/'.$className.'.class.php')){
        require_once 'classes/'.$className.'.class.php';
    }
    if(file_exists('classes/'.$className.'.interface.php')){
        require_once 'classes/'.$className.'.interface.php';
    }
}

