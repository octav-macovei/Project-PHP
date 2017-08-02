<?php

class Persoana {
    public $prenume = 'John';
    public $nume = 'Doe';
    public $nick = 'fifi';
    private $email = 'john@aaaa.eu';

    public function afiseaza_toate_proprietatile()
    {
        foreach($this as $k => $v)
        echo $k.'=>'.$v.'<br />';
    }
} 

$p = new Persoana();
// in acest caz iterarea se face prin toate atributele
// deoarece arataPersoana 'vede' toate atributele
$p->afiseaza_toate_proprietatile();

// in acest caz iterarea se face numai prin atributele vizibile
foreach ($p as $k=>$v)
	echo $k.'=>'.$v.'<br />';