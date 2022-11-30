<?php

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

ob_start();
require 'invoice.php';



$dompdf = new Dompdf();
// $dompdf->loadHtml('$html');
$dompdf->loadHtml(ob_get_clean());
    
                  
 
$dompdf->setPaper('A4','portrait ');



$dompdf->render();

ob_clean();
$dompdf->stream('invoice.pdf',array('Attachment'=> 0));

?>
    





   

  
