<?php

error_reporting(E_ALL^E_NOTICE);
session_start();

define ('APP',dirname(__FILE__).DIRECTORY_SEPARATOR."app".DIRECTORY_SEPARATOR);
define ('SYS',dirname(__FILE__).DIRECTORY_SEPARATOR."sys".DIRECTORY_SEPARATOR);
define ('LIB',dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR);

mb_internal_encoding("UTF-8");

include_once SYS.'FW/FW.php';

use 
FW\FW,
\FW\Router        
;

FW::configure("default.php");
FW::addAutoloadPath(array(APP, SYS, SYS."FW".DIRECTORY_SEPARATOR, LIB, APP."Entity".DIRECTORY_SEPARATOR));
FW::DBI();

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
Doctrine\ORM\Tools\Setup::registerAutoloadDirectory(LIB);
$paths = array(APP."Entity".DIRECTORY_SEPARATOR);
$isDevMode = true;
$connectionParams = array(
    'dbname' => \FW\FW::config("db_name"),
    'user' => \FW\FW::config("db_user"),
    'password' => \FW\FW::config("db_pass"),
    'host' => \FW\FW::config("db_host"),
    'driver' => 'pdo_mysql',
);
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$em = EntityManager::create($connectionParams, $config);
$em->getConfiguration()->setMetadataDriverImpl($config->newDefaultAnnotationDriver($paths));
FW::setEm($em);





Router::addRoute('REST', null,'~^/rest/([A-z0-9]*)(?:/([0-9]*))?(?:/([A-z]*))?~is',function($m,$method){
    return \FW\Request::create("Rest/".$m[1],$method.($m[3] ? "_".$m[3] : ""),array('id'=>$m[2]));
}, function($request){
    return strtolower($request->controller)."/".$request->params['id'];
});

Router::addRoute('MVC', null,'~^/([A-z0-9]*)(?:/([A-z0-9]*))?/?(.*)~is',
function($m,$method){
    $params= $m[3] ? explode("/",preg_replace('~/$~is','',$m[3])) : array();
    return \FW\Request::create($m[1] ? $m[1] : "Index" ,$m[2] ? $m[2] : "index",$params);
}, function($request){
    return strtolower($request->controller)."/".$request->action.( !empty($request->params) ? "/".implode("/", $request->params) : "");
});

 
Router::addRoute('default', null,'~.*~is',function($m){
    $controller =  ucfirst(strtolower(key_exists("controller", $_GET) ? preg_replace('~[^A-z0-9_]~is', '', $_GET['controller']) : 'Index' ));
    $action = key_exists("action", $_GET) ? $_GET['action'] : 'index' ;
    return \FW\Request::create($controller,$action);
    
});

Router::getInstance()->run($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])->execute();
