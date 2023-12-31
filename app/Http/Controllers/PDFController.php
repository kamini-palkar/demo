<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use PDF;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use App\Models\Student_data;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdf = new TCPDF('P', 'mm', array('210', '297'), false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false, 0);
   
        $pdf->AddPage();

         //    ---BG IMAGE---
         $imagePath1 = public_path('images/bg.jpeg');
         // Use Image() to add the background image
        //  $pdf->Image($imagePath1, 0, 0, 210, 297, '', '', '', true, 300, '', false, false, 0);
        $pdf->Image($imagePath1, 0, 0, '210', '297', "JPG", '', 'R', true);
         $pdf->setPageMark();

        

        // Set an image within a cell
        // $pdf->Image($imagePath1, 79, 11, 55, 20);
        $pdf->SetY(33);
        $pdf->SetFont('helvetica', 'I', 20);
        $pdf->Cell(0, 10, 'Semister Acadmic Report', 0, 1, 'C');
        $pdf->SetDrawColor(0);
        $borderWidth = 0.1;
        $pdf->SetLineWidth($borderWidth);
        $pdf->SetY(43);
        $pdf->SetFont('helvetica', 'BI', 14);
        $pdf->Cell(0, 10, 'Monsoon 2018', 0, 1, 'C');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->SetXY(15,55);
        $pdf->Cell(30, 5, 'Student Name:', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(45,55); 
        $pdf->Cell(45, 5, 'RANKA ADITI ASHOKKUMAR', 0, 1, 'L');
        
        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->Cell(35, 5, 'Student ID No:', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(45,60); 
        $pdf->Cell(45, 5, '989475', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->SetXY(85,60);
        $pdf->Cell(30, 5, 'Date of Birth : ', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(115,60); 
        $pdf->Cell(45, 5, '26 January 1900', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->Cell(35, 5, 'Batch:', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(45,65); 
        $pdf->Cell(45, 5, '2018', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->SetXY(85,65);
        $pdf->Cell(30, 5, 'Programme : ', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(115,65); 
        $pdf->Cell(45, 5, 'Anant Foundation Year', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->Cell(35, 5, 'Semester:', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(45,70); 
        $pdf->Cell(45, 5, 'Semester-I', 0, 1, 'L');

        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->SetXY(85,70);
        $pdf->Cell(30, 5, 'Major:  ', 0, 1, 'R');

        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(115,70); 
        $pdf->Cell(45, 5, 'Undeclared', 0, 1, 'L');
      
        $pdf->SetFont('helvetica', 'BI', 10);
        $pdf->Cell(35, 5, 'Report Issue Date:', 0, 1, 'R');

         $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(45,75); 
        $pdf->Cell(45, 5, '07 January 1900', 0, 1, 'L');

       
         // Set an image within a cell
         $imagePath2 = public_path('images/down.jfif');
        $pdf->Image($imagePath2, 170, 45, 27,36);
       
        // $borderColor2 = [0, 0, 0];  //  color (RGB)
        $columnWidths = [22, 96, 17,17,17,17];
        $alignData=['R','L','C','C','C','C'];
        // Set initial x and y coordinates
          $x = 12;
          $y = 83;
          $pdf->SetFont('helvetica', 'BI', 10);
          $columnBorder=['TLB','TLB','TLB','TLB','TLB','TLRB'];
        $columnNames = ['Course Code', 'Course', 'Credit Enrolled','Credit Earned','Grade','Grade Point'];
        $pdf->SetXY(12,83);    
        // Create the table header with column names
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            // $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
            // $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates  
        }
        $pdf->Ln();
        $pdf->SetFont('helvetica', 'I', 9);
        $pdf->SetXY(12,93);  
        $columnNames1 = ['FNDN101', 'EXPLORING DESIGN DISCIPLINE', '6.0','6.0','C+','2.80'];
        $columnBorder=['L','L','L','L','L','LR'];
    
        foreach ($columnNames1 as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key], 0, $alignData[$key]);
        }

        $pdf->Ln();
        $pdf->SetXY(12,103);  
        $columnNames1 = ['FNDN102', 'WRITTEN & VERBAL COMMUNICATION', '3.0','3.0','B','3.20'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
        }
        $pdf->Ln();
        $pdf->SetXY(12,113);  
        $columnNames1 = ['FNDN103', 'INSPIRATIONS', '1.5','1.5','D','2.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
        }

        $pdf->Ln();
        $pdf->SetXY(12,123);  
        $columnNames1 = ['FNDN131', 'ELEMENTS OF DESIGN', '3.0','3.0','B-','3.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0,$alignData[$key] );
            // $pdf->Cell(0, 10, $name, 1, 1, 'C');
        }

        $pdf->Ln();
        $pdf->SetXY(12,133);  
        $columnNames1 = ['FNDN132', 'VISUALIZATION & REPRESENTATION-I', '2.0','2.0','B-','2.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
        }

        $pdf->Ln();
        $pdf->SetXY(12,143);  
        $columnNames1 = ['FNDN161', 'DESIGN PROCESS MODULE#', '1.5','1.5','P-','--'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
        }

        
        $pdf->Ln();
        // $x = 12;
        // $y = 153;
        $pdf->SetXY(12,153);  
       
        $columnNames1 = ['FNDN162', 'UNLEARNING MODULE', 'NC','NC','P','--'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0,$alignData[$key]);
            // $pdf->Cell($columnWidths[$key], 53, $name, 1, 'T');
            // $pdf->MultiCell($columnWidths[$key], 62, $name, $columnBorder[$key], $alignData[$key]);
            // $x += $columnWidths[$key]; // Increment x for the next MultiCell
            // $pdf->SetXY($x, $y); // Set the new coordinates
        }
        $columnBorder=['LB','LB','LB','LB','LB','LRB'];
        $pdf->SetXY(12,163); 
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 52, '', $columnBorder[$key],0,$alignData[$key]);
         
        }
        
        $pdf->Ln();
        $pdf->SetFont('helvetica', 'I', 10);
        $pdf->SetXY(12,218);  
        $columnWidths1 = [93,93];
        $columnNames1 = ['Semester Grade Point Average (SGPA)', 'Cumulative Grade Point Average (CGPA)' ];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths1[$key], 7, $name, 'TLR','0','C');
           
        }

      

        $columnWidths = [27, 35, 31,31,31,31];
        // Set initial x and y coordinates
          $x = 12;
          $y = 225;
          $pdf->SetFont('helvetica', 'I', 9.5);
        $columnNames =    
        ["Earned Credits", "Earned Credit Points", "SGPA","Total \nEarned Credits","Total \nEarned Points","CGPA"];
        $columnFont=['I','I','IB','I','I','IB'];
        $columnBorder=['L','L','L','L','L','LR'];
        $pdf->SetXY(12,225);    
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->SetFont('helvetica', $columnFont[$key], 10);
            $pdf->Rect($x, $y, $columnWidths[$key], 10);
            $pdf->MultiCell($columnWidths[$key], 12, $name,   $columnBorder[$key], 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates
        }
       
        $pdf->SetXY(42,229);
        $pdf->SetFont('helvetica', 'I', 7);  
        $pdf->Cell(0, 5,  'Σ(Credit X Grade Points)', 0, 'C');


        $x = 12;
        $y = 235;
        $pdf->SetFont('helvetica', 'I', 9.5);
        $columnBorder=['TLB','TLB','TLB','TLB','TLB','TLRB'];
        $columnNames = ["17.0", "44.40", "2.86 \nGood","17.0","44.40","2.86 \nGood"];
        $pdf->SetXY(12,235);    
        foreach ($columnNames as $key=> $name) {
        $pdf->SetFont('helvetica', $columnFont[$key], 10);
        // $pdf->MultiCell($columnWidths[$key], 10, $name ,    $columnBorder[$key], 'C');
        $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], 'C',0, 1, '', '', true, 0, false, true, 10, 'M');
        $x += $columnWidths[$key]; // Increment x for the next MultiCell
        $pdf->SetXY($x, $y);
        }


    //   $pdf->SetXY(13,255);
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
        $pdf->write2DBarcode('devharsh pvt ltd', 'QRCODE,L', 12, 255, 21, 20, $style, 'N');
        $pdf->SetXY(13,275);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(20, 5, 'AFY 00098', 0, 1, 'C');
        
        //image path
        $imagePath1 = public_path('images/Signature-No-Background.png');
        $imagePath2 = public_path('images/Signature-PNG-Image-File.png');
        $pdf->SetXY(45,255);
        $pdf->Image($imagePath1, 47, 250, 20, 20);
        
        $pdf->Image($imagePath2, 132, 253, 20, 20);
         

        $pdf->SetXY(45,272);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(20, 3, 'Jasmine Gohil', 0, 1, 'L');
        $pdf->SetXY(45,276);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(20, 3, 'Controller of Examination', 0, 1, 'L');

        $pdf->SetXY(134,273);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 3, 'Dr. Sridhar B Reddy ', 0, 1, 'L');
        $pdf->SetXY(134,276);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 3, 'Registrar', 0, 1, 'L');

        $pdf->Output('mark_sheet.pdf');    
    }

    public function uploadExcel(Request $request)
    {
        $pdf = new TCPDF('P', 'mm', array('210', '297'), false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetAutoPageBreak(false, 0);
        // Validate the uploaded file
        $request->validate([
            'excel_file' => 'required|mimes:xls,xlsx', // Add any other validation rules as needed
        ]);
    
        // Upload the Excel file to the public folder
        $file = $request->file('excel_file');
        $fileName = $file->getClientOriginalName();
        // dd(public_path());
        $file->move(public_path('excel'), $fileName);
        // dd($file);
        $path = public_path('excel/').$fileName;
        // dd($path);
        $data = Excel::toArray([], $path);
        $sheetData = $data[0];
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
                $x=12;$y=93;
                $pdf->SetFont('helvetica', 'I', 9);
                $pdf->SetXY(12,93);  
                $columnNames1 = [$Studentdata[30], $Studentdata[31], $Studentdata[32],$Studentdata[33],$Studentdata[34],$Studentdata[35]];
                $columnBorder=['L','L','L','L','L','LR'];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key], 0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
                }
                $x=12;$y=103;
                $pdf->SetXY(12,103);  
                $columnNames1 = [$Studentdata[36], $Studentdata[37], $Studentdata[38],$Studentdata[39],$Studentdata[40],$Studentdata[41]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
                }
                $x=12;$y=113;
                $pdf->SetXY(12,113);  
                $columnNames1 = [$Studentdata[42], $Studentdata[43], $Studentdata[44],$Studentdata[45],$Studentdata[46],$Studentdata[47]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
                }
                $x=12;$y=123;
                $pdf->SetXY(12,123);  
                $columnNames1 = [$Studentdata[48], $Studentdata[49], $Studentdata[50],$Studentdata[51],$Studentdata[52],$Studentdata[53]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
                } 
                $x=12;$y=133;
                $pdf->SetXY(12,133);  
                $columnNames1 = [$Studentdata[54], $Studentdata[55], $Studentdata[56],$Studentdata[57],$Studentdata[58],$Studentdata[59]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
                }

                $x=12; $y=143;
                $pdf->SetXY(12,143);  
                $columnNames1 = [$Studentdata[60], $Studentdata[61], $Studentdata[62],$Studentdata[63],$Studentdata[64],$Studentdata[65]];
                foreach ($columnNames1 as $key=> $name) {
                    // $pdf->Cell($columnWidths[$key], 10, $name, $columnBorder[$key],0, $alignData[$key]);
                    $pdf->MultiCell($columnWidths[$key], 10, $name,$columnBorder[$key], $alignData[$key],0, 1, '', '', true, 0, false, true, 10, 'M');
                    $x += $columnWidths[$key]; // Increment x for the next MultiCell
                    $pdf->SetXY($x, $y); // Set the new coordinate
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
                $pdf->SetFont('helvetica', 'I', 7);  
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
       
                 $firstname=$Studentdata[2];
                 $lastname=$Studentdata[3];
                 $unique_id=trim($Studentdata[0],"=");
                 $data=['unique_id'=>$unique_id,'firstname'=>$firstname,'lastname'=>$lastname];
                // Student_data::create($data);
                // print_r($data);
                FacadesDB::table('student_data')->insert($data);
        }   
        $pdf->Output($Studentdata[127]);  






    
        // return redirect()->back()->with('success', 'Excel file uploaded successfully.');
    }


    public function getData($unique_id){
       
     
          $data = Student_data::where('unique_id', $unique_id)->get();
    
          if ($data->count() === 0) {
              return response()->json(['message' => 'Data not found'], 404);
          }
          
          return response()->json($data);
       

    }



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
