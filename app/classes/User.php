<?php

namespace classes;

class User {
    
    private $username;
    private $pw;
    private $prenume;
    private $nume;
    private $email;
    private $privilegiu;  
  

    function __get($atribut)
    {
        return $this->$atribut;
    }

    function __set($atribut, $val)
    {
        $this->$atribut = $val;
        return $this;
    }

    function __construct()
    {           
        $this->privilegiu = new Privilegiu(); // cream aici un obiect al clasei Privilegiu
    }

    function setPrivilegii(array $myPrivs)
    {
        $this->privilegiu->setPrivilegii($myPrivs); // aici apelam metoda clasei Privilegiu
    }


    function check_access($pagina)
    {
        return $this->privilegiu->check_access($pagina); // aici apelam metoda clasei Privilegiu
    }
        

    function is_logged()
    {
        /*
         * functia verifica daca utilizatorul este logat
         */
        
        if (isset($_SESSION['uid'])) 
            return 1;

        return 0;
    }

} // end class

 
 