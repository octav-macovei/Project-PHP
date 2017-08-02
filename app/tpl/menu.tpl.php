<?php
// pentru siguranta nu permitem accesul direct la fisierele tpl
// ci acesta se va face numai prin includeri
if (!defined('CONTROL_ACCES')) {
	header('HTTP/1.0 403 Forbidden'); 
	header('Status: 403 Forbidden'); 
	die('Interzis accesul'); 
	
}
?>
<!-- begin links section -->
<div id="meniu">
    <ul>
	<li><a href="index.php">Acasa</a></li>
        <li><a href="lista_masini.php">Lista masini</a></li>
        <li><a href="adauga_masina_ps.php">Adauga masina - prepared statements</a></li>
        <li><a href="adauga_incarcare.php">Adauga incarcare</a></li>
        <li><a href="adauga_user.php">Adauga utilizator</a></li>
        <li><?php echo $log ?></li>		

    </ul>
</div>

<?php 
// adaugam sub meniu o zona in care afisam mesaje de tip flash message
// daca avem mesaje le afisam
if (isset($_SESSION) && array_key_exists('flashMessage', $_SESSION)) {   
    
    echo '<div style="background-color:red;color:white;padding:5px 10px">';    
    echo implode(',', $_SESSION['flashMessage']);    
    echo '</div>';
    unset($_SESSION['flashMessage']);        
}


?>
