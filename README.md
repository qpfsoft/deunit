deunit
===

Simple Unit Test!

单元测试编写类继承该抽象方法, 类名*建议*以`Test`后缀.

测试方法*必须*以`test`前缀命名, 并且public权限, 否则不会方法被测试.

提供[[setUp()]]与[[tearDown()]]分别在测试方法前后自动执行.

setUp() - 建议编写配置与类初始化, 例如 数据库连接 与 表创建

tearDown() - 可用于释放资源
 
### 测试返回值

单元测试内置的断言结果方法, 始终返回true|false布尔值.

也可自行编写结果断言验证, 确保返回true|false即可.

当测试的方法需要打印信息, 建议直接返回.

### 异常捕捉

单元测试方法允许抛出异常, Deunit会捕捉异常, 并判定测试失败!

会在测试评估信息中显示异常消息!

## 示例

```php
class FooTest extends TestUnit
{
    public $number;
    
    /**
     * 建立
     */
    public function setUp()
    {
        $this->number = 5;
        
        parent::setUp();
    }
    
    /**
     * 拆除
     */
    public function tearDown()
    {
        $this->number = null;
        
        parent::tearDown();
    }
    
    /**
     * 加
     * @return bool
     */
    public function testPlus()
    {
        $result = $this->number + 5;
        
        return $this->where($result, '=', 10);
    }
    
    /**
     * 减
     * @return bool
     */
    public function testLess()
    {
        $result = $this->number - 1;
        
        return $result;
    }
    
    /**
     * 除
     * @return bool
     */
    public function testExcept()
    {
        throw new Exception('missing');
    }
}

$info = FooTest::runTestUnit();
var_export($info);
```

打印信息

```php
array (
  'count' => 3, // 执行测试数量
  'pass' => '67%', // 测试通过率
  'fail' => '33%', // 测试失败率
  'info' => 
  array (
    'testPlus' => 'ok',
    'testLess' => 4,
    'testExcept' => 'missing',
  ),
)
```
