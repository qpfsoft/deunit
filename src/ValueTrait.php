<?php
namespace qpf\deunit;

/**
 * 值内容类型
 */
trait ValueTrait
{
    /**
     * 值需要是map中的一个
     * @param mixed $value
     * @param array $map 允许的值
     * @return bool
     */
    final protected static function inString($value, array $map)
    {
        return in_array($value, $map);
    }
    
    /**
     * 数字范围验证
     * @param mixed $value
     * @param int $min 最小值
     * @param int $max 最大值
     * @return bool
     */
    final protected static function inNumber($value, $min, $max)
    {
        return $value <= $max && $value >= $min;
    }
    
    /**
     * 条件判断
     * @param mixed $value
     * @param mixed $exp
     * @param mixed $rule
     * @return bool
     */
    final protected static function where($value, $exp, $rule)
    {
        $map = [
            '='     => 'eq',
            '>='    => 'egt',
            '>'     => 'gt',
            '<='    => 'elt',
            '<'     => 'lt',
        ];
        
        switch ($exp) {
            case '=':
                return $value == $rule;
                break;
            case '>=':
                return $value >= $rule;
                break;
            case '>':
                return $value > $rule;
                break;
            case '<=':
                return $value <= $rule;
                break;
            case '<':
                return $value < $rule;
                break;
        }
        
        return false;
    }
    
    /**
     * 算是"true"范围的值 - 零也为真
     * @param mixed $value
     * @return bool 值不为 null, false, [] , '', 都将返回true
     */
    final protected static function beTrue($value)
    {
        if ($value || $value === 0) {
            return true;
        }
        
        return false;
    }
    
    /**
     * 是否纯数字 - 无符号,无小数点
     * @param mixed $value
     * @return bool
     */
    final protected static function beNumber($value)
    {
        return ctype_digit((string) $value);
    }
    
    /**
     * 是否仅含英文字符
     * @param mixed $value
     * @return bool
     */
    final protected static function beString($value)
    {
        return ctype_alpha($value);
    }
    
    /**
     * 是否仅含字母与数字
     * @param string $value
     * @return bool
     */
    final protected static function beStrAndNum($value)
    {
        return ctype_alnum((string) $value);
    }
    
    /**
     * 是否仅含小写字母
     * @param string $value
     * @return bool
     */
    final protected static function beLower($value)
    {
        return ctype_lower($value);
    }
    
    /**
     * 使用正则验证
     * @param string $value
     * @param string $rule
     * @return bool
     */
    final protected static function beRegex($value, $rule)
    {
        if (0 !== strpos($rule, '/') && !preg_match('/\/[imsU]{0,4}$/', $rule)) {
            // 不是正则表达式则两端补上/
            $rule = '/^' . $rule . '$/';
        }
        
        return is_scalar($value) && 1 === preg_match($rule, (string) $value);
    }
    
    /**
     * 有效日期字符串
     * @param string $value
     * @return bool
     */
    final protected static function beDate($value)
    {
        return strtotime((string) $value) !== false;
    }
    
    /**
     * 验证日期时间是否为指定格式
     * @param string $value 时间字符串
     * @param string $rule 格式`Y-m-d h:i:s`
     */
    final protected static function beDateFormat($value, $rule)
    {
        $arr = date_parse_from_format($rule, $value);
        return 0 == $arr['warning_count'] && 0 == $arr['error_count'];
    }
    
    /**
     * 自定义验证值
     * @param mixed $value
     * @param mixed $rule
     * @return bool
     */
    final protected static function beValue($value, $rule)
    {
        if ($rule instanceof \Closure) {
            return $rule($value);
        }
        
        return $value == $rule;
    }
}