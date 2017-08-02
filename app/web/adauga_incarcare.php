<?php

use classes\Incarcare;
use classes\Masina;

/**************** START - ZONA INCLUDERI FISIERE AUXILIARE ************************************/

include_once '../config/start.php'; 

/**************** END  - ZONA INCLUDERI FISIERE AUXILIARE **************************************/


/**************** START - ZONA VERIFICARE ACCES ************************************/
// verificam daca are acces pe aceasta pagina
if (!$u->check_access(basename($_SERVER['PHP_SELF']))){
	header ('Location:no_privilege.php');
	exit; //oprim executia scriptului
}
/**************** END  - VERIFICARE ACCES **************************************/


/**************** START - ZONA DECLARARE VARIABILE AUXILIARE ***********************************/
$incarcare = new Incarcare();
$proceseaza = 0; // cand $proceseaza devine 1 trecem la procesarea formularului
$erori = array();

// trebuie sa extragem toate masinile pentru a creea init_data din selectul pentru masina_id
$masina = new Masina();
foreach ($masina->findAllAssoc() as $m){
    $fbld->incarcare_builder['masina_id']['init_data'][$m['id']] = $m['numar_inmatriculare'];
}


/**************** START - ZONA DECLARARE VARIABILE AUXILIARE ***********************************/


/**************** START - ZONA DE LOGICA A FORMULARULUI ****************************/
if (isset($_POST["buton"])) {

    $incarcare->proceseaza();

    if (!count($erori)) {        
        $incarcare->mapFieldsFormToObj();   
        $proceseaza = 1;
    }

    if ($proceseaza) {        
        $incarcare->add();     
        
        $link->close();
        header('location: index.php'); // la sfarsit redirectam spre lista de clienti
        exit;
    } // end if ($proceseaza)

    /**************** END - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/
    
    
    
} /// end if  (isset($_POST["buton"]))
/**************** END - ZONA DE LOGICA A FORMULARULUI - HARD CODE ****************************/


/**************** START - ZONA DE CREARE VARIABILA $content pentru AFISARI ****************************************************/

 // daca sunt erori, le afisam
 if (isset($erori)) {
     $content[] = $html->write_tag('div', 'style="width:300px; background-color:red;padding:10px"', implode('<br />', $erori)) ;
 }

// inceput formular
$content[] = $form->start_form('post', '', 'style="width:300px;background-color:#e5e4d7"');

$content[] = $html->write_tag('h3', 'style="background-color: #999999;padding:5px"', 'Introduceti datele incarcarii' );

foreach ($fbld->incarcare_builder as $val) {
    
    if ('text' == $val['type']) {
        $content[] = $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
        $content[] = $form->form_input($val['name'], null, $val['init_data']);
        $content[] = '<br />';           
        
    } elseif ('choice' == $val['type']) {

        $content[] = $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
        $content[] = $form->form_choice($val['name'], $val['multiple'], $val['expanded'], $val['init_data'], $val['data']);
        $content[] = '<br />';  

    }
 
}



// butonul de trimitere a formularului
$content[] = $form->form_button('buton','Trimite');

$content[] = $form->end_form();

 /**************** START - ZONA DE AFISARI ****************************************************/
include_once '../tpl/index.tpl.php'; 

