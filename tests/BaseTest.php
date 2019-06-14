<?php
use qpf\deunit\TestUnit;

include 'boot.php';

/**
 * 测试结果
 */
class BaseTest extends TestUnit
{

    public function testFunc1()
    {
        return $this->beTrue(1);
    }
    
    public function testFunc2()
    {
        return $this->beTrue(1);
    }
    
    public function testFunc3()
    {
        return $this->isTrue(0); // false
    }
    
    public function testFunc4()
    {
        return $this->beTrue(1);
    }
    
    public function testFunc5()
    {
        return ['static' => 'ok'];
    }
    
    public function testFunc6()
    {
        return 'ok';
    }
    
    public function testFunc7()
    {
        return 1;
    }
    
    public function testFunc8()
    {
        return 0;
    }
    
    public function testFunc9()
    {
        throw new \Exception('params missing'); // error
    }
}


var_export(BaseTest::runTestUnit());

