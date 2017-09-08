<base href="http://<?php echo $_SERVER['HTTP_HOST'];?>/elprowinmvc.com/">
<?php
    require_once("../../../public/js/dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    $dompdf->load_html_file('http://localhost:8080/elprowinmvc.com/epsettings/guru/viewguru/pdfmateri.php?nm='.$_GET['nm'].'');
    $dompdf->output(['isRemoteEnabled' => true]);
    $dompdf->render();

    $dompdf->stream('materi.pdf', array("Attachment" => 0));

    unset($dompdf);
?>