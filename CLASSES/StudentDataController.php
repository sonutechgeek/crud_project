<?php 
include('connection.php');

class StudentDataController{
            private $conn;
            public function __construct(){
                $this->conn = new ConnPDO();
                // $this->conn = new ConnPDO();
                if(isset($_REQUEST['action']) && $_REQUEST['action']=='studentList'){
                        $this->readStudentData();
                }
                if(isset($_REQUEST['action']) && $_REQUEST['action']=='studentDocList'){
                    $this->readStudentDoc();
                }
                if(isset($_REQUEST['action']) && $_REQUEST['action']=='viewDocument'){
                    $this->viewOneDocument();
                }
            }
            public function action(){
                if(isset($_REQUEST['action']) && $_REQUEST['action']=='addStudent'){
                    $this->addStudentData();    
                }        
                elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='deleteStudentData'){
                    $this->deleteStudentData();    
                }        
                elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='updateStudentData'){
                    $this->updateStudentData();    
                }        
                elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='viewStudentData'){
                    $this->viewStudentData();    
                }        
                elseif(isset($_REQUEST['action']) && $_REQUEST['action']=='addStudentMark'){
                    $this->addStudentMarks();    
                }        
            } 


            function viewStudentData(){
                $id= $_GET['id' ];
                $sql= "SELECT *  FROM `details`  WHERE  `id` =   $id";
                $result = $this->conn->Execute($sql);   
                $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                exit(json_encode($row));    
            }


            function viewOneDocument(){
                $id= $_GET['id' ];
                $doc= $_GET['document' ];
                $sql= "SELECT `$doc` FROM `studentdoc`  WHERE  `Sid` =   $id";
                $result = $this->conn->Execute($sql);   
                $row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
                exit(json_encode($row));    
            }


            function updateStudentData(){
                $name= $_POST['name' ];
                $mobile= $_POST['mobile' ];
                $email= $_POST['email' ];
                $id= $_POST['student_id' ];
                $img1 =  $_POST['img1' ]; 
                $img2 =  $_POST['img2' ]; 
                $img3 =  $_POST['img3' ]; 
                $sql= "UPDATE `details`  SET  `name` = '". $name."'  , 
                `mobile`  =  '".$mobile ."' , `email`  ='".$email ."' WHERE `id` = $id " ;
                $sql1= "UPDATE `studentdoc`  SET `adharFront`  = '".$img1."',`adharBack`='".$img2."',`panCard`='".$img3."',`status`  = 'active'  WHERE `Sid`  =  $id " ;
               
                // if($img1!=null){
                //     $sql= "UPDATE `studentdoc`  SET  `adharFront` = '". $img1."' WHERE `Sid` = $id " ;
                //     $this->conn->Execute($sql);
                // }
                // if($img2!=null){
                //     $sql= "UPDATE `studentdoc`  SET  `adharBack` =  '".$img2."' WHERE `Sid` = $id " ;
                //     $this->conn->Execute($sql);
                // }
                // if($img3!=null){
                //     $sql= "UPDATE `studentdoc`  SET  `panCard`  = '".$img3."' WHERE `Sid` = $id " ;
                //     $this->conn->Execute($sql);
                // }
               
               
                $this->conn->Execute($sql);
                if($this->conn->Execute($sql1)){
                    $response = [
                        'status'=>'ok',
                        'success'=>true,
                        'message'=>'Record updated succesfully!'
                    ];
                      exit(json_encode($response));
                }else{
                    $response = [
                        'status'=>'ok',
                        'success'=>false,
                        'message'=>'Record supdated failed!'
                    ];
                    exit(json_encode($response));
                } 
            }            


            function deleteStudentData(){
                $id =$_GET['id' ];  
                $sql= "UPDATE `details`  SET  `status` = 'inactive'  WHERE `id`  =  $id " ;
                $sql1= "UPDATE `studentdoc`  SET `status`  = 'inactive'  WHERE `Sid`  =  $id " ;
                $this->conn->Execute($sql1);
                if($this->conn->Execute($sql)){
                    $response = [
                        'status'=>'ok',
                        'success'=>true,
                        'message'=>'Record deleted succesfully!'
                    ];
                    exit (json_encode($response));
                }else{
                    $response = [
                        'status'=>'ok',
                        'success'=>false,
                        'message'=>'Record deleted failed!'
                    ];
                    exit(json_encode($response));
                } 
    
            }


            function readStudentDoc(){ 
                 $sql= "SELECT *  FROM `studentdoc` WHERE STATUS='active'ORDER BY Sid ASC"; 
                 $result = $this->conn->Execute($sql);
                if($result->rowCount()>0){
                 $data1 = [];
                 while ($row = $result->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                  $data1[] = $row;
                 }
                exit(json_encode($data1));
                }
                else{
                exit(json_encode($data1));
                }
            }


            function readStudentData(){
                $sql1= "SELECT *  FROM `details`WHERE STATUS='active' ORDER BY id ASC"; 
                $sql2= "SELECT id,name,mobile,email,S_grad,entryDateTime FROM details LEFT OUTER JOIN marks2 ON details.id=marks2.m_id WHERE STATUS='active' ORDER BY id ASC"; 
                // $sql3= "SELECT S_grad FROM details LEFT OUTER JOIN marks2 ON details.id=marks2.m_id WHERE STATUS='active' ORDER BY id ASC";
                $result1 = $this->conn->Execute($sql1);
                $result2 = $this->conn->Execute($sql2);
                // $result3 = $this->conn->Execute($sql3);

                if($result1->rowCount()>0){
                    $data1 = [];
                    while ($row = $result1->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                        $data1[] = $row;
                    }
                    // exit(json_encode($data));
                }
                if($result2->rowCount()>0){
                    $data2 = [];
                    while ($row = $result2->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                        $data2[] = $row;
                    }
                    // exit(json_encode($data));
                }
                if(sizeof($data1)>sizeof($data2)){
                    exit(json_encode($data1));
                }
                    else{
                            exit(json_encode($data2));
                    }
    
            }


            function addStudentMarks(){
                $E_maks =  $_POST['e_marks' ]; 
                $H_maks =  $_POST['h_marks' ]; 
                $M_maks =  $_POST['m_marks' ]; 
                $S_maks =  $_POST['s_marks' ]; 
                $id =  $_POST['student_id' ]; 
                $total=($E_maks+$M_maks+$H_maks+$S_maks)/4;
                $grad="";
                if($total<100&&$total>85){
                    $grad='A';
                }
                elseif($total<85&&$total>65){
                    $grad='B';
                }
                elseif($total<65&&$total>45){
                    $grad='C';
                }
                elseif($total<45&&$total>20){
                    $grad='D';
                }
                else{
                    $grad='fail';
                }
                $sql=  "INSERT INTO `marks2` (`m_id`, `E_marks`, `H_marks`, `M_marks`, `S_marks`, `S_grad`) VALUES ('$id', '$E_maks', '$H_maks', '$M_maks', '$S_maks','$grad')";      
                    if($this->conn->Execute($sql)){
                        $response = [
                            'status'=>'ok',
                            'success'=>true,
                            'message'=>'Record created succesfully!'
                        ];
                        exit(json_encode($response));
                    }else{
                        $response = [
                            'status'=>'ok',
                            'success'=>false,
                            'message'=>'Record created failed!'
                        ];
                        exit(json_encode($response));
                    } 
            }


            function addStudentData(){
                $name =  $_POST['name' ]; 
                $mobile =  $_POST['mobile' ]; 
                $email =  $_POST['email' ]; 
                $img1 =  $_POST['img1' ]; 
                $img2 =  $_POST['img2' ]; 
                $img3 =  $_POST['img3' ]; 
                $status='active';
                $sql=  "INSERT INTO `details` (`id`, `name`, `mobile`, `email`, `entryDateTime`,`status`) VALUES 
                (' ', '{$name} ' , ' {$mobile } ' , ' {$email } ',NOW(),'$status')" ; 
                $this->conn->Execute($sql);
                $id="SELECT LAST_INSERT_ID()";
                $res= $this->conn->Execute($id);
                if($res->rowCount()>0){
                    $data1 = [];
                    while ($row = $res->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    $data1[] = $row;
                }
            
                $sid = $data1[0]["LAST_INSERT_ID()"];
                }
                $sql1="INSERT INTO `studentdoc` (`Did`, `Sid`, `adharFront`, `adharBack`, `panCard`,`status`) VALUES ('', '$sid','$img1','$img2','$img3','$status')";
                    if($this->conn->Execute($sql1)){
                        $response = [
                            'status'=>'ok',
                            'success'=>true,
                            'message'=>'Record created succesfully!'
                        ];
                        exit(json_encode($response));
                    }else{
                        $response = [
                            'status'=>'ok',
                            'success'=>false,
                            'message'=>'Record created failed!'
                        ];
                        exit(json_encode($response));
                    } 
            }
}

$sdc= new StudentDataController();
$sdc->action();  
?>