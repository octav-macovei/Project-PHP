<?php
// pentru siguranta nu permitem accesul direct la fisierele tpl
// ci acesta se va face numai prin includeri
if (!defined('CONTROL_ACCES')) {
	header('HTTP/1.0 403 Forbidden'); 
	header('Status: 403 Forbidden'); 
	die('Interzis accesul'); 	
}
?>

<?php 

$links = '
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="../css/global.css" rel="stylesheet" type="text/css" />
    ';
    
echo $html->html_start('ro', 'Home', $links);   

?>
<!-- begin headern section-->
<div id="header">
    <h1>Curs 1 PHP2</h1>
    <?php if ($name) echo 'Salut '.$name ?>
</div>
<!-- end of header -->	