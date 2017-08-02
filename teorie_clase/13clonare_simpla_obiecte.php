<?php 

/*
 * 1. clonare intre doua obiecte.
 *
 */

class Person {
    protected $name;

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function getName() {
        return $this->name;
    }
}

$p1 = new Person();

$p1->setName('Ion');

$p2 = clone $p1;

$p2->setName('Dan');

var_dump($p1,$p2);

$p1->setName('Costel');

var_dump($p1,$p2);