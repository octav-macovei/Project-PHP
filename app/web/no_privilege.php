<?php 
include_once '../config/start.php'; 


include_once('../tpl/header.tpl.php'); 

include_once('../tpl/menu.tpl.php') ;
?>

<!-- begin middle section -->
<div id="content">
                  
<?php 

echo $html->write_tag('h3', '', 'Nu ai suficiente privilegii!'); 

?>

</div>
<!-- end of middle section  -->		

<?php include_once('../tpl/footer.tpl.php') ?>    