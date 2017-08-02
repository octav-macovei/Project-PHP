<?php

function my_session_start($regenerate_id=0) 
{
  global $siteGlobals; 
  $login_time = $siteGlobals['login_time'];
  $session_path = $siteGlobals['session_path'];

 
  ini_set('session.use_only_cookies', 1); // folosim doar cookies. id-ul de sesiune nu va aparea in nici un url
  ini_set('session.gc_maxlifetime', $login_time + 600); // ceva mai mare decat expirarea cookie-ului
  ini_set('session.save_path', $session_path); // salvam sesiunile in afara folderului site (cu un nivel mai sus). online, trebuie sa il creati cu apache (sa fie implicit owner 'nobody') sau sa-i dati 777

  session_set_cookie_params($login_time);

  session_start();

  if ($regenerate_id)  // daca se apeleaza my_session_start(1) , regeneram (schimbam) id-ul sesiunii
    session_regenerate_id(); // pentru evitarea session fixation
	

  // in acest fel rescriem cookieul de sesiune setat mai sus
  // iar efectul va fi ca sesiunea va dura $login_time de la ultimul click 
  // pentru ca acest cookie este trimis prin headere
  // iar celalalt tine din momentul in care se apeleaza session_start  
  setcookie(session_name(), session_id(), time() + $login_time, '/'); 
  
  
} // end function

function my_session_destroy()
{

  setcookie(session_name(), FALSE, 1, "/"); // sterge cookie-ul de sesiune (1 reprezinta prima secunda din anul 1970, deci mult in trecut)
  $_SESSION = array(); // se sterg datele din $_SESSION
  session_destroy(); // se sterg datele din fisierul de sesiune

  header('location:index.php');

}
