<?php 

/*
 * 1. atribuire intre doua obiecte
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

$p2 = $p1;

var_dump($p1,$p2);
/*
 * p1 si p2 pointeaza catre aceeasi instanta a clasei Person
 * de aceea daca se schimba unul si se schimba si celalalt
 */

$p2->setName('Dan');

var_dump($p1,$p2);
