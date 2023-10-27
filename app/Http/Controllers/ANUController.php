<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;

use Illuminate\Http\Request;

class ANUController extends Controller
{
    public function index(){
        $pdf = new TCPDF('P', 'mm', array('210', '297'), false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false, 0);

        $path = storage_path('app/public/excel/anu_645.xlsx');
        $data = Excel::toArray([], $path);
        $sheetData = $data[0];
        // echo '<pre>';
        // print_r($sheetData);
        // dd($sheetData);
        foreach ( $sheetData as $index => $Studentdata) {
                if ($index == 0) {
                    continue;
                }
                $pdf->AddPage();
                $imagePath1 = public_path('images/bg.jpeg');
                // Use Image() to add the background image
                $pdf->Image($imagePath1, 0, 0, '210', '297', "JPG", '', 'R', true);
                $pdf->setPageMark();
                $pdf->SetY(33);
                $pdf->SetFont('helvetica', 'I', 20);
                $pdf->Cell(0, 10, 'Semister Acadmic Report', 0, 1, 'C');

                $pdf->SetY(43);
                $pdf->SetFont('helvetica', 'BI', 14);
                $pdf->Cell(0, 10, $Studentdata[126], 0, 1, 'C');
                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->SetXY(15,55);
                $pdf->Cell(30, 5, 'Student Name:', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(45,55); 
                $pdf->Cell(45, 5, $Studentdata[7], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->Cell(35, 5, 'Student ID No:', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(45,60); 
                $pdf->Cell(45, 5, $Studentdata[1], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->SetXY(85,60);
                $pdf->Cell(30, 5, 'Date of Birth : ', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(115,60); 
                $pdf->Cell(45, 5, $Studentdata[5], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->Cell(35, 5, 'Batch:', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(45,65); 
                $pdf->Cell(45, 5, $Studentdata[8], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->SetXY(85,65);
                $pdf->Cell(30, 5, 'Programme : ', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(115,65); 
                $pdf->Cell(45, 5, $Studentdata[10], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->Cell(35, 5, 'Semester:', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(45,70); 
                $pdf->Cell(45, 5, $Studentdata[9], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->SetXY(85,70);
                $pdf->Cell(30, 5, 'Major:  ', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(115,70); 
                $pdf->Cell(45, 5, $Studentdata[11], 0, 1, 'L');

                $pdf->SetFont('helvetica', 'BI', 10);
                $pdf->Cell(35, 5, 'Report Issue Date:', 0, 1, 'R');

                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(45,75); 
                $pdf->Cell(45, 5, $Studentdata[130], 0, 1, 'L');

                $pdf->Image($Studentdata[137], 170, 45, 27,36);

                $columnWidths = [22, 96, 17,17,17,17];
                $alignData=['R','L','C','C','C','C'];
                // Set initial x and y coordinates
                $x = 12; $y = 83;
                $pdf->SetFont('helvetica', 'BI', 10);
                $columnBorder=['TLB','TLB','TLB','TLB','TLB','TLRB'];
                $columnNames = ['Course Code', 'Course', 'Credit Enrolled','Credit Earned','Grade','Grade Point'];
                $pdf->SetXY(12,83);    
                foreach ($columnNames as $key=> $name) {
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates  
                }

                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->SetXY(12,93);  
                $columnNames1 = [$Studentdata[30], $Studentdata[31], $Studentdata[32],$Studentdata[33],$Studentdata[34],$Studentdata[35]];
                $columnBorder=['L','L','L','L','L','LR'];
        
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key], 0, $alignData[$key]);
                }

                $pdf->SetXY(12,103);  
                $columnNames1 = [$Studentdata[36], $Studentdata[37], $Studentdata[38],$Studentdata[39],$Studentdata[40],$Studentdata[41]];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                }
                $pdf->Ln();
                $pdf->SetXY(12,113);  
                $columnNames1 = [$Studentdata[42], $Studentdata[43], $Studentdata[44],$Studentdata[45],$Studentdata[46],$Studentdata[47]];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                }

                $pdf->Ln();
                $pdf->SetXY(12,123);  
                $columnNames1 = [$Studentdata[48], $Studentdata[49], $Studentdata[50],$Studentdata[51],$Studentdata[52],$Studentdata[53]];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                } 

                $pdf->Ln();
                $pdf->SetXY(12,133);  
                $columnNames1 = [$Studentdata[54], $Studentdata[55], $Studentdata[56],$Studentdata[57],$Studentdata[58],$Studentdata[59]];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                }

                $pdf->Ln();
                $pdf->SetXY(12,143);  
                $columnNames1 = [$Studentdata[60], $Studentdata[61], $Studentdata[62],$Studentdata[63],$Studentdata[64],$Studentdata[65]];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                }

                $x=12;$y=153;
                $pdf->SetXY(12,153);  
                $columnNames1 = [$Studentdata[66], $Studentdata[67], $Studentdata[68],$Studentdata[69],$Studentdata[70],$Studentdata[71]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=163;
                $pdf->SetXY(12,163);  
                $columnNames1 =[ $Studentdata[72], $Studentdata[73], $Studentdata[74],$Studentdata[75],$Studentdata[76],$Studentdata[77]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=173;
                $pdf->SetXY(12,173);  
                $columnNames1 =[ $Studentdata[78], $Studentdata[79], $Studentdata[80],$Studentdata[81],$Studentdata[82],$Studentdata[83]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=183;
                $pdf->SetXY(12,183);  
                $columnNames1 =[ $Studentdata[84], $Studentdata[85], $Studentdata[86],$Studentdata[87],$Studentdata[88],$Studentdata[89]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=193;
                $pdf->SetXY(12,193);  
                $columnNames1 =[ $Studentdata[90], $Studentdata[91], $Studentdata[92],$Studentdata[93],$Studentdata[94],$Studentdata[95]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=203;
                $pdf->SetXY(12,203);  
                $columnNames1 =[ $Studentdata[96], $Studentdata[97], $Studentdata[98],$Studentdata[99],$Studentdata[100],$Studentdata[101]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 9, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 9, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $x=12;$y=212;
                $pdf->SetXY(12,212);  
                $columnBorder=['LB','LB','LB','LB','LB','LRB'];
                $columnNames1 =[ $Studentdata[102], $Studentdata[103], $Studentdata[104],$Studentdata[105],$Studentdata[106],$Studentdata[107]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 3, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 3, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }
                
                $pdf->SetFont('helvetica', 'I', 10);
                $pdf->SetXY(12,218);  
                $columnWidths1 = [93,93];
                $columnNames1 = ['Semester Grade Point Average (SGPA)', 'Cumulative Grade Point Average (CGPA)' ];
                foreach ($columnNames1 as $key=> $name) {
                    $pdf->Cell($columnWidths1[$key], 7, $name, 'TLR','0','C');
                
                }

                $columnWidths = [27, 35, 31,31,31,31];
                $x = 12; $y = 225;
                $pdf->SetFont('helvetica', 'I', 9.5);
                $columnNames =    
                ["Earned Credits", "Earned Credit Points", "SGPA","Total \nEarned Credits","Total \nEarned Points","CGPA"];
                $columnFont=['I','I','IB','I','I','IB'];
                $columnBorder=['TL','TL','TL','TL','TL','TLR'];
                $pdf->SetXY(12,225);    
                foreach ($columnNames as $key=> $name) {
                    $pdf->SetFont('helvetica', $columnFont[$key], 10);
                    // $pdf->MultiCell($columnWidths[$key], 12, $name,   $columnBorder[$key], 'C');
                    $pdf->MultiCell($columnWidths[$key], 11, $name, $columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 9, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinates
                }

                $pdf->SetXY(40,232);
                $pdf->SetFont('helvetica', 'I', 8);  
                $pdf->Cell(0, 3,  'Σ(Credit X Grade Points)', 0, 'C');

                $x = 12; $y = 236;
                $pdf->SetFont('helvetica', 'I', 9.5);
                $columnBorder=['TLB','TLB','TLB','TLB','TLB','TLRB'];
                $columnNames = [$Studentdata[29], $Studentdata[27], $Studentdata[23]."\n".$Studentdata[24],$Studentdata[21],$Studentdata[22],$Studentdata[25]."\n".$Studentdata[26]];
                $pdf->SetXY(12,236);    
                foreach ($columnNames as $key=> $name) {
                $pdf->SetFont('helvetica', $columnFont[$key], 10);
                // $pdf->MultiCell($columnWidths[$key], 10, $name ,    $columnBorder[$key], 'C');
                $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
                $x += $columnWidths[$key]; // Increment x for the next MultiCell
                $pdf->SetXY($x, $y);
                }

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
                $pdf->write2DBarcode($Studentdata[128], 'QRCODE,L', 12, 255, 21, 20, $style, 'N');
                $pdf->SetXY(13,275);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->Cell(20, 5, $Studentdata[131], 0, 1, 'C');

                $pdf->SetXY(45,272);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->Cell(20, 3, $Studentdata[133], 0, 1, 'L');
                $pdf->SetXY(45,276);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->Cell(20, 3, $Studentdata[134], 0, 1, 'L');


                $pdf->SetXY(134,273);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->Cell(0, 3, $Studentdata[135], 0, 1, 'L');
                $pdf->SetXY(134,276);
                $pdf->SetFont('Arial', 'I', 8);
                $pdf->Cell(0, 3, $Studentdata[136], 0, 1, 'L');
                  //image path
                $imagePath1 = public_path('images/Signature-No-Background.png');
                $imagePath2 = public_path('images/Signature-PNG-Image-File.png');
                $pdf->SetXY(45,255);
                $pdf->Image($imagePath1, 47, 250, 20, 20);
                
                $pdf->Image($imagePath2, 132, 253, 20, 20);
        }
  
        $pdf->Output($Studentdata[127]);  
    } 
          
}
