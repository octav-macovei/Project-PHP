<?php

// definim campurile din formular de adaugare/mdoficare masina intr-un array
$masina_builder = [
                'numar_inmatriculare'=> [
                                            'name'=>'numar_inmatriculare', //valoarea atributului name
                                            'type'=>'text', // tipul campului
                                            'init_data'=>'', // valoarea atributului value
                                            'required'=>1, // daca campul este obligatoriu
                                            'label'=> 'Numar inmatriculare',
                                            'regex'=> $reg_numar,
                                        ],      
                'marca'=>               [
                                            'name'=>'marca', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'label'=> 'Marca',
                                            'regex'=> $reg_marca,
                                        ],   
                'an_fabricatie'=>          [
                                            'name'=>'an_fabricatie', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'required'=>1,
                                            'label'=> 'An de fabricatie',
                                            'regex'=> $reg_an,
                                        ],     

];

$user_builder = [
                'username'=>            [
                                            'name'=>'username', //valoarea atributului name
                                            'type'=>'text', // tipul campului
                                            'init_data'=>'', // valoarea atributului value
                                            'required'=>1, // daca campul este obligatoriu
                                            'label'=> 'Username',
                                            'regex'=> $reg_username,
                                        ],      
                'prenume'=>             [
                                            'name'=>'prenume', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'label'=> 'Prenume',
                                            'regex'=> $reg_nume,
                                        ],   
    
                'nume'=>                [
                                            'name'=>'nume', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'label'=> 'Nume',
                                            'regex'=> $reg_nume,
                                        ],   
    
                'pw'=>                  [
                                            'name'=>'pw', 
                                            'type'=>'password', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'label'=> 'Parola',
                                            'regex'=> $reg_pw,
                                        ],     
       
                'email'=>               [
                                            'name'=>'email', 
                                            'type'=>'text', 
                                            'init_data'=>'', 
                                            'required'=>1,
                                            'label'=> 'Email',
                                            'regex'=> $reg_email,
                                        ],  
                'privilegii'=>          [
                                            'name'=>'privileii', 
                                            'type'=> 'choice', // camp de tip alegere
                                            'init_data'=>[
                                                            'normal'    =>'Normal',
                                                            'operator'  =>'Operator',
                                                            'admin'     =>'Administrator'
                                                         ],
                                            'multiple'=>true,
                                            'expanded'=>true,
                                            'required'=>1,
                                            'label'=> 'Alege privilegii',
                                            'data'=>[], // aici vom pune vaorile primite prin $_POST                    
                                        ], 
           
   

];