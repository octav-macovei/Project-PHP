<?php

 /*
  * clasele declarate abstracte nu pot fi instantiate
  * 
  * daca o clasa contine o metoda abstracta atunci clasa trebuie declarata abstracta
  * 
  * o metoda abstracta este o metoda care nu are implementare, ex:
  * 
  * abstract function arataPersoana($a, $b);
  * 
  * o clasa care extinde o clasa abstracta trebuie sa implementeze toate metodele abstracte ale acelei clase
  * sau daca nu le implementeaza pe toate trebuie declarata la randul ei abstracta
  * 
  * 
  * 
  */
abstract class Persoana {

    public $a;
    public $b;
 
    abstract function arataPersoana($a, $b);
	
} 

class Barbat extends Persoana{

    public function arataPersoana($a='',$b='')
    {
        echo $this->a.' '.$this->b;
		 
    } 
         
         

} 

$u = new Barbat();

$u->a='ion';
$u->b='popa';

$u->arataPersoana();



