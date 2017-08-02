<?php

namespace classes;

use classes\DBObject;

class Incarcare extends DBObject{

    public $masina_id;
    public $rafinarie;        
    public $aviz_incarcare;        
    public $cantitate;        
    public $densitate;        
    public $data_incarcarii;
    
    /**
    * Adauga obiectul curent bazei de date
    *
    * Folosim metoda cu 'prepared statement'
    */
    public function add()
    {
        global $link, $excp;
        
        // initializeaza un 'prepared statement'
        $stmt = $link->stmt_init(); 		
        $sql = "INSERT INTO incarcari (masina_id, rafinarie, aviz_incarcare, cantitate, densitate, data_incarcarii, date_add, date_upd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // preparam query-ul
        if(!$stmt->prepare($sql)) {
            $excp->myHandleError(__FILE__, __LINE__, $stmt->error);            
        }
        $this->set_date_add();
        $this->set_date_upd();
        // aici se face legatura intre ? din $sql si variabilele noastre
        $stmt->bind_param('issidsss', 
                $this->masina_id, 
                $this->rafinarie, 
                $this->aviz_incarcare, 
                $this->cantitate,                 
                $this->densitate,                 
                $this->data_incarcarii,                 
                $this->date_add, 
                $this->date_upd);
		
        /*
            - primul parametru este variabila data de mysqli_prepare;
            - al 2-lea este un string ce continte tipul de date pentru 
            fiecare parametru din $sql(fiecare semn al intrebarii), ordinea se respecta			
            i pentru integer, 
            d pentru double, 
            s pentru string, 
            b pentru blob

        */
        if(!$stmt->execute()) {
            $excp->myHandleError(__FILE__, __LINE__, $stmt->error);   
        }        
        		
        //inchidem prepared statement
        $stmt->close();	
    }   
    
    public function mapFieldsFormToObj(){
        global $fbld;
        foreach($fbld->incarcare_builder as $k=>$camp) {
            
            if ('choice' == $camp['type']) {
                if (property_exists($this, $k)) {
                    $this->$k = $camp['data'];
                }
            } else {
                if (property_exists($this, $k)) {
                    $this->$k = $camp['init_data'];
                }                
            }

        }        
    }    
    

    public function proceseaza()
    {
        global $erori, $vld, $fbld; 
        
        foreach ($fbld->incarcare_builder as &$camp){
            
            if ('choice' == $camp['type']) {
                $camp['data'] = filter_input(INPUT_POST, $camp['name'], FILTER_SANITIZE_STRING); 
                if(null === $camp['data'] && 1==$camp['required']) {
                    $camp['data'] = []; //resetam ce avem in data
                    $erori[$camp['name']] = 'Alege cel putin un privilegiu!';
                } else if (!in_array($camp['data'], array_keys($camp['init_data']))) { 
                    // daca $camp['data'] valori ce nu se afla si in array_keys($camp['init_data'])
                    // inseamna ca formularul a fost 
                    // fortat prin acest camp deci 
                    // restam ce avem in $camp['data']
                    $camp['data'] = ''; 
                    // si adaugam o eroare in $erori
                    $erori[$camp['name']] = 'Valori gresite pentru masina!';
                }                  
                
            } elseif (in_array($camp['name'], ['densitate', 'cantitate'])) {
                
                if (false !== ($camp['init_data'] = filter_input(INPUT_POST, $camp['name'], FILTER_SANITIZE_NUMBER_FLOAT))){       

                    if ('' === $camp['init_data'] && 1 === $camp['required']){
                        // verificam daca a introdus ceva
                       $erori[$camp['name']] = 'Campul "'.$camp['label'].'" este obligatoriu!';
                    }
                }                 
                
            } else {
                
                if (false !== ($camp['init_data'] = filter_input(INPUT_POST, $camp['name'], FILTER_SANITIZE_STRING))){       

                    if ('' === $camp['init_data'] && 1 === $camp['required']){
                        // verificam daca a introdus ceva
                       $erori[$camp['name']] = 'Campul "'.$camp['label'].'" este obligatoriu!';
                    } else if (!$vld->validate($vld->{$camp['regex']},$camp['init_data'])){
                        // resetam 
                        $camp['init_data'] = '';    
                        $erori[$camp['name']] = 'Campul "'.$camp['label'].'" nu este valid!';
                    }       
                }                 
                
            }

        }        
    }    

        
 

} // end class