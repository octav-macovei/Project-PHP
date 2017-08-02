<?php

use classes\Html;
use classes\MyException;
use classes\Formular;
use classes\FormBuilders;
use classes\Validator;
use classes\User;

// conexiune la baza de date
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','mydb');

$siteGlobals = array(); 
/* 
    un array cu anumite optiuni de configurare necesare aplicatiei. 
    In functiile in care avem nevoie, il importam cu: global $siteGlobals;
 */

$siteGlobals["login_time"] = 60 * 60 ; // 3600 secunde

  // calea in care se salveaza sesiunile offline
$siteGlobals["session_path"] = __DIR__.'/../../sessions/';  

// pentru controlul acesului in fisierele tpl
define('CONTROL_ACCES', true); 

// mediul in care rulam aplicatia
// daca ENV este dev afisam toate erorile
// daca ENV este prod logam toate erorile
define('ENV', 'dev'); 

// fisierul in care vom tine logurile cu erori
// ele este pe acelasi nivel cu app deci nu va fi vizibil public.
define('MY_ERROR_FILE', __DIR__.'/../../logs/error_file'); 


// includem clasele
/**/
function my_autoloader($class) {
    include '../'.$class . '.php';
}
spl_autoload_register('my_autoloader');
	
// bool spl_autoload_register ([ callable $autoload_function [, bool $throw = true [, bool $prepend = false ]]] )
/**/


// avem nevoie de aceste obiecte in diverse parti ale aplicatiei noastre
// de aceea le creeam aici in start
$html = new Html();
$excp = new MyException();
$form = new Formular();
$fbld = new FormBuilders();
$vld = new Validator();

include_once '../common/conectare.php';
include_once '../lib/f-sessions.php';
//include_once 'lib/form-builders.php';

/*
 * deoarece accesul la paginile noastre se face bazandu-ne pe privilegiile
 * specifice fiecarei pagini si in functie de drepturile userului
 * cream aici userul cu privilegiile sale
 */

if(basename( $_SERVER['PHP_SELF']) != 'login.php') // pe pagina login.php pornim sesiunea cu  my_session_start(1) pentru a regenera id de sesiune(evitare session fixation)
    my_session_start();

// setam privilegiile si variabilele de care avem nevoie in toate paginile noastre
// cream userul anonim
$u = new User(); // aici creez si obiectul privilegii - vezi clasa User

// acum setam privilegiile in functie de user

if ($u->is_logged()) { // daca este logat extragem date despre el inclusiv privilegiile

	$u->prenume = $_SESSION['prenume'];
        $u->nume = $_SESSION['nume'];
	$name = $u->prenume.' '.$u->nume;
        
	// setam privilegiile userului pe care le luam din $_SESSION
	$u->setPrivilegii($_SESSION['privs']); 
        
        // variabila care stabileste daca arata link spre login sau logout
 	$log = $html->write_tag('a','style="padding:5px" href="logout.php"','Logout');	

 } else { // altfel daca este anonim ii setam privilegiul normal

	// daca nu este logat cream un user anonim care va avea voie pe paginile cu 'normal'
	$u->setPrivilegii(array('normal')); 	
        $log = $html->write_tag('a','style="padding:5px" href="login.php"','Login');
        $name = '';
 }



