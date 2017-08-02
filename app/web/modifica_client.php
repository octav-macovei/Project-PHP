<?php

/**************** START - ZONA INCLUDERI FISIERE AUXILIARE ************************************/


/**************** END  - ZONA INCLUDERI FISIERE AUXILIARE **************************************/

/**************** START - ZONA VERIFICARE ACCES ************************************/
// verificam daca are acces pe aceasta pagina
if (!check_access(basename($_SERVER['PHP_SELF']))){
	header ('Location:no_privilege.php');
	exit; //oprim executia scriptului
}
/**************** END  - VERIFICARE ACCES **************************************/


/**************** START - ZONA DECLARARE VARIABILE AUXILIARE ***********************************/



/**************** START - ZONA DECLARARE VARIABILE AUXILIARE ***********************************/



/**************** START - ZONA DE PRELUARE INFORMATII CLIENT DE MODIFICAT ****************************/



/**************** END - ZONA DE PRELUARE INFORMATII CLIENT DE MODIFICAT ****************************/



/**************** START - ZONA DE LOGICA A FORMULARULUI ****************************/

if (isset($_POST["buton"])) {
    
    /**************** START - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
    
  
    
    /**************** END - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
    
    
    /**************** START - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/

 
    
    /**************** END - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/

} /// end if  (isset($_POST["buton"]))

/**************** END - ZONA DE LOGICA A FORMULARULUI ****************************/



/**************** START - ZONA DE AFISARI ****************************************************/
