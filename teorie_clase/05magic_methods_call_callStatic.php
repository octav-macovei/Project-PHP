<?php

/*
 * __call se apeleaza atunci cand se acceseaza o metoda incaccesibila in  context obiectual 
 * 
 * __callstatic() se apeleaza atunci cand se acceseaza o metoda incaccesibila in  context static
 * 
 */
class MethodTest
{
    
    private function runTest($x) {
        echo $x.'<br>';
    }    
    
    private static function runStaticTest($x) {
        echo $x.'<br>';
    }        
    
    public function __call($name, $arguments)
    {
        $this->$name(implode(', ', $arguments));
    }

    /**  As of PHP 5.3.0  */
    public static function __callStatic($name, $arguments)
    {
        self::$name(implode(', ', $arguments));;
    }


}

$obj = new MethodTest;
$obj->runTest('x1', 'x2');

MethodTest::runStaticTest('y1', 'y2');  // As of PHP 5.3.0
