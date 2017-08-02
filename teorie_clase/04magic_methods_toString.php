<?php


class User {
    private $prenume;
    private $nume;
    private $email;
    private $privilegiu;    // este un obiect al clasei Privilegiu
    
    public function __construct($prenume, $nume) 
    {
        $this->prenume = $prenume;
        $this->nume = $nume;

    }
    
    public function __toString()
    {
        return $this->prenume.' '.$this->nume;
    }
 
 
    public function setPrivilegii(array $userPrivs)
    {        
        $this->privilegiu->setPrivilegii($userPrivs);
    }
 
 
    public function check_access($pagina)
    {
        return $this->privilegiu->check_access($pagina);
    }
 
}


$user = new User('Ion', 'Popescu');
echo $user;

