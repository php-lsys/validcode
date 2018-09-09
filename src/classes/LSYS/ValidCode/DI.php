<?php
namespace LSYS\ValidCode;
/**
 * @method \LSYS\ValidCode valid_code($config=null)
 */
class DI extends \LSYS\DI{
    /**
     *
     * @var string default config
     */
    public static $config = 'validcode.file';
    /**
     * @return static
     */
    public static function get(){
        $di=parent::get();
        !isset($di->valid_code)&&$di->valid_code(new \LSYS\DI\ShareCallback(function($config=null){
            return $config?$config:self::$config;
        },function($config=null){
            $config=\LSYS\Config\DI::get()->config($config?$config:self::$config);
            return new \LSYS\ValidCode($config);
        }));
        return $di;
    }
}