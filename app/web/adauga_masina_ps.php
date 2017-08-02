<?php

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
$masina = new Masina();
$proceseaza = 0; // cand $proceseaza devine 1 trecem la procesarea formularului
$erori = array();

/**************** START - ZONA DECLARARE VARIABILE AUXILIARE ***********************************/


/**************** START - ZONA DE LOGICA A FORMULARULUI ****************************/
if (isset($_POST["buton"])) {

    $masina->proceseaza();

    if (!count($erori)) {        
        $masina->mapFieldsFormToObj();   
        $proceseaza = 1;
    }

    if ($proceseaza) {        
        $masina->add();     
        
        $link->close();
        header('location: lista_masini.php'); // la sfarsit redirectam spre lista de clienti
        exit;
    } // end if ($proceseaza)

    /**************** END - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/
    
    
    
} /// end if  (isset($_POST["buton"]))
/**************** END - ZONA DE LOGICA A FORMULARULUI - HARD CODE ****************************/


/**************** START - ZONA DE AFISARI ****************************************************/

include_once('../tpl/header.tpl.php'); 

include_once('../tpl/menu.tpl.php') ;
?>

<!-- begin middle section -->
<div id="content">                    

<?php
// daca sunt erori, le afisam
if (isset($erori))
{

	foreach ($erori as $eroare)
	{
		echo $eroare;
		echo '<br />';
	} /// end foreach

} //// end if(isset($erori))

// inceput formular
echo $form->start_form('post', '', 'style="width:300px;background-color:#e5e4d7"');

// campuri formular

foreach ($fbld->masina_builder as $val) {
    echo $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
    echo $form->form_input($val['name'], null, $val['init_data']);
    echo '<br />';    
}


// butonul de trimitere a formularului
echo $form->form_button('buton','Trimite');

echo $form->end_form();
?>

</div>

<!-- end of middle section  -->	
<?php include_once('../tpl/footer.tpl.php') ?>    

