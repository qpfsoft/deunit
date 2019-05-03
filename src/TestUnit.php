<?php
namespace qpf\deunit;

/**
 * 单元测试基类
 */
abstract class TestUnit
{
    use TypeTrait;
    use ValueTrait;

    /**
     * 运行单元测试
     * @param bool $throw 是否失败立即结束
     * @throws \Exception
     * @return array
     */
    final public static function runTestUnit($throw = false)
    {
        $reclass = new \ReflectionClass(static::class);
        
        $methods = $reclass->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        $filter = ['runTestUnit']; // 'assert'
        
        $result = [];
        
        /* @var $method \ReflectionMethod  */
        foreach ($methods as $method) {
            $name = $method->getName();
            
            if (in_array($name, $filter)) {
                continue;
            }
            
            $result[$name] = $method->invoke(new static()) ? '__ok__' : '__error__';
            
            if ($throw && $result[$name] == '__error__') {
                throw new \Exception($name . ' Test failed');
            }
        }
        
        $assess = array_count_values($result);
        
        $info = [];
        $info['count'] = count($result);
        $info['pass'] = round($assess['__ok__'] / count($result) * 100) . '%';
        $info['fail'] = round($assess['__error__'] / count($result) * 100) . '%';
        $info['info'] = $result;
        
        return $info;
    }
    
    
}