<?php
require '../vendor/autoload.php' ;

use  Spipu\Html2Pdf\Html2Pdf;


	ob_start();
	require_once 'pdfTurnoE.php';
	$html = ob_get_clean();


    $html2pdf = new HTML2PDF('l', 'A4', 'es');
    $html2pdf->setDefaultFont('Arial' );
    $html2pdf->writeHTML($html, false);
    $html2pdf->Output('busquedaTurnos.pdf','D' );

?>