<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace FW;

/**
 * Description of FW
 *
 * @author horoshev
 */
class FW {

    /**
     *
     * @var array
     */
    protected static $config;

    /**
     *
     * @var mysqli;
     */
    protected static $DBInterface;

    /**
     *
     * @var AuthAdapter
     */
    protected static $auth;

    /**
     * @type \Doctrine\ORM\EntityManager
     */
    protected static $em;

    /**
     *
     * @var array
     */
    protected static $paths = array();

    /**
     * 
     * @param string $file
     */
    function configure($file) {
        self::_register_autoload();
        self::_loadConfig($file);
        self::DBI();
    }

    /**
     * 
     * @param string $file
     * @return array
     * @throws Exeption
     */
    protected static function _loadConfig($file) {
        if (file_exists($filePath = APP . "Config/" . $file)) {
            include_once $filePath;
        } else {
            throw new Exeption("No config file $filePath.");
        }

        self::$config = $config;
        return $config;
    }

    /**
     * 
     * @param string $key - Use key.subkey.subsubkey synopsys
     * @param type $default
     * @return mixed
     */
    public static function config($key, $default = null) {
        $d = self::$config;
        foreach (explode(".", $key) as $w) {
            $d = (is_array($d) && key_exists($w, $d)) ? $d[$w] : $default;
        }
        return $d; 
    }

    /**
     * 
     * @throws Exception
     */
    protected static function _register_autoload() {
        spl_autoload_register(function($class) {

                    $filePath = str_replace(array('\\', "_"), DIRECTORY_SEPARATOR, $class) . ".php";

                    if ($filename = FW::findFile($filePath)) {
                        include_once $filename;
                    } else {
                        //throw new \Exception("Class ".$class. " not found in $filePath.");
                    }
                });
    }

    /**
     * 
     * @return \mysqli 
     */
    public static function DBI($new = false) {
        /**
         * @todo Придумать механизм получения нескольких интерфейсов БД.
         */
        if (self::$DBInterface == null or $new) {
            $DBI = new \mysqli(self::config('db_host'), self::config('db_user'), self::config('db_pass'), self::config('db_name'));
            if (!$new)
                self::$DBInterface = $DBI;
        }
        return self::$DBInterface;
    }

    /**
     * @return \Doctrine\ORM\EntityManager EntityManager
     */
    public static function getEM() {
        return self::$em;
    }

    public static function setEM(\Doctrine\ORM\EntityManager $em) {
        self::$em = $em;
    }

    public static function findFile($filePath) {
        $filename = false;
        foreach (self::$paths as $v) {
            if (file_exists($filename = $v . $filePath)) {
                return $filename;
            }
        }
        return false;
    }

    static public function addAutoloadPath($path) {
        if (!is_array($path)) {
            $path = array($path);
        }
        self::$paths = array_merge(self::$paths, $path);
    }

    public static function auth(AuthAdapter $auth = null) {
        if ($auth !== null) {
            self::$auth = $auth;
        }
        return self::$auth;
    }

    public static function baseUrl() {
        return 'http://' . self::config('domain') . "/" . self::config('basepath');
    }

}

