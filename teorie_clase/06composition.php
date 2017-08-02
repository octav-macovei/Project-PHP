<?php
class User {
    private $prenume;
    private $nume;
    private $email;
    private $privilegiu;    // este un obiect al clasei Privilegiu
 
    public function __construct($p, $n)
    {
        $this->prenume = $p;
        $this->nume = $n;
        $this->privilegiu = new Privilegiu();
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
 
 
class Privilegiu{
    
    private $privData = array(
                                'index.php' => 'normal',
                                'contact.php' => 'normal',
                                'members.php' => 'restricted',
                                'admin.php' => 'admin',
                                );
    
    // un array cu privilegiile alocate userului, ex: array('normal','restricted')
    private $userPrivs;
 
    public function setPrivilegii(array $privs)
    {
        // un array cu privilegiile curente
        $this->userPrivs = $privs;
    }
 
    public function check_access($pagina)
    {
        // daca privilegiul cerut de pagina respectiva (obtinut din privData pe baza paginii) este in lista myPrivs, atunci returneaza true
        $privRequired = $this->privData[$pagina];

 
        if (is_array($this->userPrivs) && in_array($privRequired, $this->userPrivs)) {
            return true;
        }
 
        return false;
    }
 
} // privilegiu
 
// aici se creeaza un obiect al clasei User si unul al clasei Privilegiu 
$u = new User('Ion', 'Popescu');

 /*
 In linia de mai jos se intampla urmatorul lucru:
 se apeleaza metoda setPrivilegii() a clasei User, care prin apelare
 apeleaza la randul ei metoda setPrivilegii() a clasei Privilegiu prin linia
 $this->prvilegiu->setPrivilegii($myPrivs) unde $myPrivs = array('normal', 'restricted')
 In acest fel atributul $myPrivs din clasa Privilegii devine array('normal', 'restricted') 
 */
$u->setPrivilegii(array('normal', 'admin'));

/*
 La fel ca mai sus, prin 
 $u->check_access('index.php')
 se apeleaza metoda check_access() a clasei User, care la randul ei apeleaza 
 metoda check_access() a clasei  Privilegiu.

*/
var_dump($u->check_access('admin.php'));
