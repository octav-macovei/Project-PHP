<?php
// pentru siguranta nu permitem accesul direct la fisierele tpl
// ci acesta se va face numai prin includeri
if (!defined('CONTROL_ACCES')) {
	header('HTTP/1.0 403 Forbidden'); 
	header('Status: 403 Forbidden'); 
	die('Interzis accesul'); 
	
}
?>
<div id="footer">
continut footer<br /><br /><br />	
</div>		
<!-- end of footer section -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#an_fabricatie" ).datepicker({
        dateFormat: 'yy',
        changeMonth: false,
        changeYear: true    
        });
        
    $( "#data_incarcarii" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true    
        });        

  } );
  </script>
</body>
</html>