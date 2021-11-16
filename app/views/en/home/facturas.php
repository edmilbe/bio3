<?php
/*

//The full or relative path to your PDF file.
//$pdfFile = PROOT.'files/facturas/'.$this->facturas;
$file_url = ROOT.'/files/facturas/'.$this->facturas;



//The full or relative path to your PDF file.
$pdfFile = $file_url;

//Set the Content-Type to application/pdf
header('Content-Type: application/pdf');

//Set the Content-Length header.
header('Content-Length: ' . filesize($pdfFile));

//Set the Content-Transfer-Encoding to "Binary"
header('Content-Transfer-Encoding: Binary');

//The filename that it should download as.
$downloadName = 'malanza_receipt';

//Set the Content-Disposition to attachment and specify
//the name of the file.
header('Content-Disposition: attachment; filename=' . $downloadName);

//Read the PDF file data and exit the script.
readfile($pdfFile);
*/


$file = PROOT.'files/'.$this->pasta.'/'.$this->facturas;

//

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}else{
    dnd($file);
    dnd('not file');
}


?>
