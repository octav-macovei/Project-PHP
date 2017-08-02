<?php 

/*
 * 1. clonare intre doua obiecte.
 * 
 * 1.a imlicit clonarea se face superficial(shallow cloning)
 * 
 * 1.b putem forta clonarea sa fie totala(deep cloning)
 * 
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

class ProjectV1 {
    protected $developer; // este obiect al clasei Person - compozitie

    public function setDeveloper(Person $developer) {
        $this->developer = $developer;

        return $this;
    }

    public function getDeveloper() {
        return $this->developer;
    }
}

$developer_one = new Person();
$developer_one->setName("Ion");

$project_one = new ProjectV1();

$project_one->setDeveloper($developer_one);

$project_two = clone $project_one;

// schimbam numele developerului in proiectul doi
$project_two->getDeveloper()->setName("Dan");

// se schimba si in proiectul unu pentru clonarea se face implicit superficial(shallow), se pastreaza referintele proprietatilor
var_dump($project_one->getDeveloper()->getName()); 



/*
 * pentru a evita acest lucru adaugam propria metoa de clonare prin care 
 * in clasa Project1 prin care la clonare clonam si obiectul developer vezi mai jos
 */

class ProjectV2 {
    protected $developer; // este obiect al clasei Person - compozitie
    
    public function __clone() {
        $this->developer = clone $this->developer;
    }    

    public function setDeveloper(Person $developer) {
        $this->developer = $developer;

        return $this;
    }


    public function getDeveloper() {
        return $this->developer;
    }
}

$developer_three = new Person();
$developer_three->setName("Victor");

$project_three = new ProjectV2();

$project_three->setDeveloper($developer_three);

$project_for = clone $project_three;

// schimbam numele developerului in proiectul patru
$project_for->getDeveloper()->setName("Luka");

// nu se mai schimba si in proiectul trei pentru ca clonarea se face total(deep)
var_dump($project_three->getDeveloper()->getName()); 
