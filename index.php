<?php
/**
 * Created by JetBrains PhpStorm.
 * User: liyajie1209
 * Date: 10/29/13
 * Time: 3:51 PM
 * To change this template use File | Settings | File Templates.
 */
ini_set("display_errors",1);

require("route/Router.php");

header('Content-type:application/json');
//print $_SERVER['QUERY_STRING']."<br>";
//print $_SERVER['REQUEST_URI'] ."<br>";

//preg_match_all("@:([\w]+)@i","/work/id/name",$matches);
//
//$url_regex = preg_replace_callback('@:[\w]+@', 'regexUrl', "/work/:id/:name");
//$url_regex .= '/?';
//// Store the regex used to match this pattern.
//$regex = '@^' . $url_regex . '$@';
//
//preg_match($regex,'/work/1313/jack',$matches);
//print_r($matches)."<br>";
//
//print $regex;

function __autoload($className) {
    if(class_exists($className,false) === false) {
        include $className.".php";
    }
}

$router = \Route\Router::getInstance();

$router->dispatcher();

//function regexUrl($matches) {
//    return '([a-zA-z0-9_\+\-%]+)';
//}