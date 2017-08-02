<?php

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

// variabile initiale
$proceseaza = 0;
$erori = array();
$content = array();

if (isset($_POST["buton"])) {
    
    /**************** START - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
    
    foreach ($fbld->user_builder as &$camp){
        
        if ('text' == $camp['type'] || 'password' == $camp['type'] ) {
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
        } else if ('choice' == $camp['type']) {
            $camp['data'] = filter_input(INPUT_POST, $camp['name'], FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY); 
            if(null === $camp['data'] && 1==$camp['required']) {
                $camp['data'] = []; //resetam ce avem in data
                $erori[$camp['name']] = 'Alege cel putin un privilegiu!';
            } else if (array_diff($camp['data'], array_keys($camp['init_data']))) { 
                // daca gasim in $camp['data'] valori ce nu se afla si in array_keys($camp['init_data'])
                // inseamna ca formularul a fost 
                // fortat prin acest camp deci 
                // restam ce avem in $camp['data']
                $camp['data'] = []; 
                // si adaugam o eroare in $erori
                $erori[$camp['name']] = 'Valori gresite pentru privilegii!';
            }           
        }

    }
    
    /**************** END - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
    
   
    /**************** START - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/
    
    // daca nu sunt erori, variabila $proceseaza devine 1
    if (!count($erori)) {
        $proceseaza = 1;
    }

    // daca variabila proceseaza este 1, procesam (in cazul nostru adaugam clientul)
    if ($proceseaza) {
        
        $dat = new \DateTime('now', new \DateTimeZone('Europe/Bucharest'));
        $now = $dat->format('Y-m-d H:i:s');        

        // initializeaza un 'prepared statement'
        $stmt = $link->stmt_init(); 		
        $sql = "INSERT INTO users (username, prenume, nume, pw, email, privilegii, date_add, date_upd) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // preparam query-ul
        if(!$stmt->prepare($sql)) {
            $excp->myHandleError(__FILE__, __LINE__, $stmt->error);            
        }
        
        /********************* OBSERVATIE!!! ******************************
         * 
         *  Urmeaza sa salvam parola in baza de date.
            In baza de date parola se tine hash-uita adica criptata.
            Incepand cu versiunea php 5.5.0 avem la dispozitie functia
         * 
            string password_hash ( string $password , integer $algo [, array $options ] )
         * 
            pentru a cripta parola si functia
         *
            boolean password_verify ( string $password , string $hash )
         * 
            pentru a verifica daca un hash luat din baza de date este o parola.
         * 
         * Referitor la functia password_hash, primul parametru este parola
         * userului, iar al 2-lea parametru este alogortimul folosit in criptare,
         * puteti citi mai mule in urmatorul link despre acesti algoritmi:
         * http://www.php.net/manual/en/password.constants.php
         * 
         * Trebuie sa retineti ca folosind ca al 2 lea parametru al functiei
         * constanta PASSWORD_DEFAULT trebuie sa aveti in baza de date
         * un camp destul de lung, este recomandat 255 de caractere
         * in cazul in care constanta este PASSWORD_BCRYPT atunci acel camp
         * va avea intotdeauna 60 de caractere.
         * 
         * De asemenea verificati ca versiunea de php de pe serverul de gazduire este mai mare decat 5.5.0.
         */        
        
        $pw_hash = password_hash($fbld->user_builder['pw']['init_data'], PASSWORD_BCRYPT); // hashul parolei citit commentul de mai sus        
        $privs = implode(',', $fbld->user_builder['privilegii']['data']);
        
        // aici se face legatura intre ? din $sql si variabilele noastre        
        $stmt->bind_param('ssssssss', 
                $fbld->user_builder['username']['init_data'],  
                $fbld->user_builder['prenume']['init_data'],  
                $fbld->user_builder['nume']['init_data'],  
                $pw_hash,
                $fbld->user_builder['email']['init_data'],                   
                $privs,                
                $now, 
                $now);
		
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
        $link->close();// inchidem conexiunea la db    
        
        // adaugam un flashMessage in $_SESSION
        $_SESSION['flashMessage'][] = 'Utilizatorul a fost adaugat cu succes in db!';
        header('location: index.php'); // la sfarsit redirectam spre lista de clienti
        exit;
    }
    /**************** END - ZONA PROCESARE DATE INTRODUSE IN FORMULAR *******************************/    
 
 } // end if (isset($_POST["buton"])) {

/**************** START - ZONA DE CREARE VARIABILA $content pentru AFISARI ****************************************************/

 // daca sunt erori, le afisam
 if (isset($erori)) {
     $content[] = $html->write_tag('div', 'style="width:300px; background-color:red;padding:10px"', implode('<br />', $erori)) ;
 }

// inceput formular
$content[] = $form->start_form('post', '', 'style="width:300px;background-color:#e5e4d7"');

$content[] = $html->write_tag('h3', 'style="background-color: #999999;padding:5px"', 'Introduceti datele userului' );

// campuri formular
foreach ($fbld->user_builder as $val) {
    
    if ('text' == $val['type']) {
        $content[] = $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
        $content[] = $form->form_input($val['name'], null, $val['init_data']);
        $content[] = '<br />';   
        continue;
    }
    
    if ('password' == $val['type']) {
        $content[] = $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
        $content[] = $form->form_pass($val['name'], null, $val['init_data']);
        $content[] = '<br />';  
        continue;
    }    
    
    if ('choice' == $val['type']) {
        $content[] = $form->addLabel($val['label'], 'style="width:100px; background-color: #999999;display:inline-block"', $val['name']);
        $content[] = $form->form_choice($val['name'], $val['multiple'], $val['expanded'], $val['init_data'], $val['data']);
        $content[] = '<br />';  
        continue;
    }        

}

// butonul de trimitere a formularului
$content[] = $form->form_button('buton','Trimite');

$content[] = $form->end_form();

 /**************** START - ZONA DE AFISARI ****************************************************/
include_once '../tpl/index.tpl.php'; 
