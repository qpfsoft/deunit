<?php
use qpf\deunit\TestUnit;

include 'boot.php';

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
        return $this->isTrue(0);
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
}


$test = new BaseTest();

var_export($test->runTestUnit());

