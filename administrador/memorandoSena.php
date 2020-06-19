<?php
require '../Assets/vendor/autoload.php' ;

use  spipu\html2pdf\Html2Pdf;

	ob_start();
	require_once 'paraMemorando.php';
	$html = ob_get_clean();

    $html2pdf = new HTML2PDF('p', 'A4', 'en');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($html, false);
    $html2pdf->Output('memorando.pdf', 'D');

?>
