<?php

namespace classes;

class Validator
{
    // regexuri pentru validarea diferitelor date preluate de la utilizatori

    // atentie in aceste regexuri sunt foarte importante tokenurile ^ si $

    // validare nume oras - permitem cratima litere si spatii
   public $reg_oras = '/(?i)^[-a-z\s]+$/';

    // validare nume-prenume - permitem cratima litere si spatii
   public $reg_nume = '/(?i)^[-a-z\s\']+$/';

    // validare utilizator - permitem cratima litere cifre si spatii
   public $reg_username = '/(?i)^[-_a-z0-9]+$/';

    // validare parola - permitem cratima litere cifre  virgula punct si spatii intre 6 si 16 caractere
   public $reg_pw = '/(?i)^[-_a-z0-9,.]{6,16}$/';

    // validare email
   public $reg_email = '/(?i)^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/';

    // validare data introdusa
   public $reg_data = '/^(19|20)\d\d[-\/.]([1-9]|0[1-9]|1[012])[-\/.]([1-9]|0[1-9]|[12][0-9]|3[01])$/';

    // validare nume sau cale catre folder
   public $reg_folder = '/(?i)^[-a-z\s_0-9:\/\\.]+$/';

    // validare numar masina
   public $reg_numar = '/^(?i)(b|[a-z]{2})\d{2,3}[a-z]{3}$/';

    // validare marca masina
   public $reg_marca = '/^(?i)[a-z\s]{2,10}$/';

    // validare an
   public $reg_an = '/^(?i)\d{4}$/';

    // validare numar aviz
   public $reg_aviz = '/^(?i)[-a-z0-9]{1,25}$/';

    //validare cantitate
   public $reg_cantitate = '/^(?i)\d{1,5}$/';

    // validare densitate
   public $reg_densitate = '/^(?i)0\.\d{1,3}$/';

    // validare rafinarie
   public $reg_rafinarie = '/(?i)^[-a-z\s.]+$/';

    /**
     * @author My Name <my.name@example.com>
     * 
     * O functie ce returneaza un tag form
     * 
     * @param string $type Un string ce reprezinta tipul validarii.
     * 
     * @param mixed $str Un string ce trebuie validat.
     * 
     * @return int <b>preg_match</b> returns 1 if the <i>pattern</i>
     * matches given <i>subject</i>, 0 if it does not, or <b>FALSE</b>
     * 
     */
    function validate($type, $str)
    {
        return preg_match($type, $str);

    }
}