<?php

namespace classes;

use classes\DBObject;

class Masina extends DBObject{
	
    public $numar_inmatriculare;
    public $marca;
    public $an_fabricatie;


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
        $sql = "INSERT INTO masini (numar_inmatriculare, marca, an_fabricatie, date_add, date_upd) VALUES (?, ?, ?, ?, ?)";
        
        // preparam query-ul
        if(!$stmt->prepare($sql)) {
            $excp->myHandleError(__FILE__, __LINE__, $stmt->error);            
        }
        $this->set_date_add();
        $this->set_date_upd();
        // aici se face legatura intre ? din $sql si variabilele noastre
        $stmt->bind_param('ssiss', $this->numar_inmatriculare, $this->marca, $this->an_fabricatie, $this->date_add, $this->date_upd);
		
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
    
    /**
    * Adauga obiectul curent bazei de date
    *
    * Folosim metoda cu 'prepared statement'
    */
    public function update()
    {
        global $link, $excp;
        
        // initializeaza un 'prepared statement'
        $stmt = $link->stmt_init(); 		
        $sql = "UPDATE masini SET numar_inmatriculare=?, marca=?, an_fabricatie=?, date_upd=? WHERE id={$this->id}";
        
        // preparam query-ul
        if(!$stmt->prepare($sql)) {
            $excp->myHandleError(__FILE__, __LINE__, $stmt->error);            
        }

        $this->set_date_upd();
        // aici se face legatura intre ? din $sql si variabilele noastre
        $stmt->bind_param('ssis', $this->numar_inmatriculare, $this->marca, $this->an_fabricatie, $this->date_upd);
		
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

    public function proceseaza(){
        global $erori, $vld, $fbld; 
        
        foreach ($fbld->masina_builder as &$camp){
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
    
    public function mapFieldsFormToObj(){
        global $fbld;
        foreach($fbld->masina_builder as $k=>$camp) {
            if (property_exists($this, $k)) {
                $this->$k = $camp['init_data'];
            }
            
        }        
    }
    
    public function mapFieldsObjToForm(){
        global $fbld;
        foreach($fbld->masina_builder as $k=>&$camp) {
            if (property_exists($this, $k)) {
                $camp['init_data'] = $this->$k;
            }
            
        }        
    }    
    
} // end class