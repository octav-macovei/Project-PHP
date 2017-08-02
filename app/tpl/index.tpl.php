<?php
// pentru siguranta nu permitem accesul direct la fisierele tpl
// ci acesta se va face numai prin includeri
if (!defined('CONTROL_ACCES')) {
	header('HTTP/1.0 403 Forbidden'); 
	header('Status: 403 Forbidden'); 
	die('Interzis accesul'); 
}

	
include_once('../tpl/header.tpl.php');
include_once('../tpl/menu.tpl.php');
?>


<!-- begin middle section -->
<div id="content">
                    
<?php if (isset($content)) echo implode("\n", $content); ?>

</div>
<!-- end of middle section  -->		
	

<?php include_once('../tpl/footer.tpl.php') ?>