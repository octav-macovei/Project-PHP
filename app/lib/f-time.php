<?php

function two_digits($nr)
{
    /*
     * functia primeste parametru $nr
     * si daca este format dintr-o cifra il 
     * returneaza cu 0 in fata
     * 
     */
    
    if (!is_numeric($nr)) return $nr;
	
    if (strlen($nr)==1) return '0'.$nr;

    return $nr;
}
function sec_to_time($n)
{
    /*
     * functia primeste ca parametru un numar de secunde
     * si returneaza timpul in format "hh:mm:ss"
     */    
    // calcul ore
    $ore = floor($n/3600);
	
    // cacul minute
    $sec_ramase = $n%3600;
    
    //calcul minute
    $min = floor($sec_ramase/60);
    
    $sec = $sec_ramase%60;    
    
    
    return two_digits($ore).':'.  two_digits($min).':'.two_digits($sec);
}

function time_to_sec($n)
{
    /*
     * functia primeste ca parametru un str in format "hh:mm:ss"
     * si returneaza numarul de secunde 
     */
    return substr($n,0,2)*3600 + substr($n,3,2)*60 + substr($n,6,2);
    
}