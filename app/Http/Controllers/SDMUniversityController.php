<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use PDF;
use TCPDF;

class SDMUniversityController extends Controller
{
    public function index(){

      
        $pdf = new TCPDF('P', 'mm', array('210', '297'), false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false, 0);
   
        $pdf->AddPage();
        //    ---BG IMAGE---
        $imagePath1 = public_path('images/SDM_University_BG.jpg');
        $pdf->Image($imagePath1, 0, 0, '210', '297', "JPG", '', 'R', true);
        $pdf->setPageMark();

        $pdf->SetY(46);
        $pdf->SetFont('helvetica', 'BI', 15);
        $pdf->Cell(0, 10, 'STATEMENT OF MARKS', 0, 1, 'C');

        $pdf->SetXY(161,45);
        $pdf->SetFont('helvetica', 'BI', 9);
        $pdf->Cell(0, 5, 'MC No:', 0, 1, 'L');

        $pdf->SetXY(172,45);
        $pdf->SetFont('helvetica', 'I', 9);
        $pdf->Cell(0, 5, '310-2019-4M/001', 0, 1, 'L');

        $imagePath2 = public_path('images/down.jfif');
        $pdf->Image($imagePath2, 15, 52, 20,24);

        $pdf->SetY(53);
        $pdf->SetFont('helvetica', 'I', 15);
        $pdf->Cell(0, 10, 'BDS', 0, 1, 'C');
        $pdf->SetY(60);
        $pdf->SetFont('helvetica', 'I', 12);
        $pdf->Cell(0, 10, 'FOURTH YEAR', 0, 1, 'C');

        $pdf->SetY(67);
        $pdf->SetFont('helvetica', 'BI', 12);
        $pdf->Cell(0, 10, 'OCTOBER 2023-EXAMINATION', 0, 1, 'C');

        $style = array
        (
            'border' => 0,
            'vpadding' => '0',
            'hpadding' => '0',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

         //  -----QR CODE-----
        $pdf->write2DBarcode('devharsh pvt ltd', 'QRCODE,L', 176, 52, 21, 20, $style, 'N');

        $pdf->SetFont('helvetica', 'I', 12);
        $pdf->SetXY(16,83);
        $pdf->Cell(0, 5, 'Name of the Student:', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 12);
        $pdf->SetXY(57,83);
        $pdf->Cell(0, 5, 'ABHIJNA P V', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'I', 12);
        $pdf->SetXY(16,89);
        $pdf->Cell(0, 5, 'University Reg. No.:' , 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 12);
        $pdf->SetXY(56,89);
        $pdf->Cell(0, 5, '19DUG001', 0, 1, 'L');

        $pdf->SetXY(13,95);
        $columnWidths = [12, 64, 23,20,23,28,15];
        $columnNames = ['SL. NO', 'SUBJECT', 'UNIVERSITY EXAMINATION','VIVA','INTERNAL ASSESSMENT','TOTAL','REMARK'];
        $pdf->SetFont('helvetica', 'I', 8.5);
        $x = 13;
        $y = 95;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 20, $name,1, 'C');
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }


        
        $pdf->Output('SDM_University_mark_sheet.pdf');

    }
}
