<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

        $pdf->SetXY(12,95);
        $columnBorder=['TLB','TLB','TLB','TLB','TLB','TLB','TBRL'];
        $columnWidths = [11, 64, 23,20,23,30,15];
        $columnNames = ['SL.NO', 'SUBJECT', 'UNIVERSITY EXAMINATION','VIVA','INTERNAL ASSESSMENT','TOTAL','REMARK'];
        $pdf->SetFont('helvetica', 'I', 8.5);
        $x = 12;
        $y = 95;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 15, $name,$columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 87;
        $y = 105;
        $pdf->SetXY(87,105);
        $columnBorder=['TR','T','T','TL','T','TL','T','TL','LT','T'];
        $columnWidths = [11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['MAX', 'SEC', 'MAX', 'SEC','MAX', 'SEC','MAX', 'MIN','SEC',''];
     
        $pdf->SetFont('helvetica', 'I', 8.5);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name, $columnBorder[$key], 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,110);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['1', 'ORAL MEDICINE AND RADIOLOGY', 'TH','070','049','020','014','010','005','100','050','068','PASS'];
        $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 110;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,  $columnBorder[$key], $DataAlign[$key]);
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 115;
        $pdf->SetXY(80,115);
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '060', '---', '---','010', '008','100', '050','068','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }


        $pdf->SetXY(12,120);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['2', 'PAEDIATRIC & PREVENTIVE DENTISTRY', 'TH','070','049','020','014','010','005','100','050','068','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 120;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name, $columnBorder[$key], $DataAlign[$key]);
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 125;
        $pdf->SetXY(80,125);
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '050', '---', '---','010', '008','100', '050','058','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }
        
        $pdf->SetXY(12,130);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['3', 'ORTHODONTICS & DENTOFACIAL ORTHOPAEDICS', 'TH','070','042','020','017','010','006','100','050','065','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 130;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $DataAlign[$key]);
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 135;
        $pdf->SetXY(80,135);
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '074', '---', '---','010', '008','100', '050','082','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5,$name,'T', 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,140);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['4', 'PERIODONTOLOGY', 'TH','070','047','020','015','010','006','100','050','068','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 140;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $DataAlign[$key]);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 145;
        $pdf->SetXY(80,145);
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '069', '---', '---','010', '008','100', '050','077','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }


        $pdf->SetXY(12,150);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['5', 'PROSTHODONTICS AND CROWN AND BRIDGE', 'TH','070','041','020','016','010','008','100','050','065','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 150;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name, $columnBorder[$key], $DataAlign[$key]);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 155;
        $pdf->SetXY(80,155);
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '067', '---', '---','010', '007','100', '050','074','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,160);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['6', 'CONSERVATIVE DENTISTRY AND ENDODONTICS', 'TH','070','050','020','016','010','008','100','050','073','PASS'];
        $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 160;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,  $columnBorder[$key], $DataAlign[$key]);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 165;
        $pdf->SetXY(80,165);
        
        // $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '073', '---', '---','010', '007','100', '050','080','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,170);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['7', 'ORAL AND MAXILLOFACIAL SURGERY', 'TH','070','051','020','017','010','005','100','050','073','PASS'];
        $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 170;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,  $columnBorder[$key], $DataAlign[$key]);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 175;
        $pdf->SetXY(80,175);
        $columnBorder=['T','T','T','T','T','T','T','T','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '066', '---', '---','010', '006','100', '050','072','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,$columnBorder[$key], 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,180);
        $columnBorder=['LRB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB','RB'];
        $columnWidths = [11, 57,7, 11,12,10,10,11,12,10,10,10,15];
        $columnNames = ['8', 'PUBLIC HEALTH DENTISTRY', 'TH','070','041','020','015','010','006','100','050','062','PASS'];
        $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 180;

        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,  $columnBorder[$key], $DataAlign[$key]);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $x = 80;
        $y = 185;
        $pdf->SetXY(80,185);
        $columnBorder=['TR','T','TL','TL','TL','TL','T','TL','T','T','T'];
        $columnWidths = [7,11, 12, 10,10,11,12,10,10,10,15];
        $columnNames = ['PR','090', '060', '---', '---','010', '007','100', '050','067','PASS'];
        $pdf->SetFont('helvetica', 'I', 10);
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 5, $name,'T', 'C');
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        // $x = 80;
        // $y = 250;
        $pdf->SetFont('helvetica', 'IB', 10);
        $pdf->SetXY(12,190);
        $pdf->Cell(141, 5,'Grand Total:', 'LRB', 0,'R');
        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->Cell(10, 5,'1600', 'RB', 0,'C');
        $pdf->Cell(10, 5,'---', 'LRB', 0,'C');
        $pdf->Cell(10, 5,'1114', 'LRB', 0,'C');
        $pdf->Cell(15, 5,'', 'RB', 0,'C');
        
        $pdf->SetFont('helvetica', 'IB', 10);
        $pdf->SetXY(12,195);
        $pdf->Cell(141, 5,'GRAND TOTAL IN WORDS:', 'L', 0,'R');
        $pdf->Cell(45, 5,'ONE ONE ONE FOUR', 'LR', 0,'L');
        $pdf->SetXY(12,200);
        $pdf->Cell(141, 5,'PERCENTAGE:', 'L', 0,'R');
        $pdf->Cell(45, 5,'69.63', 'LR', 0,'L');

        $pdf->SetXY(12,205);
        $pdf->Cell(141, 5,'RESULT:', 'LB', 0,'R');
        $pdf->Cell(45, 5,'FIRST', 'LRB', 0,'L');



        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(12,211);
        $pdf->Cell(0, 5,'Minimum Marks to Pass: 50% aggregate in each theory (UE + IA + Viva) and 50% aggregate in each Practical (UE +IA).', 0, 0,'C');

        $pdf->SetXY(12,217);
        $columnBorder=['TLB','TLB','TLB','TLB','TLBR'];
        $columnWidths = [40, 36,36, 40,34,];
        $columnNames = ['% Marks (First Attempt)', '75% & More', "65% & More but \nLess than 75%",
        "50% & More but \nLess than 65%","Pass in More than \none attempt"];
        // $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 217;
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name, $columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }

        $pdf->SetXY(12,230);
        $columnNames = ['Class', 'Distinction', 'First Class','Second Class','Pass only'];
        $columnBorder=['LB','LB','LB','LB','LBR'];
        // $DataAlign=['C','L','C','C','C','C','C','C','C','C','C','C','C'];
        $pdf->SetFont('helvetica', 'I', 10);
        $x = 12;
        $y = 230;
        foreach ($columnNames as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key], 0, 'C', 0, '', '', true, 0, false, true, 10, 'M');
            // $pdf->MultiCell($columnWidths[$key], 10, $name, $columnBorder[$key], 'C');
            // $x += $columnWidths[$key]; // Increment x for the next MultiCell
            // $pdf->SetXY($x, $y); // Set the new coordinates  
        }
      

        $pdf->SetXY(12,270);
        $pdf->Cell(10, 2,'Date:', 0, 0,'L');
        $pdf->Cell(0, 5,'18/10/2023', 0, 0,'L');



        $pdf->SetXY(155,270);
        // $pdf->Cell(40, 5,'', 'T', 1,'L');
        $pdf->Cell(40, 5,'Controller of Examinations', 'T', 1,'C');


        $imagePath3 = public_path('images/signature2.png');
  
        $pdf->Image($imagePath3, 157, 248, 23, 20);



        $pdf->SetFont('helvetica', 'I', 7);
        $pdf->SetXY(52,283);
        $pdf->Cell(10, 2,' SDM College of Dental Sciences and Hospital, Sattur, Dharwad–580009, Karnataka, India', 0, 0,'L');

       
       

        
        $pdf->Output('SDM_University_mark_sheet.pdf');

    }
}
