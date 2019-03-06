<?php

namespace App\Enum;

abstract class BaseEnum {
    private static $constCacheArray = NULL;

    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function getValidNames() {
        return self::getConstants();
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }

    public static function getDisplayNames() {
        $calledClass = get_called_class();
        $reflect = new \ReflectionClass($calledClass);
        $stat = $reflect->getStaticProperties();
        if (array_key_exists("DISPLAY_NAMES", $stat)) {
            return $stat["DISPLAY_NAMES"];
        } else {
            return array();
        }
    }

    public static function getDisplayName($value) {
        $dn = self::getDisplayNames();
        if (array_key_exists($value, $dn)) {
            return $dn[$value];
        } else {
            return $value;
        }
    }
}