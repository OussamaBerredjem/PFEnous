<?php
require '../vendor/autoload.php';

use Smalot\PdfParser\Parser;
use Dompdf\Dompdf;
use Dompdf\Options;




function convertPdfToHtml($type,$nom,$prenom,$date,$direction) {

    $sourceFile ="";
    $outputFile = '../output/output.html'; // Path to the output HTML file
    $outputPdf = '../output/output.pdf'; // Path to the output PDF file

    switch($type){
        case "bronze":
            $sourceFile = "../medailles/bronze.pdf";
            break;
        case "argent":
            $sourceFile = "../medailles/argent.pdf";
            break;
        case "or":
            $sourceFile = "../medailles/or.pdf";
            break;
        case "vermeil":
            $sourceFile = "../medailles/vermeil.pdf";
            break;
        case "platine":
            $sourceFile = "../medailles/platine.pdf";
            break;
        case "couronne":
            $sourceFile = "../medailles/courone.pdf";
            break;
    }

    // Initialize the PDF parser
    $parser = new Parser();

    // Parse the PDF file
    $pdf = $parser->parseFile($sourceFile);

    $data = file_get_contents("../image/lg.png");
    $base64 = 'data:image/png;base64,' . base64_encode($data);

    // Check if the image file exists
    

    // Get the text from the PDF
    $text = $pdf->getText();
    $text = str_replace("dnom", $nom, $text);
    $text = str_replace("dprenom", $prenom, $text);
    $text = str_replace("ddate", $date, $text);
    $text = str_replace("IAP", $direction, $text);
    $text = str_replace("ddirection", $direction, $text);

    // Convert the text to basic HTML (this is a simple conversion)
    $htmlContent = "
        <html>
        <body>
            <img src=\"$base64\" style='width:3cm;height:3cm'><br>
           
                <b style='font-weight: 900;'><pre>" . htmlspecialchars($text) . "</pre></b>
          
        </body>
        </html>";

    // Save the HTML content to the output file
    file_put_contents($outputFile, $htmlContent);
    echo "PDF converted to HTML successfully!";

    convertHtmlToPdf($htmlContent,  '../output/output.pdf');
}

function convertHtmlToPdf($htmlContent, $outputPdf) {
    // Initialize Dompdf with options
    $options = new Options();
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Load HTML content
    $dompdf->loadHtml($htmlContent);

    // (Optional) Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to file
    file_put_contents($outputPdf, $dompdf->output());
    echo "HTML converted back to PDF successfully!";
}



?>
