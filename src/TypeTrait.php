<?php
namespace qpf\deunit;

/**
 * PHP 类型严格检查
 */
trait TypeTrait
{
    /**
     * true布尔值
     * @param mixed $value
     * @return boolean
     */
    final protected static function isTrue($value)
    {
        return $value === true;
    }
    
    /**
     * false布尔值
     * @param mixed $value
     * @return boolean
     */
    final protected static function isFalse($value)
    {
        return $value === false;
    }
    
    /**
     * 布尔值true|false
     * @param mixed $value
     * @return boolean
     */
    final protected static function isBool($value)
    {
        return $value === true || $value === false;
    }
    
    /**
     * 字符串
     * @param mixed $value
     * @return boolean
     */
    final protected static function isString($value)
    {
        return is_string($value);
    }
    
    /**
     * 数字或小数
     * @param mixed $value
     * @return boolean
     */
    final protected static function isNumber($value)
    {
        return is_numeric($value);
    }
    
    /**
     * int类型
     * @param mixed $value
     * @return boolean
     */
    final protected static function isInt($value)
    {
        return is_int($value);
    }
    
    /**
     * 正整数
     * @param mixed $value
     * @return boolean
     */
    final protected static function isIntUnsigned($value)
    {
        return floor($value) == $value;
    }
}