<?php
/*
	atribut incaccesibil = nu exista sau nu se 'vede' din cauza modificatorului
	
	 __set() se executa cand se incearca modificarea unui atribut incaccesibil

	__get() se executa cand se incearca citirea unui atribut incaccesibil

	__isset() se executa cand se incearca executia fct. isset() sau empty() cu un atribut incaccesibil ca parametru

	__unset() se executa cand se incearca executia fct. unset() cu un atribut incaccesibil ca parametru

*/

class Persoana {

    private $nume;
    private $prenume;
    private $adresa;
    public $oras;  
 
    function __set($nume_atribut, $valoare)
    {
        $this->$nume_atribut = $valoare; 
    }

    function __get($nume_atribut)
    {
        return $this->$nume_atribut;
    }

    public function __isset($nume_atribut) {

        return isset($this->$nume_atribut);
    }

    public function __unset($nume_atribut)
    {
        unset($this->$nume_atribut);
    }
 
} /// end class
 
 
$p = new Persoana();

$p->nume = 'Ionescu'; // aici se acceseaza metoda __set pentru ca nume nu este vizibil 

$p->prenume = 'Gabi'; // aici se acceseaza metoda __set pentru ca prenume nu este vizibil 

$p->oras = 'Bucuresti'; // aici nu se acceseaza metoda __set pentru ca oras este public deci vizibil

$p->adresa = 'str arcului'; // aici se acceseaza metoda __set pentru ca adresa este private deci invizibila
 
echo $p->prenume."<br />\n"; // acum se acceseaza metoa __get

echo $p->nume."<br />\n"; // acum se acceseaza metoa __get

echo $p->oras."<br />\n"; // aici nu se acceseaza metoda __get pentru ca oras este public deci vizibil
echo $p->adresa."<br />\n"; // aici se acceseaza metoda __get pentru ca ca adresa este private deci invizibila

if (isset($p->oras)) {
    echo 'da';
} else {
    echo 'nu';
}

unset($p->nume);

if (isset($p->nume)) {
    echo 'da';
} else {
    echo 'nu';
}
