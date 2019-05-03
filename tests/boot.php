<?php
use qpf\deunit\Deunit;
use qpf\deunit\QPFUnit;

include __DIR__ . '/../src/QPFUnit.php';
include __DIR__ . '/../src/Deunit.php';

Deunit::$namespace['qpf\deunit'] = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src';
Deunit::init();