<?php
namespace qpf\deunit;

/**
 * 错误结果
 */
class FalseResult implements ResultInterface
{
    /**
     * 结果值
     * @var mixed
     */
    public $result = 'error';
    
    public function __toString()
    {
        return '__error__';
    }
}