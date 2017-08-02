<?php

/*
 * cand comparam doua obiecte cu '==' se considera
 * ca acestea sunt egale daca si numai daca:
 * 1. sunt instante ale aceleiasi clase;
 * 2. au aceleasi atribute si valori( valorile sunt comparate cu ==)
 * 
 * cand comparam doua obiecte cu '===' atunci ele sunt egale daca se refera
 * la aceiasi instanta a unei clase.
 * 
 */

class Flag
{
    public $flag;
    
    function test() {
        /*
         * 
         */
    }
 
}

$o = new Flag();
$o->flag = 9;
$p = new Flag();
$p->flag = '9test';

if ($o == $p) {
    echo 'da';
} else {
    echo 'nu';
}

$q = $o;

if ($o == $q) {
    echo 'da';
} else {
    echo 'nu';
}

