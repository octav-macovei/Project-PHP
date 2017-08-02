<?php
include_once '../config/start.php'; 

$content = array();
$erori = array();
$proceseaza = false;
$username = '';
$pw = '';

if (isset($_POST["buton"])) {
	  
	  $username = $_POST["username"];
	  $pw = $_POST["pw"];
          
    /**************** START - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
          
    // preluare username
        if (false !== ($username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING))){       

            if ('' === $username){
                // verificam daca a introdus ceva
               $erori['username'] = 'Campul username este obligatoriu!';
            } else if (!$vld->validate($vld->reg_username,$username)){
                // resetam 
                $username = '';    
                $erori['username'] = 'Campul username nu este valid!';
            }            
        }
        
    // preluare parola
    /*
     * OBSERVATIE:
     * deoarece regexul pentru parola permite numai caracterele -_a-z0-9,.
     * daca variabile $pw 'trece' de acest regex ea este html-safe
     * 
     */
        
        if (false !== ($pw = filter_input(INPUT_POST, 'pw', FILTER_SANITIZE_STRING))){       

            if ('' === $pw){
                // verificam daca a introdus ceva
               $erori['pw'] = 'Campul parola este obligatoriu!';
            } else if (!$vld->validate($vld->reg_pw,$pw)){
                // resetam 
                $pw = '';    
                $erori['pw'] = 'Campul parola nu este valid!';
            }            
        }        

    
    /**************** END - ZONA PRELUARE/VALIDARE DATE INTRODUSE IN FORMULAR *******************************/
        
    // daca nu sunt erori, variabila $proceseaza devine 1
    if (!count($erori)) {
        $proceseaza = 1;
    }
	
    // daca variabila proceseaza este 1, procesam (in cazul nostru adaugam clientul)
    if ($proceseaza) {       

        // initializeaza un 'prepared statement'
        $stmt = $link->stmt_init(); 		

        // extragem userul din db care ar trebuie sa fie unic
        $sql = 'SELECT uid, pw, nume, prenume, privilegii FROM users WHERE username = ?';
        
        // preparam query-ul
        if(!$stmt->prepare($sql)) {
            myHandleError(__FILE__, __LINE__, $stmt->error());            
        }
        
        // aici se face legatura intre ? din $sql si variabilele noastre
        $stmt->bind_param('s', $username);
		
        if(!$stmt->execute()) {
            myHandleError(__FILE__, __LINE__, $stmt->error());
        }    
        
        // aici facem legaturile intre campurile cerute din db si variabile in php
        // ordinea se respecta, iar ea este data de cea din query-ul $sql = 'SELECT uid, pw, nume, prenume, privilegii FROM users WHERE username = ?';
        // adica username se pune in $db_username
        $stmt->bind_result($uid, $db_pw, $nume, $prenume, $privilegii);   
        
        // aici extragem efectiv datele si le punem in variabilele $uid, $db_pw, $privilegii
        $stmt->fetch();
        
        // verificam parola, $pw este parola introdusa in formular, iar $db_pw este hash-lu acestei parole in db
        // functia password_verify se ocupa de aceasta erificare
        if (password_verify($pw,$db_pw)){
        
            // in primul rand ii regeneram id-ul de sesiune pentru evitarea session fixation
            my_session_start(1) ;

            // in $_SESSION nu avem neaparata nevoie decat de uid
            // restul datelor userului le putem lua si din db

            $_SESSION['uid'] = $uid; 
            $_SESSION['nume'] = $nume; 
            $_SESSION['prenume'] = $prenume; 
            $_SESSION['privs'] = explode(',',$privilegii);
            
            //inchidem prepared statement
            $stmt->close();
            $link->close();// inchidem conexiunea la db 
            
            header('location:index.php');              
            exit;        
        } 
        
        // daca se ajunge aici autentificare nu s-a reusit
        $erori[] = 'Username sau parola invalida';
            
    } // end if ($proceseaza)    

 } /// end if (isset($_POST["buton"])) 
 
if ($erori)
{
	$content[] = implode('<br />', $erori);

} //// end if($erori)


// star formular
$content[] = $form->start_form('post', '', 'style="width:50%;background-color:#e5e4d7"');


$row_user = $form->addLabel('username', $username, 'style="width:100px; background-color: #999999;display:inline-block"');
$row_user .= $form->form_input('username','text', $username);
// punem acest rand intr-un div si adaugam in content
$content[] = $html->write_tag('div', 'class="row_form" id ="row_user"', $row_user);

$row_pass = $form->addLabel('pw', $pw, 'style="width:100px; background-color: #999999;display:inline-block"');
$row_pass .= $form->form_pass('pw', $pw);
// punem acest rand intr-un div si adaugam in content
$content[] = $html->write_tag('div', 'class="row_form" id ="row_pass"', $row_pass);


// butonul de trimitere a formularului
$content[] = $html->write_tag('div', 'class="row_form" id ="buton_trimite"', $form->form_button('buton','Trimite'));

$content[] = $form->end_form();


include_once '../tpl/index.tpl.php'; 









