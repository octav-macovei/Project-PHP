<?php

 
interface  Persoana {
 
    function arataPersoana($a, $b);
	
} 

 class Barbat implements Persoana{

	
    public function arataPersoana($a='',$b='')
    {
        echo $this->a.' '.$this->b;
		 
    } 

} 

$u = new Barbat();

$u->a='ion';
$u->b='popa';

$u->arataPersoana();

 
$path = new DirectoryIterator('.');
 
foreach ($path as $file) {
 
  if (!$file->isDot()) {
    echo $file->getFilename() . "***";
    echo $file->getSize() . '***';
    echo $file->getRealPath() . '**';
    echo '<br />';
  }
 
}