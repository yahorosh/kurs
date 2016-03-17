<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FW;

/**
 * Description of View
 *
 * @author horoshev
 */
abstract class View {

    protected $http_content_type = "text/html; charset=utf-8";
    protected $http_response_code = 200;
    protected $http_headers=array();
    static $messages = array(
        100 => "Continue",
        101 => "Switching Protocols", 
        102 => "Processing",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",
        226 => "IM Used",
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Moved Temporarily",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
    );    
    
    
    function __construct($params=array()) {
        $params=(array)$params;
        foreach($params as $k=>$v){
            $this->{$k}=$v;
        }
    }
    
    function setHttpResponseCode($code=200){
        $this->http_response_code = (int)$code;
    }

    public function addHttpHeader(array $header){
        foreach ($header as $key => $value) {
            $this->http_headers[$key] = $value;
        }
    }
    
    public function getHttpHeaders(){
        if($this->http_content_type){
            $this->http_headers['Content-type'] = $this->http_content_type;
        }
        return $this->http_headers;
    }
    
    public function display(){
        
        header("HTTP/1.1 ".intval($this->http_response_code)." ".self::$messages[$this->http_response_code]);
        foreach($this->getHttpHeaders() as $k=>$v){
            header("$k: $v");
        }
        echo $this->http_response_body();
        
    }

    abstract function http_response_body();

    /**
     * 
     * @param sting $name
     * @param array $params
     * @return \FW\View
     */
    static function create($name,$params=array()){
        list($namespace, $name) = is_array($name) ? $name : array("", $name); 
        $class_name = ($namespace ?  $namespace.'\\': '')."View_".( implode("_", array_map("ucfirst", array_map("strtolower",explode("/",$name)))));
        $view = new $class_name($params);
        return $view;
    }
    
}
