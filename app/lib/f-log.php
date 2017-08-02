<?php

function myHandleError($file, $line, $message)
{
    $time = new DateTime('now', new DateTimeZone('Europe/Bucharest'));  
    
    // mesajul complet al erorii
    $err =  $time->format('Y-m-d H:i:s')."\t".'Message: '.$message."\t".'File: '.$file."\t".'Line: '.$line."\t\n";
    
    if (ENV == 'dev') {
        die($err);       
    } else {
        error_log($err, 3, MY_ERROR_FILE);        
        die('Eroare.'); 
    }     
   

}
