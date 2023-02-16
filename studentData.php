<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> AJAX CRUD OPERATION USING PHP</title>
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" media="mediatype and|not|only (expressions)" href="print.css"> -->
    <!-- <link rel="stylesheet" href="CSS/media.css"> -->
    <style>
        #main_titel {
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 13px;
            letter-spacing: 2px;
            font-weight: 500px;
        }
    </style>
</head>
<!-- body section  -->
<body>
    
    <H1 id="main_titel">CRUD OPERATION IN PHP</H1>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="#addStudentModal" class="btn btn-primary" data-toggle="modal">
                                <span>Add New</span></a>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#report-model">
                                 Generate Report
                                </button>
                        </div>
                    </div>
                    <div style="overflow-x:auto;">
                     <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><h5>SID</h5></th>
                                <th><h5>NAME</h5></th>
                                <th><h5>MOBILE</h5></th>
                                <th><h5>EMAIL</h5></th>
                                <th><h5>ENTRY-DATE-TIME</h5></th>
                                <th><h5>GRADE</h5></th>
                                <th><h5>MARKS</h5></th>
                                <th colspan="2" id="action" style="padding-left:81px;"><h5>ACTION</h5></th>
                            </tr>
                        </thead>
                        <tbody id="student_data"></tbody>
                      </table>
                    </div>
                </div>
                <!-- note  -->
                <div class="container">
                <h3 style="color:red;"> Note </h3> 
                    <spane><b> A: 85% or Higher</b> &nbsp</spane>
                    <spane><b> B: In Between 85% and 65%</b> &nbsp</spane>
                    <spane> <b>C: In Between 65% and 45% </b>&nbsp</spane>
                    <apne> <b>F: In Between 45% or lower</b> &nbsp</spane>
                </div>
                <!-- note  -->
            </div>
            <!-- student document  -->
            <div style="margin-top: 120px;">
                <H1 id="main_titel">STUDENT DOCUMENTS</H1>
            </div>
      <!-- table for document  -->
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title"></div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><h5>SID</h5></th>
                                <th><h5>ADHARFRONT</h5></th>
                                <th><h5>ADHARBACK</h5></th>
                                <th><h5>PANCARD</h5></th>
                            </tr>
                        </thead>
                        <tbody id="student_file_data"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- table for file  -->      

        <!-- start Add Student Modal HTML -->
        <!-- <form enctype="multipart/form-data" id="" action="studentData.php" method="POST"> -->
        <div id="addStudentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body add_student">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" id="name_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student Mobile</label>
                            <input type="text" id="mobile_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student Email</label>
                            <input type="email" id="email_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student AdharFront</label>
                            <!-- for adhar -->
                            <input name="adhar_card_front" id="adhar_card_front" type="file"class="form-control fileToUpload" />
                            <!-- for adhar -->
                        </div>
                        <div class="form-group">
                            <label>Student AdharBack</label>
                            <!-- for adhar -->
                            <input name="adhar_card_back" id="adhar_card_back" type="file" class="form-control" required />
                            <!-- for adhar -->
                        </div>
                        <div class="form-group">
                            <label>Student PanCard</label>
                            <!-- for pan -->
                            <input name="pancard" id="pancard" type="file" class="form-control" required />
                            <!-- for pan -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-dark" data-dismiss="modal" value="Close">
                        <input type="submit" class="btn btn-success" value="Save" onclick="addStudent()">
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
        <!-- End Add Student Modal HTML -->

        <!--start report generator model  -->
        <div class="modal fade" id="report-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Generate Report</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-8 m-auto">
                            <form action="CLASSES/PdfFileDownClass.php" method="POST" onsubmit="return validation()">
                                <div class="form-group">
                                    <label for="fdate">FromDate</label>
                                    <input type="date" name="fdate" id="fdate" class="form-control"autocomplete="off">
                                    <span id="ename" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="todate">ToDate</label>
                                    <input type="date" name="tdate" id="tdate" class="form-control"autocomplete="off">
                                </div>
                                <input type="submit" class="btn btn-success" value="DownlodePDF">
                                <input type="submit" class="btn btn-success"formaction="CLASSES/ExcelFileDownClass.php" value="DownlodeExcel">
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <!--end  report generator model  -->

        <!-- view document  -->
        <div class="modal fade" id="view-document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-8 m-auto">
                            <!-- <form action method="POST"> -->
                                <div class="form-group">
                                    <select class="selectVal form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        <option selected>Choose Document</option>
                                        <option value="AadharFront">AdharFront</option>
                                        <option value="AadharBack"> AadharBack</option>
                                        <option value="PanCard">PanCard</option>
                                        
                                    </select>
                                    <input type="submit" class="btn btn-info" value ="view" data-toggle="modal" data-target="#view-image" onclick="viewDoc()">
                                    
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <!-- image model -->
        <div class="modal fade" id="view-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="">    
                        <div class="form-group" id="image">   
                                <!-- <div class="form-group" id="image"style="width:400px;height:400px;background-image:cover;box-sizing:model-Box;">    -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close">
                        <!-- <input type="submit" class="btn btn-success" value="Save" onclick="addStudent()"> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- image model -->

        <!--start Edit Modal HTML -->
        <div id="editStudentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update</h4>
                        <button type="button" class=" close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body edit_student">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" id="name_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student Mobile</label>
                            <input type="text" id="mobile_input" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student Email</label>
                            <input type="email" id="email_input" class="form-control" required>
                            <input type="hidden" id="student_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Student AdharFront</label>
                            <!-- for adhar -->
                            <input name="adhar_card_front" id="adhar_card_front" type="file"class="form-control fileToUpload">
                            <!-- for adhar -->
                        </div>
                        <div class="form-group">
                            <label>Student AdharBack</label>
                            <!-- for adhar -->
                            <input name="adhar_card_back" id="adhar_card_back" type="file" class="form-control">
                            <!-- for adhar -->
                        </div>
                        <div class="form-group">
                            <label>Student PanCard</label>
                            <!-- for pan -->
                            <input name="pancard" id="pancard" type="file" class="form-control">
                            <!-- for pan -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-dark" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" onclick="editStudent()" value="Save">
                    </div>
                </div>
            </div>
        </div>
        <!--End Edit Modal HTML -->

        <!-- Start View Modal HTML -->
        <div id="viewStudentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">View Student</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body view_student">
                        <div class="form-group">
                            <label>Student Name</label>
                            <input type="text" id="name_input" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Student Mobile</label>
                            <input type="text" id="mobile_input" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Student Email</label>
                            <input type="email" id="email_input" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-success" data-dismiss="modal" value="Close">
                    </div>
                </div>
            </div>
        </div>
        <!-- End View Modal HTML  -->

        <!--Start Delete Modal HTML  -->
        <div id="deleteStudentModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Student</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <input type="hidden" id="delete_id">
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" onclick="deleteStudent()" value="Delete">
                    </div>
                </div>
            </div>
        </div>
        <!--End Delete Modal HTML  -->

        <!--Start MARKS Modal   -->
        <div id="addStudentMarksModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Marks</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body add_marks">
                        <div class="form-group">
                            <label>English</label>
                            <input type="text" id="Emarks" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Hindi</label>
                            <input type="text" id="Hmarks" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Math</label>
                            <input type="text" id="Mmarks" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Science</label>
                            <input type="text" id="Smarks" class="form-control" required>
                            <input type="hidden" id="student_id" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-dark" data-dismiss="modal" value="Close">
                        <input type="submit" class="btn btn-success" value="Add" onclick="addStudentMarks()">
                    </div>
                </div>
            </div>
        </div>
        <!--End MARKS Modal   -->

        <!-- start script  -->
        <script>
            var img_Aadhar_Card_Front_Base64;
            var img_Aadhar_Card_Back_Base64;
            var imgPancard_Base64;
            var fileSize;
            var maxfileSize=300;
            var select;
            var idDoc;
            $(document).ready(function () {
                studentList();
                studentfileList();
                $('input[type = file][name = adhar_card_front]').change(function() {
                    // alert("11");
                    fileSize = this.files[0].size / 1024;
                    // alert(121);
                    if (!checkImage(this.files[0].name)) {
                        // alert(12);
                        alert(this.files[0].name + " :- Is Not Valid Image..");
                        $(this).val('');
                        img_Aadhar_Card_Front_Base64 = "";
                        $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                    } else if (fileSize > maxfileSize) {
                        // alert(123);
                        alert("File size should be less than or equal to " + maxfileSize + " kb.");
                        $(this).val('');
                        img_Aadhar_Card_Front_Base64 = "";
                    } else {
                        // alert("1234");
                        readURLFront(this);
                    }
                });


                $("select.selectVal").change(function() {
                     select = $(this).children("option:selected").val();
                    //  alert("You have selected the name - " + selectedItem);
                 });

                $('input[type = file][name = adhar_card_back]').change(function() {
                    // alert(11);
                    fileSize = this.files[0].size / 1024;
                    if (!checkImage(this.files[0].name)) {
                        // alert(12);
                        alert(this.files[0].name + " :- Is Not Valid Image..");
                        $(this).val('');
                        img_Aadhar_Card_Back_Base64 = "";
                        $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                    } else if (fileSize > maxfileSize) {
                        // alert(123);
                        alert("File size should be less than or equal to " + maxfileSize + " kb.");
                        $(this).val('');
                        img_Aadhar_Card_Back_Base64 = "";
                    } else {
                        // alert(1234);
                        readURLBack(this);
                    }
                });

                $('input[type = file][name = pancard]').change(function() {
                    // alert(11);
                    // alert(this.files[0].name);
                    fileSize = this.files[0].size / 1024;
                    if (!checkImage(this.files[0].name)) {
                        // alert(12);
                        alert(this.files[0].name + " :- Is Not Valid Image..");
                        $(this).val('');
                        imgPancard_Base64 = "";
                        $('#bteimgPreview').attr('src', "./images/userprofile.jpg");
                    } else if (fileSize > maxfileSize) {
                        // alert(123);
                        alert("File size should be less than or equal to " + maxfileSize + " kb.");
                        $(this).val('');
                        imgPancard_Base64 = "";
                    } else {
                        // alert(1234);
                        readURLPanCard(this);
                    }
                });
            })

            function checkImage(fileName) {
                var extension = ["png", "gif", "jpeg", "jpg"];
                var n = fileName.substring(fileName.lastIndexOf(".") + 1);
                var name = fileName;
                return extension.includes(n.toLowerCase());
            }
           
            function readURLFront(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        img_Aadhar_Card_Front_Base64= e.target.result;
                        // $('#bteimgPreview') .attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function readURLBack(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        img_Aadhar_Card_Back_Base64 = e.target.result;
                        // $('#bteimgPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function readURLPanCard(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgPancard_Base64 = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        imgPancard_Base64 = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            //   validation date
            function isValidDate(date) {
                var dateRegex = /^\d{4}-\d{2}-\d{2}$/;
                if (!dateRegex.test(date)) return false;
                var dateObject = new Date(date);
                if (isNaN(dateObject.getTime())) return false;
                return true;
            }
            function validation() {
                var fdate = document.getElementById("fdate").value
                var tdate = document.getElementById("tdate").value
                let to = new Boolean(false);
                let from = new Boolean(false);
                to = isValidDate(fdate);
                from = isValidDate(tdate);
                if ((fdate > tdate) || (to == false || from == false)) {
                    document.getElementById("ename").innerHTML = "From date should be smaller";
                    return false;
                }
                else {
                    document.getElementById("ename").innerHTML = "";
                    $('#report-model').modal('hide');
                    return true
                }
            }
            //   validation date
            
            // student file list 
            function studentfileList() {
                var action='studentDocList';
                $.ajax({
                    type: 'get',
                    url: "CLASSES/StudentDataController.php",
                    data:{action : action},
                    success: function (data) {
                        var response = JSON.parse(data);
                        // console.log(response);
                        var tr = '';
                        var Aadharfront;
                        var Aadharback;
                        var Pancard;
                        for (var i = 0; i < response.length; i++) {
                            var sid = response[i].Sid;
                            var adharfront = response[i].adharFront;
                            var adharback = response[i].adharBack;
                            var pancard = response[i].panCard;
                                if(adharfront==""||adharfront==null)
                                    Aadharfront="-";
                                else
                                    Aadharfront="Download";
                                if(adharback==""||adharback==null)
                                    Aadharback="-";
                                else
                                    Aadharback="Download";
                                if(pancard==""||pancard==null)
                                    Pancard="-";
                                else
                                    Pancard="Download";
                            tr += '<tr>';
                            tr += '<td>' + sid + '</td>';
                            tr += '<td><a href="' + adharfront + '" download>'+Aadharfront+'</a></td>';
                            tr += '<td><a href="' + adharback + '" download>'+Aadharback+'</a></td>';
                            tr += '<td><a href="' + pancard + '" download>'+Pancard+'</a></td>';
                            tr += '<td>  <button type="button" onclick=viewStudent("' +
                                sid +
                                '") class="btn btn-success" data-toggle="modal" data-target="#view-document">'
                                    +'ViewDoc'+'</button></td>';
                            tr += '</tr>';
                        }
                        $('#student_file_data').html(tr);
                    }
                });
            }
            // student file list 

            // student detail list 
            function studentList() {
                var action = "studentList";
                $.ajax({
                    type: 'get',
                    data: { action: action },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        var tr = '';
                        for (var i = 0; i < response.length; i++) {
                            var id = response[i].id;
                            var name = response[i].name;
                            var mobile = response[i].mobile;
                            var email = response[i].email;
                            var grad = response[i].S_grad;
                            var time = response[i].entryDateTime;
                            var etime=dateFormate(time);
                                if(grad==""||grad==null)
                                    grad="-";
                            tr += '<tr>';
                            tr += '<td>' + id + '</td>';
                            tr += '<td>' + name + '</td>';
                            tr += '<td>' + mobile + '</td>';
                            tr += '<td>' + email + '</td>'
                            tr += '<td>' + etime + '</td>';
                            tr += '<td>' + grad + '</td>';
                            tr += '<td>' + '<a href="#addStudentMarksModal" onclick=viewStudent("' +
                                id +
                                '") class="m-1 delete btn btn-primary" data-toggle="modal" onclick=$("#delete_id").val("' +
                                id + '">MARKS</a>' + '</td>';

                            tr += '<td><div class="d-flex">';
                            tr +=
                                '<a href="#editStudentModal" class="m-1 edit btn btn-success " data-toggle="modal" onclick=viewStudent("' +
                                id +
                                '")>UPDATE</a>';
                            tr +=
                                '<a href="#deleteStudentModal" class="m-1 delete btn btn-danger" data-toggle="modal" onclick=$("#delete_id").val("' + id +
                                '")>DELETE</a>';
                            tr += '</div></td>';
                            tr += '</tr>';
                        }
                        $('#student_data').html(tr);
                        studentfileList();
                    }
                });
            }
             
            function dateFormate(date){
                 var dateObj = new Date(date);
                 var day = dateObj.getDate();
                 console.log(day);
                 var month = dateObj.getMonth()+1;
                 var year = dateObj.getFullYear();
                //  var hour = dateObj.getHours();
                //  var min = dateObj.getMinuts();
                //  var sec = dateObj.getSecond();
                var time = dateObj.toLocaleTimeString();
                 return day + '-' + month + '-' + year+' '+time;
            }

            function addStudentMarks() {
                var english = $('#Emarks').val();
                var hindi = $('#Hmarks').val();
                var math = $('#Mmarks').val();
                var science = $('#Smarks').val();
                var student_id = $('.add_marks #student_id').val();
                var action = 'addStudentMark';
                console.log(english);
                $.ajax({
                    type: 'post',
                    data: {
                        action: action,
                        e_marks: english,
                        h_marks: hindi,
                        m_marks: math,
                        s_marks: science,
                        student_id: student_id
                    },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        // alert(response);
                        $('#addStudentMarksModal').modal('hide');
                        studentList();
                        studentfileList();
                        alert(response.message);
                    }
                })
            }


            function addStudent() {
                // alert(img_Aadhar_Card_Back_Base64);
                // alert(img_Aadhar_Card_Front_Base64);
                //  alert(imgPancard_Base64);
                var name = $('.add_student #name_input').val();
                var mobile = $('.add_student #mobile_input').val();
                var email = $('.add_student #email_input').val();
                var action = 'addStudent';
                $.ajax({
                    type: 'post',
                    data: {
                        action: action,
                        name: name,
                        mobile: mobile,
                        email: email,
                        img1:img_Aadhar_Card_Back_Base64,
                        img2:img_Aadhar_Card_Front_Base64,
                        img3:imgPancard_Base64
                    },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        alert(response.message);
                        studentList();
                        $('#addStudentModal').modal('hide');

                    }
                })
           }


            function checkImage(fileName) {
                var extension = ["png", "gif", "jpeg", "jpg"];
                var n = fileName.substring(fileName.lastIndexOf(".") + 1);
                var name = fileName;
                return extension.includes(n.toLowerCase());
            }

            function editStudent() {
                var name = $('.edit_student #name_input').val();
                var mobile = $('.edit_student #mobile_input').val();
                var email = $('.edit_student #email_input').val();
                var student_id = $('.edit_student #student_id').val();
                var action = "updateStudentData";
                $.ajax({
                    type: 'post',
                    data: {
                        action: action,
                        name: name,
                        mobile: mobile,
                        email: email,
                        student_id: student_id,
                        img1:img_Aadhar_Card_Back_Base64,
                        img2:img_Aadhar_Card_Front_Base64,
                        img3:imgPancard_Base64
                    },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        $('#editStudentModal').modal('hide');
                        studentList();
                        studentfileList();
                        alert(response.message);
                    }

                })
            }

            function viewStudent(id) {
                var action = "viewStudentData";
                // alert(id);
                idDoc=id;
                $.ajax({
                    type: 'get',
                    data: {
                        action: action,
                        id: id,
                    },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        $('.edit_student #name_input').val(response.name);
                        $('.edit_student #mobile_input').val(response.mobile);
                        $('.edit_student #email_input').val(response.email);
                        $('.edit_student #student_id').val(response.id);
                        $('.add_marks #student_id').val(response.id);
                      
                        
                        $('.view_student #name_input').val(response.name);
                        $('.view_student #mobile_input').val(response.mobile);
                        $('.view_student #email_input').val(response.email);
                    }
                })
            }
        
            function deleteStudent() {
                var id = $('#delete_id').val();
                var action = "deleteStudentData";
                $('#deleteStudentModal').modal('hide');
                $.ajax({
                    type: 'get',
                    data: {
                        action: action,
                        id: id
                    },
                    url: "CLASSES/StudentDataController.php",
                    success: function (data) {
                        var response = JSON.parse(data);
                        alert(response.message);
                        studentList();
                        studentfileList();
                    }
                 })
            }

            function viewDoc(){
                var document;
                var action = 'viewDocument';

                if(select=='AadharFront'){
                //    alert('hi Af');
                   document='adharFront';
                }
                else if(select=='AadharBack'){
                //    alert('hi AB');
                   document='adharBack';
                }else if(select=='PanCard'){
                //    alert('hi pan');
                   document='panCard';                       
                }
                else{
                    alert("sorry choose proper document");
                }

                $.ajax({
                       type:'get',
                       data:{
                        action : action,
                        id:idDoc,
                        document:document
                       },
                       url : "CLASSES/StudentDataController.php",
                       success :function(data){
                        $('#view-document').modal('hide');
                        var response = JSON.parse(data);
                        var img = Object.values(response)[0];
                        //   alert(data);
                          $('#image').html('<img src="' + img  + '" style="width:500px; height:-webkit-fill-available;"/>');
                       }
                })
  
            }
                
        </script>
</body>
</html>