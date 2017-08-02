<?php 

/*
 * constantele de clasa 
 * 1. este alocata una singura pentru toate instantele
 * 
 */

// ************************exemple utilizare*******************
class MyClass
{
    const CONSTANT = 'constant value';

    function showConstant() {
        
        // apelare din interior
        echo  self::CONSTANT . "\n"; 
    }
}

// apelare din exterior
echo MyClass::CONSTANT . "\n";

$classname = "MyClass";
echo $classname::CONSTANT . "\n"; // As of PHP 5.3.0

$class = new MyClass();
$class->showConstant();

echo $class::CONSTANT."\n"; // As of PHP 5.3.0


// ************************ modificatori de acces *******************

class Foo {
    // As of PHP 7.1.0
    public const BAR = 'bar';
    private const BAZ = 'baz';
}
echo Foo::BAR, PHP_EOL;
echo Foo::BAZ, PHP_EOL;

