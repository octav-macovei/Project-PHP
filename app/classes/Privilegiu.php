<?php


namespace classes;

class Privilegiu{
  
    /*
     * privData seteaza accesul pentru toate paginile din site
     * 
     */
    private $privData = array(
                'index.php'                             => 'normal',
                'lista_clienti.php'                     => 'normal',                              
                'clasament_clienti.php'                 => 'normal',                              
                'lista_incarcari.php'                   => 'normal',
                'lista_masini.php'                      => 'normal',                              
                'livrari_masina.php'                    => 'normal',                                                                                  
                'adauga_client_ps.php'                  => 'operator',                              
                'adauga_livrari_csv_ps_rollback.php'    => 'operator',                              
                'adauga_masina.php'                     => 'operator',                              
                'adauga_masina_ps.php'                  => 'operator',                              
                'modifica_masina.php'                   => 'operator',                              
                'modifica_client.php'                   => 'operator',                              
                'adauga_user.php'                       => 'admin',                             

                );
    /*
     * aici tinem privilegiile curente ale userului
     * 
     */
    private $myPrivs;


    function setPrivilegii(array $privs)
    {
          // un array cu privilegiile curente
          $this->myPrivs = $privs;
    }
 
    function check_access($pagina)
    {
        // gasim/setam privilegiul corespunzator paginii
        if(array_key_exists($pagina, $this->privData)) {
            $privRequired = $this->privData[$pagina];
        } else {
            $privRequired = 'admin'; // daca pagina ceruta nu este in privData ii setez maximum de securitate:admin
        }
        
        // verificam daca privilegiul corespunzator paginii se afla printre
        // privilegiile userului curent
        if (in_array($privRequired, $this->myPrivs)) return true;

        return false;
    }
 
} // privilegiu
