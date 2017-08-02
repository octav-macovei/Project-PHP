<?php

namespace classes;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormBuilders
 *
 * @author catalin
 */
class FormBuilders {
// definim campurile din formular de adaugare/mdoficare masina intr-un array
    public $masina_builder = [
                    'numar_inmatriculare'=> [
                                                'name' => 'numar_inmatriculare', //valoarea atributului name
                                                'type' => 'text', // tipul campului
                                                'init_data' => '', // valoarea atributului value
                                                'required' => 1, // daca campul este obligatoriu
                                                'label' => 'Numar inmatriculare',
                                                'regex' => 'reg_numar',
                                            ],      
                    'marca'=>               [
                                                'name' => 'marca', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Marca',
                                                'regex' => 'reg_marca',
                                            ],   
                    'an_fabricatie'=>          [
                                                'name' => 'an_fabricatie', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'required' => 1,
                                                'label' => 'An de fabricatie',
                                                'regex' => 'reg_an',
                                            ],     

    ];

    public $user_builder = [
                    'username'=>            [
                                                'name'=>'username', //valoarea atributului name
                                                'type'=>'text', // tipul campului
                                                'init_data'=>'', // valoarea atributului value
                                                'required'=>1, // daca campul este obligatoriu
                                                'label'=> 'Username',
                                                'regex'=> 'reg_username',
                                            ],      
                    'prenume'=>             [
                                                'name'=>'prenume', 
                                                'type'=>'text', 
                                                'init_data'=>'', 
                                                'required'=>1,
                                                'label'=> 'Prenume',
                                                'regex'=> 'reg_nume',
                                            ],   

                    'nume'=>                [
                                                'name'=>'nume', 
                                                'type'=>'text', 
                                                'init_data'=>'', 
                                                'required'=>1,
                                                'label'=> 'Nume',
                                                'regex'=> 'reg_nume',
                                            ],   

                    'pw'=>                  [
                                                'name'=>'pw', 
                                                'type'=>'password', 
                                                'init_data'=>'', 
                                                'required'=>1,
                                                'label'=> 'Parola',
                                                'regex'=> 'reg_pw',
                                            ],     

                    'email'=>               [
                                                'name'=>'email', 
                                                'type'=>'text', 
                                                'init_data'=>'', 
                                                'required'=>1,
                                                'label'=> 'Email',
                                                'regex'=> 'reg_email',
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
    
    public $incarcare_builder = [
                    'masina_id'=> [
                                                'name' => 'masina_id', 
                                                'type' => 'choice', 
                                                'init_data' => [], 
                                                'required' => 1, // daca campul este obligatoriu
                                                'label' => 'Masina',
                                                'multiple'=>false,
                                                'expanded'=>false,
                                                'required'=>1,
                                                'data'=>[], // aici vom pune vaorile primite prin $_POST    
                                            ],      
                    'rafinarie'=>               [
                                                'name' => 'rafinarie', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Rafinarie',
                                                'regex' => 'reg_rafinarie',
        
                                            ],   
                    'aviz_incarcare'=>          [
                                                'name' => 'aviz_incarcare', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Aviz incarcare',
                                                'regex' => 'reg_aviz',
                                            ],    
        
                    'cantitate'=>          [
                                                'name' => 'cantitate', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Cantitate',
                                            ],  
        
                    'data_incarcarii'=>          [
                                                'name' => 'data_incarcarii', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Data incarcarii',
                                                'regex' => 'reg_data',
                                            ],          
        
                    'densitate'=>          [
                                                'name' => 'densitate', 
                                                'type' => 'text', 
                                                'init_data' => '', 
                                                'required' => 1,
                                                'label' => 'Densitate',
                                            ],         

    ];    
}
