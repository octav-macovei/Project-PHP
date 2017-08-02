<?php
include_once '../config/start.php'; 

/**************** START - ZONA VERIFICARE ACCES ************************************/
// verificam daca are acces pe aceasta pagina
if (!$u->check_access(basename($_SERVER['PHP_SELF']))){
	header ('Location:no_privilege.php');
	exit; //oprim executia scriptului
}
/**************** END  - VERIFICARE ACCES **************************************/

//preluam id-ul masinii din GET

if (is_numeric($_GET['masina_id'])) { 
    $masina_id = $_GET['masina_id']; 
} else {
    $masina_id = 0;
}

$sql = "SELECT
	l.aviz_livrare, l.data_livrarii, l.cantitate, i.aviz_incarcare, m.numar_inmatriculare
	FROM
	livrari l
	INNER JOIN incarcari i  ON l.incarcare_id=i.id
	INNER JOIN masini m ON i.masina_id =m.id
	WHERE m.id='$masina_id'";
//echo $sql;exit;
    
$result = $link->query($sql) or $excp->myHandleError(__FILE__, __LINE__, $link->mysqli_error);

if($result->num_rows)  {

    while($d = $result->fetch_assoc()) {

        $arr_fin[]=$d;

    } //end while

} else {
    
    $msg[] = 'nu exista livrari aceasta masina';
    
}

$result->free_result(); // golim variabila $result

$link->close();// inchidem conexiunea la db 
 
?>

<?php include_once('../tpl/header.tpl.php') ?>

<?php include_once('../tpl/menu.tpl.php') ?>

<!-- begin middle section -->
<div id="content">
                    
<?php if (isset($arr_fin)) echo $html->write_table($arr_fin, true) ?>
    
<?php if (isset($msg)) echo $html->write_tag('div', null, implode('<br>', $msg)) ?>

</div>
<!-- end of middle section  -->		

<?php include_once('../tpl/footer.tpl.php') ?>   

