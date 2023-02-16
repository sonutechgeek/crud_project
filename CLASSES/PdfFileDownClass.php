<?php
include 'connection.php';
class PdfFileDownload{
    private $conn;
    public function __construct(){
        $this->conn = new ConnPDO();
    }
    public function action(){
        $this->downloadPdfFile();
    }
    function downloadPdfFile(){
        require_once('../TCPDF-main/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Sonu Chaudhary');
        $pdf->SetTitle('StudentDetail');
        $pdf->SetSubject('Report');
        // $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'Student Detail', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
      
        $startDate= $_POST['fdate'];
        $endDate= $_POST['tdate'];
        $from= date("d-m-Y", strtotime($startDate));
        $to= date("d-m-Y", strtotime($endDate));
       
        $sql= "SELECT id,name,mobile,email,E_marks,H_marks,M_marks,S_marks,S_grad,entryDateTime FROM details LEFT JOIN marks2 ON details.id=marks2.m_id WHERE (DATE(entryDateTime) BETWEEN '$startDate' AND '$endDate') AND STATUS='active' ORDER BY id ASC";
        $result1 = $this->conn->Execute($sql);
        // Set font and add table
        $data=$result1->fetchAll();
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $html='<h1 style="text-align:center">Active Student Detail </h1>
        <h3 style="text-align:center"> From '.$from.' TO ' .$to.'</h3>';
        $pdf->writeHTML($html, true, false, true, false, '');
        //Table Headers
        $pdf->Ln();
          

        $pdf->Cell(6, 10, 'SID', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(30, 10, 'Name', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(20, 10, 'Mobile', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(50, 10, 'Email', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(12, 10, 'English', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(10, 10, 'Hindi', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(11, 10, 'Maths', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(13, 10, 'Science', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(10, 10, 'Grade', 1, 0, 'C', 0, '', 0);
        $pdf->Cell(35, 10, 'Entry Date and Time', 1, 0, 'C', 0, '', 0);
        $pdf->Ln();

        // Table data
        foreach($data as $row) {
            $pdf->Cell(6, 10, $row['id'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(30, 10, $row['name'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(20, 10, $row['mobile'], 1, 0, 'C', 0, '', 0);
            $pdf->Cell(50, 10, $row['email'], 1, 0, 'C', 0, '', 0);
            if($row['E_marks']==""||$row['E_marks']==null)
              $row['E_marks']="-";
            $pdf->Cell(12, 10, $row['E_marks'], 1, 0, 'C', 0, '', 0);
            if($row['H_marks']==""||$row['H_marks']==null)
              $row['H_marks']="-";
            $pdf->Cell(10, 10, $row['H_marks'], 1, 0, 'C', 0, '', 0);
            if($row['M_marks']==""||$row['M_marks']==null)
              $row['M_marks']="-";
            $pdf->Cell(11, 10, $row['M_marks'], 1, 0, 'C', 0, '', 0);
            if($row['S_marks']==""||$row['S_marks']==null)
              $row['S_marks']="-";
            $pdf->Cell(13, 10, $row['S_marks'], 1, 0, 'C', 0, '', 0);
            if($row['S_grad']==""||$row['S_grad']==null)
              $row['S_grad']="-";
            $pdf->Cell(10, 10, $row['S_grad'], 1, 0, 'C', 0, '', 0);
            $date=date_create($row['entryDateTime']);
            $date=date_format($date,"d-m-Y H:i:s");
            $pdf->Cell(35, 10, $date, 1, 0, 'C', 0, '', 0);
            $pdf->Ln();
        }
        $pdf->Output('Student Data.pdf', 'I');

    }
}

$pdf = new PdfFileDownload();
$pdf->action();

?>
