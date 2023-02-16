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
        $pdf->SetSubject('ReportForPrize');
        $pdf->setFooterData(array(0,64,0), array(0,64,128));
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $sql= "SELECT result_no FROM `result` WHERE lotcode=1175;";
        $result1 = $this->conn->Execute($sql);
        if($result1->rowCount()>0){
            $data = [];
            while ($row = $result1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                $data[] = $row;
            }
        }
        $data1=explode(':',  $data[0]['result_no']);
        $data2=explode(':',  $data[1]['result_no']);
        $data3=explode(':',  $data[2]['result_no']);
        $data4=explode(':',  $data[3]['result_no']);
        $data5=explode(':', $data[4]['result_no']);
        $size1= count($data3)-2;
        $size2= count($data4)-2;
    
        $pdf->SetFont('helvetica', 'B', 17);
        $pdf->AddPage();
        $html='<h1 style="text-align:center">Players Prize</h1>';
        $pdf->writeHTML($html, true, false, true, false, '');
        //Table Headers
        $pdf->Ln();
        $pdf->Cell(95, 12, '1st Prize Rs 10000/-', 1, 0, 'L', 0, '', 0);
        $pdf->Cell(95, 12,  $data1[1], 1, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->Cell(95, 12, '2nd Prize Rs 1000/-', 1, 0, 'L', 0, '', 0);
        $pdf->Cell(95, 12,  $data2[1], 1, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $pdf->SetFont('helvetica', '', 12);
        
        $pdf->Cell(95, 7, '3rd Prize Rs 500/-', 1, 0, 'L', 0, '', 0);
        if($size1>=1&&$size1<=3){
            $width=95/$size1;
            $i=1;
            $j=0;
            $k=1;
            while($i<=$size1){
            $pdf->SetFont('helvetica', '',12);
            $pdf->Cell($width, 7, $data3[$k++], 1, 0, 'C', 0, '', 0);
            $i=$k;
            }
            $pdf->Ln();
        }

        $pdf->Cell(95, 7, '4th Prize Rs 200/-', 1, 0, 'L', 0, '', 0);
        if($size2>=1&&$size2<=5){
            $width=95/$size2;
            $i=1;
            $j=0;
            $k=1;
            while($i<=$size2){
            $pdf->SetFont('helvetica', '',12);
            $pdf->Cell($width, 7, $data4[$k++], 1, 0, 'C', 0, '', 0);
            $i=$k;
            }
            $pdf->Ln();
        }
        $pdf->SetFont('helvetica', 'B', 18);
        $pdf->Cell(190, 10, '5th Prize Rs 100/- ', 1, 0, 'C', 0, '', 0);
        $pdf->Ln();
        $i=1;
        $j=0;
        $k=1;
        while($i<count($data5)-1){
        $pdf->SetFont('helvetica', '',12);
        $pdf->Cell(19, 7, $data5[$k++], 1, 0, 'C', 0, '', 0);
        $j++;
        if($j==10){
             $pdf->Ln();
             $j=0;
        }
        $i=$k;
        }
        
        $image_file = '../images/to-do2.png';
        $image_width = 190;
        $image_height = 40;
        $pdf->Ln();

        $pdf->Image($image_file, $x = '', $y = '', $image_width, $image_height);
        // $pdf->Image('to-do2.png', 50, 50, 100, '', '', '', '', false, 300);
        // $html='<img  style="width:200px;height:200px;"src="to-do2.png" alt="Girl in a jacket">';
        // $pdf->writeHTML($html, true, false, true, false, '');
        //Table Headers
        $pdf->Output('Student Data.pdf', 'I');
    }
}
$pdf = new PdfFileDownload();
$pdf->action();

?>
