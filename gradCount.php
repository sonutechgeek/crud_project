<?php 
include('CLASSES\connection.php');
// error_reporting(0);
class StudentDataController{
            private $conn;
            public function __construct(){
                $this->conn = new ConnPDO();
              
            }
            function readGrade(){
                $Acount=0;
                $Bcount=0;
                $Ccount=0;
                $Dcount=0;
            $sql3= "SELECT S_grad FROM marks2  ORDER BY m_id ASC";
             $result3 = $this->conn->Execute($sql3);
             if($result3->rowCount()>0){
                $data2 = [];
                while ($row = $result3->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $data2[] = $row;
                }
                $i=0;
                while($i<count($data2)){
                $grad = $data2[$i]["S_grad"];
                // echo $grad;
                 switch ($grad) {
                    case 'A':
                        $Acount=$Acount+1;
                            break;

                    case 'B':
                        $Bcount=$Bcount+1;
                            break;    
                    case 'C':
                        $Ccount=$Ccount+1;
                            break;
                    case 'D':
                        $Dcount=$Dcount+1;
                            break;
                    default:
                        # code...
                        break;
                 }
                $i=$i+1;
                }
                echo "<h2>Count number of grade </h2>";
                echo "<h3>Number of time A occur in grade : $Acount</h3>";
                echo "<h3>Number of time B occur in grade : $Bcount</h3>";
                echo "<h3>Number of time C occur in grade : $Ccount</h3>";
                echo "<h3>Number of time D occur in grade : $Dcount</h3>";
                
                // exit(print_r($data2));

            }
            }
            function check_documents(){
                $print='';
                $sql= "SELECT id,name FROM details LEFT OUTER JOIN studentdoc ON details.id=studentdoc.Sid WHERE (adharFront=''||adharBack=''||panCard='') ORDER BY id ASC"; 
                $result=$this->conn->Execute($sql);
                if($result->rowCount()>0){
                    $data = [];
                    while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                        $data[] = $row;
                    }
                    $i=0;
                    echo "<h2>Document not Found in studentDoc table </h2>";
                    echo "<table border='1'>
                    <tr>
                    <th>Id</th>
                    <th>name</th>
                    </tr>";  
                    while($i<count($data)){
                    $id=$data[$i]['id'];
                    $name=$data[$i]['name'];
                     
                                    echo'  <tr>';
                                        echo' <h3><th> '.$id.' </th></h3>';
                                        echo' <h3><th> '.$name.'</th></h3>';
                                    echo'  </tr>';
                                    
                        
                     $i=$i+1;
                    }
                    echo'</table>';
                    // exit(print_r($data));
                   
                }
            }
        }


$sdc= new StudentDataController();
$sdc->readGrade(); 
$sdc->check_documents(); 
        
?>