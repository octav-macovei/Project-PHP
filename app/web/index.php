<?php 

include_once '../config/start.php'; 

// verificam daca are acces pe aceasta pagina
if (!$u->check_access(basename($_SERVER['PHP_SELF']))){
	header ('Location:no_privilege.php');
	exit; //oprim executia scriptului
}

include_once('../tpl/index.tpl.php'); 




