<?php
namespace qpf\deunit;

/**
 * 显示结果
 * 
 * 该类代表一个正确结果, 并标识需要将结果进行显示
 */
class ShowResult extends TrueResult
{
    public function __construct($value)
    {
        $this->result = $value;
    }
}