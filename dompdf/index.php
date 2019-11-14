<?php
/* include autoloader */
require_once 'autoload.inc.php';


/* reference the Dompdf namespace */
use Dompdf\Dompdf;


/* instantiate and use the dompdf class */
$dompdf = new Dompdf();


$html = file_get_contents("pdf.php");


$dompdf->loadHtml($html);


/* Render the HTML as PDF */
$dompdf->render();


/* Output the generated PDF to Browser */
$dompdf->stream();
?>