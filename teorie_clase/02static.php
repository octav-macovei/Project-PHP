<?php
/*
 * declarand o proprietate sau metoda statica,
 * acest lucru face posibila accesarea sa fara a instantia clasa
 * 
 * propritatile statice nu pot fi apelate cu operatorul ->
 * pentru apelarea lor se foloseste operatorul :: 'Scope resolution'
 * 
 * metodele statice pot fi apelate si cu operatorul -> 
 * 
 * in interiorul metodelor statice nu avem acces la pseudo-variabila $this
 * 
 */
class Persoana {
  public static $nrFemei;
  public static $nrBarbati;
  private $sex;
  public $name;
 
  function __construct($sex, $name)
  {
    $this->name = $name;
    self::statistica($sex, 1);
  } 
 
 
  public static function statistica($sex, $count)
  {
    if ($sex == 'm') {
      self::$nrBarbati += $count;
    } else {
      self::$nrFemei += $count;
    }
	
  }
  
 
  public static function getStatistica()
  {
    //    echo $this->name; // Fatal error: Using $this when not in object contex
    return array(
         'nrBarbati' => self::$nrBarbati,
         'nrFemei' => self::$nrFemei
         );
  }
 
}

$p1 = new Persoana('m', 'ion');

$p2 = new Persoana('f', 'ana');

$p3 = new Persoana('f', 'maria');
 
print_r(Persoana::getStatistica());
print_r($p3->getStatistica()); // ok si-asa
print_r(Persoana::$nrFemei); // numai asa

