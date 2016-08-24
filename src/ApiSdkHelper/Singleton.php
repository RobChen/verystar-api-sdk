<?php
/**
 * Created by VeryStar.
 * User: Rob
 * Date: 2016/6/30
 * Time: 15:58
 */

namespace rob\ApiSdkHelper;

class Singleton{
    private static $_class_instances = array();

    public static function getClassInstance($class_name){
        if(!isset(self::$_class_instances[$class_name])){
            self::$_class_instances[$class_name] = new $class_name();
        }
        return self::$_class_instances[$class_name];
    }
}