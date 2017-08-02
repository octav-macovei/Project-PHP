<?php

// suprimam eroarea aruncata in linia de mai jos
$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 if (!$link) {    
    myHandleError(__FILE__, __LINE__, 'Connect Error ('.$link->connect_errno.') '.$link->connect_error);  
}