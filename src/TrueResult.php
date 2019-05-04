<?php
namespace qpf\deunit;

/**
 * 正确结果
 */
class TrueResult implements ResultInterface
{
    /**
     * 结果值
     * @var mixed
     */
    public $result = 'ok';
    
    public function __toString()
    {
        return '__ok__';
    }
}