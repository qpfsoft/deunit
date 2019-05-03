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
     * 测试开始回调方法
     */
    public function setUp()
    {
        
    }
    
    /**
     * 测试结束回调方法
     */
    public function tearDown()
    {
        
    }

    /**
     * 运行单元测试
     * @param bool $throw 是否失败立即结束
     * @throws \Exception
     * @return array
     */
    final public static function runTestUnit($throw = false)
    {
        $object = new static();
        $reclass = new \ReflectionClass($object);
        
        // 公共方法
        $methods = $reclass->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        $filter = ['runTestUnit']; // 'assert'
        
        $result = [];
        
        $object->setUp();
        
        /* @var $method \ReflectionMethod  */
        foreach ($methods as $method) {
            $name = $method->getName();
            
            // test前缀方法名
            if (strncasecmp($name, 'test', 4) !== 0 || in_array($name, $filter)) {
                continue;
            }
            
            $result[$name] = $method->invoke($object) ? '__ok__' : '__error__';
            
            if ($throw && $result[$name] == '__error__') {
                throw new \Exception($name . ' Test failed');
            }
        }
        
        $object->tearDown();
        
        $assess = array_count_values($result);
        
        $info = [];
        $info['count'] = count($result);
        $info['pass'] = round($assess['__ok__'] / count($result) * 100) . '%';
        $info['fail'] = round($assess['__error__'] / count($result) * 100) . '%';
        $info['info'] = $result;
        
        return $info;
    }
    
    
}