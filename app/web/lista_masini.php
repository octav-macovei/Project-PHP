<?php
include_once '../config/start.php'; 

use classes\Masina;

/**************** START - ZONA VERIFICARE ACCES ************************************/
// verificam daca are acces pe aceasta pagina
if (!$u->check_access(basename($_SERVER['PHP_SELF']))){
	header ('Location:no_privilege.php');
	exit; //oprim executia scriptului
}
/**************** END  - VERIFICARE ACCES **************************************/


$masina = new Masina();

$my_links =  array(     
                array('path' => 'livrari_masina.php', 'key' => 'masina_id', 'content' => 'Livrai masina'),
                array('path' => 'modifica_masina.php', 'key' => 'masina_id', 'content' => 'Modifica masina'),
);

$masini = $masina->findAllWithLinks($my_links);

// golim variabila $result
$link->close();// inchidem conexiunea la db

?>

<?php include_once('../tpl/header.tpl.php') ?>

<?php include_once('../tpl/menu.tpl.php') ?>

<!-- begin middle section -->
<div id="content">
                    
<?php if (isset($masini)) echo $html->write_table($masini) ?>

</div>
<!-- end of middle section  -->		

<?php include_once('../tpl/footer.tpl.php') ?>   