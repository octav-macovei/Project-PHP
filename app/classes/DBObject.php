<?php

namespace classes;
/*
 * In aceasta clasa vom tine proprietati si
 * metode pe care le regasim in toate clasele noastre(Client, Masina, Livrare, Incarcare)
 */

class DBObject{
    
    // aici tinem corespondentele in denumirele claselor si ale tabelelor corespondente
    // din db
    static $coresp_clase_db = array(
        'classes\Client'=>'clienti',
        'classes\Incarcare'=>'incarcari',
        'classes\Livrare'=>'livrari',
        'classes\Masina'=>'masini',
    );
    
    public $table;

    public $id;    
    public $date_upd;
    public $date_add;    

    function __construct()
    {
        // preluam numele clasei curente get_class($this)
        $this->table = self::$coresp_clase_db[get_class($this)];
    }
    
    public function set_date_add(){
        $dat = new \DateTime('now', new \DateTimeZone('Europe/Bucharest'));
        $this->date_add = $dat->format('Y-m-d H:i:s');              
        
    }
    
    public function set_date_upd(){
        $dat = new \DateTime('now', new \DateTimeZone('Europe/Bucharest'));
        $this->date_upd = $dat->format('Y-m-d H:i:s');             
        
    }     
    
    //returneaza un array cu toate inregistrarea ci id-ul respectiv
    function findById($id='')
    {
        global $link, $excp; // conexiunea la db
        
        $sql = 'SELECT * FROM '.$this->table." WHERE id=$id LIMIT 1";
        
        $result = $link->query($sql) or $excp->myHandleError(__FILE__, __LINE__, $link->error);
	
        if ($d = $result->fetch_assoc()) {
            foreach ($this as $k=>$v) {
                if (array_key_exists($k, $d)) $this->$k = $d[$k];
            }            
        }
        $result->free_result(); // golim variabila $result 
        
        return $this;

    }	

    //returneaza un array cu toate inregistrarile din tabelul
    //corespunzator clasei curente
    
    function findAll()
    {
        global $link, $excp; 
        
        $sql = 'SELECT * FROM '.$this->table;
        
        $result = $link->query($sql) or $excp->myHandleError(__FILE__, __LINE__, $link->error);
        
        $switch = true;
        while($d = $result->fetch_assoc())
        {
            if($switch)
            {            
                $arr_fin[]=array_keys($d); // punem in array-ul final capul de tabel care este dat de cheile lui $d
                $switch = false;
            } 

            $arr_fin[]=$d;

        } //end while

        if (isset($arr_fin)) 
            return $arr_fin;
  
        return array();        

    }
    
    //returneaza un array cu toate inregistrarile din tabelul
    //corespunzator clasei curente
    
    function findAllAssoc()
    {
        global $link, $excp; 
        
        $sql = 'SELECT * FROM '.$this->table;
        
        $result = $link->query($sql) or $excp->myHandleError(__FILE__, __LINE__, $link->error);

        while($d = $result->fetch_assoc())
        {

            $arr_fin[]=$d;

        } //end while

        if (isset($arr_fin)) 
            return $arr_fin;
  
        return array();        

    }    
    
    /*
     * returneaza un array care pe langa inregistrarile 
     * clasei curente adauga in array si niste linkuri
     * vezi cum arata tabelul din lista_incarcari.php
     * 
     * ex
     * array(     
     *      array('path' => 'detalii_masina.php', 'key' => 'masina_id', 'content' => 'detalii'),
     *      array('path' => 'livrari_masina.php', 'key' => 'masina_id', 'content' => 'detalii'),

     *    )
     * 
     */
    function findAllWithLinks(array $links)
    {
	global $link, $excp;
        
        $sql = "SELECT * FROM {$this->table} WHERE 1";        
        $result = $link->query($sql) or $excp->myHandleError(__FILE__, __LINE__, $link->error);
        
        $switch = true;
        while($d = $result->fetch_assoc())
        {
            foreach($links as $v)
            {
                 $d[$v['content']] = '<a href = "'.$v['path'].'?'.$v['key'].'='.$d["id"].'">'.$v['content'].'</a>';
            }
            
            if($switch)
            {            
                $arr_fin[]=array_keys($d); // punem in array-ul final capul de tabel care este dat de cheile lui $d
                $switch = false;
            } 
            $arr_fin[]=$d;
        } //end while

        if (isset($arr_fin)) 
            return $arr_fin;
  
        return array();      
    }    
    
    /*
     * 
     * o metoda ce returneaza toate inregistrarile de pe o coloana
     * 
     */
    function getColumn($column)
    {
	global $link; // conexiunea la db
        
        $sql = "SELECT id, $column FROM {$this->table} WHERE 1";
        
        $result = $link->query($sql) or die($link->error);

        while($d = $result->fetch_assoc())
        {
            $arr_fin[$d['id']]=$d[$column];
        } //end while

        if (isset($arr_fin)) 
            return $arr_fin;
  
        return array();        

    }	
    
    /*
     * returneaza valoarea de pe o coloana pentru un anumit id
     * 
     */
    
    function getColumnById($column, $id)
    {
	global $link; // conexiunea la db
        
        $sql = "SELECT $column FROM {$this->table} ";
        
        if ($id)
            $sql .= "WHERE id=$id";
        
        $result = $link->query($sql) or die($link->error);

        $d = $result->fetch_assoc();
        
        if ($d) return $d;
        
        return '';      

    }	    

} // end class