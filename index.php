<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 11/23/18
 * Time: 2:57 PM
 */
session_start();


define('base',dirname(__DIR__).'/htdocs');
define('base_url',getenv('HTTP_HOST').'/');
define('path_config',base.'/app/config.php');
include base.'/app/functions.php';

// route
$folder = "/public";
$page = "index.php";



if(isset(explode("/",$_GET['data'])[0]) && explode("/",$_GET['data'])[0] != "") {
    $folder = explode("/",$_GET['data'])[0];
}
if (count(explode("/",$_GET['data']))>=0){
    $page = explode("/",$_GET['data'])[0].'.php';
    $folder = "/public";

}
if(folder_exist(explode("/",$_GET['data'])[0]) ){
    if (folder_exist(explode("/",$_GET['data'])[0]) != base){
        $folder = explode("/",$_GET['data'])[0];
    }
    $page = "index.php";

}

if(isset(explode("/",$_GET['data'])[1]) && explode("/",$_GET['data'])[1] != "") {
    $page = explode("/",$_GET['data'])[1].'.php';
}

$assets = "//".base_url.$folder;


// includes
include path_config;
//var_dump(base."/".$folder.'/'.$page);
if (file_exists(base."/".$folder.'/'.$page)){
        require_once base."/".$folder.'/'.$page;
}else{
    http_response_code(404);
    include "404.php";
}
