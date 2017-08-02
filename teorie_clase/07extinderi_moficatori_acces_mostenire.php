<?php

/*
 * cand extindem o clasa, atunci in clasa copil sunt
 * mostenite toate proprietatile si metodele public si protected.
 * 
 * de asemenea toate acestea pot fi rescrise in clasa copil,
 * daca nu isi pastreaza aceeasi functionalitate ca in clasa parinte.
 * 
 */

 
class Persoana {
  protected $prenume = 'John';
  public $nume = 'Doe';
  private $nick = 'fifi';
	
    public function arataNickname()
    {
        echo $this->nick;
    }  
         
    public function arataNume()
    {
        echo $this->nume;
    }         
} 

// clasa Barbat extinde clasa Persoana	
 class Barbat extends Persoana{
	/*
		putem redefini in clasa extinsa un atribut din clasa Parinte
		dar cu un modificator egal sau mai putin restrictiv
		
		la noi:
		
		$nume 		- poate fi redefinit numai cu public
		$prenume  	- poate fi redefinit cu protected si public
		$nick  		- poate fi redefinit oricum
	
	**/
	
	 public function arataBarbat()
	 {
		 echo $this->prenume.'<br />'; // o putem accesa cu $this
		 echo $this->nume.'<br />'; // o putem accesa cu $this
		 //echo $this->nick.'<br />'; // n-o putem accesa cu $this pt. ca este private => notice
		 echo $this->arataNickname(); // o putem accesa printr-o metoda publica sau protected
		 
	 } 

} 

 $t = new Barbat(); 
 $t->arataBarbat(); // in aceasta metoda accesam proprietatile prenume si nume din Persoana
 
 echo '<br /><br /><br /><br />';
 echo $t->nume; // putem accesa direct propr. nume pentru ca este public
 
 //echo $t->prenume; // nu putem accesa direct propr. prenume pentru ca este protected => fatal error => se opreste scriptul

 
 echo '<br /><br /><br /><br />';
 class Copil extends Persoana{

     // rescriere metod aratanume() in subclasa
    public function arataNume()
    {
        echo 'Numele tau este: '.$this->nume;
    }

} 
$c = new Copil();
$c->nume = 'Ionut';
$c->arataNume();


echo '<br /><br /><br /><br />';
class Femeie extends Persoana{
    
     // rescriere metod aratanume() in subclasa cu preluare cod din aratanume() 
    public function arataNume()
    {
        echo 'Numele tau este: <br>';
        parent::arataNume();
    }    

} 
$f = new Femeie();
$f->nume = 'Dana';
$f->arataNume();

