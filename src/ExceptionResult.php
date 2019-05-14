<?php
namespace qpf\deunit;

/**
 * 捕捉获取结果时抛出的异常
 */
class ExceptionResult extends FalseResult
{
    /**
     * 捕捉到的异常
     * @var \Exception
     */
    public $excetion;
    
    /**
     * 构造函数
     * @param \Exception $e
     */
    public function __construct(\Throwable $e)
    {
        $this->excetion = $e;
        $this->result = [
            'catch'     => 'Exception - ' . get_class($e),
            'message'   => $e->getMessage(),
            'file'      => $e->getFile(),
            'line'      => $e->getLine(),
        ];
    }
}