<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use PDF;
use TCPDF;

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
   
        $pdf->AddPage();

        // $pdf->SetMargins(0, 0,0, true);
        $borderColor1 = [255, 0, 0];  // Red color (RGB)
        $borderColor3 = [155,237,255];  // Blue color (RGB)
         //set border
        $pdf->SetDrawColor($borderColor3[0], $borderColor3[1], $borderColor3[2]);
        $pdf->Rect(6, 5, $pdf->getPageWidth() -13, $pdf->getPageHeight() -15);
        $pdf->SetDrawColor($borderColor1[0], $borderColor1[1], $borderColor1[2]);
        $pdf->Rect(7, 6, $pdf->getPageWidth() - 15, $pdf->getPageHeight() - 17);
        $pdf->SetDrawColor($borderColor3[0], $borderColor3[1], $borderColor3[2]);
        $pdf->Rect(8, 7, $pdf->getPageWidth() -17, $pdf->getPageHeight() -19);
      

        //image path
        $imagePath1 = public_path('images/images.jfif');
        $imagePath2 = public_path('images/down.jfif');

        // Set an image within a cell
        $pdf->Image($imagePath1, 79, 11, 55, 20);
        $pdf->SetY(35);
        $pdf->SetFont('helvetica', 'BI', 20);
        $pdf->Cell(0, 10, 'Semister Acadmic Report', 0, 1, 'C');
        $pdf->SetDrawColor(0);
        $borderWidth = 0.001;
        $pdf->SetLineWidth($borderWidth);
        // $pdf->SetY(45);
        $pdf->SetFont('helvetica', 'I', 14);
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
        $pdf->Image($imagePath2, 170, 45, 27,36);
       
        $borderColor2 = [0, 0, 0];  //  color (RGB)
        $columnWidths = [22, 97, 16,17,17,17];
        // Set initial x and y coordinates
          $x = 12;
          $y = 83;
        $columnNames = ['Course Code', 'Course', 'Credit Enrolled','Credit Earned','Grade','Grade Point'];
        $pdf->SetXY(12,83);    
        // Create the table header with column names
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name, 1, 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates
        }
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetXY(12,93);  
        $columnNames1 = ['FNDN101', 'EXPLORING DESIGN DISCIPLINE', '6.0','6.0','C+','2.80'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }

        $pdf->Ln();
        $pdf->SetXY(12,103);  
        $columnNames1 = ['FNDN102', 'WRITTEN & VERBAL COMMUNICATION', '3.0','3.0','B','3.20'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }
        $pdf->Ln();
        $pdf->SetXY(12,113);  
        $columnNames1 = ['FNDN103', 'INSPIRATIONS', '1.5','1.5','D','2.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }

        $pdf->Ln();
        $pdf->SetXY(12,123);  
        $columnNames1 = ['FNDN131', 'ELEMENTS OF DESIGN', '3.0','3.0','B-','3.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }

        $pdf->Ln();
        $pdf->SetXY(12,133);  
        $columnNames1 = ['FNDN132', 'VISUALIZATION & REPRESENTATION-I', '2.0','2.0','B-','2.00'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }

        $pdf->Ln();
        $pdf->SetXY(12,143);  
        $columnNames1 = ['FNDN161', 'DESIGN PROCESS MODULE#', '1.5','1.5','P-','--'];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths[$key], 10, $name, 'LR', 'C');
        }

        
        $pdf->Ln();
        $x = 12;
        $y = 153;
        $pdf->SetXY(12,153);  
        $columnNames1 = ['FNDN162', 'UNLEARNING MODULE', 'NC','NC','P','--'];
        foreach ($columnNames1 as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 50, $name, 'TLRB','T');
            // $pdf->Cell($columnWidths[$key], 50, $name, 1, 'T');
            $pdf->MultiCell($columnWidths[$key], 58, $name, 'LRB', 'T');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates
        }


        
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetXY(12,215);  
        $columnWidths1 = [93,93];
        $columnNames1 = ['Semester Grade Point Average (SGPA)', 'Cumulative Grade Point Average (CGPA)' ];
        foreach ($columnNames1 as $key=> $name) {
            $pdf->Cell($columnWidths1[$key], 10, $name, '1','C');
           
        }

      

        $columnWidths = [27, 35, 31,31,31,31];
        // Set initial x and y coordinates
          $x = 12;
          $y = 225;
          $pdf->SetFont('helvetica', '', 9);
        $columnNames =    
        ['Earned Credits', 'Earned Credit Points Σ(Credit X Grade Points)', 'SGPA','Total Earned Credits','Total Earned Points','CGPA'];
        $pdf->SetXY(12,225);    
        foreach ($columnNames as $key=> $name) {
            // $pdf->Cell($columnWidths[$key], 20, $name, 1, 'C');
            $pdf->MultiCell($columnWidths[$key], 10, $name, 'LR', 'C');
            $x += $columnWidths[$key]; // Increment x for the next MultiCell
            $pdf->SetXY($x, $y); // Set the new coordinates
        }

        $x = 12;
        $y = 235;
        $pdf->SetFont('helvetica', '', 9.5);
        $columnNames =    
        ['17.0', '44.40', '2.86 Good
        ','17.0','44.40','2.86 Good'];
        $pdf->SetXY(12,235);    
        foreach ($columnNames as $key=> $name) {
          $pdf->Cell($columnWidths[$key], 10, $name, 'TLRB', 'C');
        //   $pdf->MultiCell($columnWidths[$key], 10, $name, 1, 'C');
        //   $x += $columnWidths[$key]; // Increment x for the next MultiCell
        //   $pdf->SetXY($x, $y); // Set the new coordinates
        }


    //   $pdf->SetXY(13,255);
      $style = array
        (
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );

         //  -----QR CODE-----
        $pdf->write2DBarcode('devharsh pvt ltd', 'QRCODE,L', 13, 253, 21, 20, $style, 'N');
        $pdf->SetXY(15,270);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(20, 5, 'AFY 00098', 0, 1, 'C');


        $pdf->Output('user_data_and_roles.pdf');

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
