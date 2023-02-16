<?php 
include('connection.php');
class StudentDataPdf{
        private $conn;
        public function __construct(){
            $this->conn = new ConnPDO();
        }        
        public function action(){
            $this->creatStudentDataExcel();
        }

        function creatStudentDataExcel(){
            require_once '../excel-libary/PHPExcel.php';
            require_once '../excel-libary/PHPExcel/Writer/Excel2007.php';
            $startDate= $_POST['fdate'];
            $endDate= $_POST['tdate'];
            $from= date("d-m-Y", strtotime($startDate));
           $to= date("d-m-Y", strtotime($endDate));
            $sql= "SELECT id,name,mobile,email,E_marks,H_marks,M_marks,S_marks,S_grad,entryDateTime FROM details LEFT JOIN marks2 ON details.id=marks2.m_id WHERE (DATE(entryDateTime) BETWEEN '$startDate' AND '$endDate') AND STATUS='active' ORDER BY id ASC";
            // $sql = "SELECT * FROM `details` where (DATE(entryDateTime) BETWEEN '$startDate' AND '$endDate') AND`status`='active'";
            $result= $this->conn->Execute($sql);
            if($result->rowCount()>0){
                $data = [];
                    while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                        $data[] = $row;
                    }
            }
            $objPHP = new PHPExcel();
            $objPHP->setActiveSheetIndex(0);  
            $rowcount=1;
            $objPHP->getActiveSheet()->mergeCells("A" . $rowcount . ":J" . $rowcount);
            $objPHP->getActiveSheet()->setCellValue('A'.$rowcount , "Student Detail");

            $objPHP->getActiveSheet()->mergeCells("A" . $rowcount+1 . ":J" . $rowcount+1);
            $objPHP->getActiveSheet()->setCellValue('A'.$rowcount+1, "From $from TO $to");

            $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle('A' . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFont()->setName('Cambria')->setSize(15)->setBold(true);
            $rowcount=3;
            $objPHP->getActiveSheet()->setCellValue('A3' , "SID");
            $objPHP->getActiveSheet()->setCellValue('B3' , "NAME");
            $objPHP->getActiveSheet()->setCellValue('C3' , "MOBILE");
            $objPHP->getActiveSheet()->setCellValue('D3' , "EMAIL");
            $objPHP->getActiveSheet()->setCellValue('E3' , "ENHLISH");
            $objPHP->getActiveSheet()->setCellValue('F3' , "HIND");
            $objPHP->getActiveSheet()->setCellValue('G3' , "MATH");
            $objPHP->getActiveSheet()->setCellValue('H3' , "SCIENCE");
            $objPHP->getActiveSheet()->setCellValue('I3' , "GRAD");
            $objPHP->getActiveSheet()->setCellValue('J3' , "ENTRY_DATE_TIME");
            
            $objPHP->getActiveSheet()->getStyle("A3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle("C3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $objPHP->getActiveSheet()->getStyle("B3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("D3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("E3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("F3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("G3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("H3" )->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHP->getActiveSheet()->getStyle("I3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                       

            $objPHP->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
            $objPHP->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                
            $objPHP->getActiveSheet()->getStyle('A' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('B' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->freezePane('C1');
            $objPHP->getActiveSheet()->getStyle('C' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('D' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('E' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('F' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('G' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('H' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('I' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
            $objPHP->getActiveSheet()->getStyle('J' . $rowcount)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
                
            foreach ($data as $row) {
                $objPHP->getActiveSheet()->getStyle("A" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHP->getActiveSheet()->getStyle("B" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("C" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                $objPHP->getActiveSheet()->getStyle("D" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("E" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("F" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("G" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("H" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objPHP->getActiveSheet()->getStyle("I" . $rowcount+1)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                           
                $objPHP->getActiveSheet()->getStyle('A' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_BLUE);
                $objPHP->getActiveSheet()->getStyle('B' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                $objPHP->getActiveSheet()->getStyle('C' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
                $objPHP->getActiveSheet()->getStyle('D' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                // $objPHP->getActiveSheet()->getStyle('E' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
                // $objPHP->getActiveSheet()->getStyle('F' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
                // $objPHP->getActiveSheet()->getStyle('G' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_GREEN);
                $objPHP->getActiveSheet()->getStyle('I' . $rowcount+1)->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_RED);
                        
                $objPHP->getActiveSheet()->setCellValue('A'. $rowcount+1, $row['id']);
                $objPHP->getActiveSheet()->setCellValue('B'. $rowcount+1, $row['name']);
                $objPHP->getActiveSheet()->setCellValue('C'. $rowcount+1, $row['mobile']);
                $objPHP->getActiveSheet()->setCellValue('D'. $rowcount+1, $row['email']);
                if($row['E_marks']==""||$row['E_marks']==null)
                $row['E_marks']="-";
                $objPHP->getActiveSheet()->setCellValue('E'. $rowcount+1, $row['E_marks']);
                if($row['H_marks']==""||$row['H_marks']==null)
                $row['H_marks']="-";
                $objPHP->getActiveSheet()->setCellValue('F'. $rowcount+1, $row['H_marks']);
                if($row['M_marks']==""||$row['M_marks']==null)
                $row['M_marks']="-";
                $objPHP->getActiveSheet()->setCellValue('G'. $rowcount+1, $row['M_marks']);
                if($row['S_marks']==""||$row['S_marks']==null)
                $row['S_marks']="-";
                $objPHP->getActiveSheet()->setCellValue('H'. $rowcount+1, $row['S_marks']);
                if($row['S_grad']==""||$row['S_grad']==null)
                $row['S_grad']="-";
                $objPHP->getActiveSheet()->setCellValue('I'. $rowcount+1, $row['S_grad']);
                $date=date_create($row['entryDateTime']);
                $date=date_format($date,"d-m-Y H:i:s");
                $objPHP->getActiveSheet()->setCellValue('J'. $rowcount+1,$date);
                $rowcount++;
            }
            $writer = new PHPExcel_Writer_Excel2007($objPHP); 
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=data.xls");
            $writer->save('php://output');
            exit;
        }
 }
$sdc= new StudentDataPdf();
$sdc->action(); 
?>

