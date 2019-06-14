<?php
namespace qpf\deunit;

/**
 * 单元测试基类
 * 
 * 单元测试编写类继承该抽象方法, 类名*建议*以`Test`后缀.
 * 测试方法*必须*以`test`前缀命名, 否则不会自动测试.
 * 提供[[setUp()]]与[[tearDown()]]分别在测试方法前后自动执行.
 * 
 * 测试方法返回值规则:
 * 单元测试内置的断言结果方法, 始终返回true|false布尔值.
 * 也可自行编写结果断言验证, 确保返回true|false即可.
 * 
 * 当测试的方法需要打印信息, 建议直接返回.
 */
abstract class TestUnit
{
    use TypeTrait;
    use ValueTrait;
    
    /**
     * 建立 - 测试开始回调方法
     */
    public function setUp()
    {
        
    }
    
    /**
     * 拆除 - 测试结束回调方法
     */
    public function tearDown()
    {
        
    }
    
    /**
     * 运行方法测试
     * @param string $method 方法名称
     * @param array $params 调用传入参数
     * @throws \Exception
     * @return mixed
     */
    final public static function runTestMethod($method, array $params = [])
    {
        try {
            $object = new static();
        } catch (\Throwable $e) {
            return ['class' => static::class, 'exception' => $e->getMessage()];
        }

        if (method_exists($object, $method)) {
            try {
                return $result = call_user_func_array([$object, $method], $params);
            } catch (\Throwable $e) {
                $result = $e;
            }
            return Results::parse($result);
        } else {
            throw new \Exception('method does not exist ');
        }
    }

    /**
     * 运行单元测试
     * @param bool $throw 是否失败立即结束
     * @throws \Exception
     * @return array
     */
    final public static function runTestUnit($throw = false)
    {
        try {
            $object = new static();
        } catch (\Throwable $e) {
            return ['class' => static::class, 'exception' => $e->getMessage()];
        }

        $reclass = new \ReflectionClass($object);
        // 公共方法
        $methods = $reclass->getMethods(\ReflectionMethod::IS_PUBLIC);
        
        $filter = ['runTestUnit']; // 'assert'
        
        $results = [];
        
        $object->setUp();
        
        /* @var $method \ReflectionMethod  */
        foreach ($methods as $method) {
            $name = $method->getName();
            
            // test前缀方法名
            if (strncasecmp($name, 'test', 4) !== 0 || in_array($name, $filter)) {
                continue;
            }
            
            try {
                $result = $method->invoke($object);
            } catch (\Throwable $e) {
                $result = $e;
            }
            
            // 解析结果
            $results[$name] = Results::parse($result);
            
            // 失败终止
            if ($throw && $results[$name] instanceof FalseResult) {
                throw new \Exception($name . ' Test failed');
            }
        }
        
        $object->tearDown();

        return Results::assessInfo($results);
    }
}