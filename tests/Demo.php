<?php
use qpf\deunit\TestUnit;

include 'boot.php';

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