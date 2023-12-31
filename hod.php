<?php session_start();
include('shared/connection.php');
if(!isset($_SESSION['name_of_hod'])){
    header("location:hod_login.php");
}
?>

<?php
include('shared/connection.php');
?>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,maximum-scale=1.0, minimum-scale=1.0, initial-scale=1.0"/>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css">
    <script src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/bootstrap.js"></script>
    <script src="bootstrap-sweetalert-master/dist/sweetalert.js"></script>
    <script src="bootstrap-sweetalert-master/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="bootstrap-sweetalert-master/dist/sweetalert.css">
    <link rel="icon" href="images/icon.ico">

    <title>  BSU Student Clearance SYSTEM | Welcome </title>
</head>
<header id="main-header">
    <div class="container">
        <img src="images/logo.png">
        <h1 style="font-size:40px; color: orange"> K.T.U Student Clearance Portal</h1>
    </div>
</header>

<nav id="navbar">
    <div class="container">
        <ul>
            <li><a href="hod.php"><img src="images/icons/icons8_High_Importance_48px.png">REQUESTS</a></li>
            <li><a href="#"><img src="images/icons/icons8_Password_48px.png">CHANGE PASSWORD </a></li>
            <li><a href="hod_logout.php"><img src="images/icons/icons8_Sign_Out_48px.png">LOGOUT</a></li>

        </ul>
    </div>
</nav>

<section id="newsletter">
    <div class="container">
        <div id="div">
            <script src="jquery-3.2.1.min.js"></script>
            <script>
                $(function(){
                    //Approve button
                    $(".approve").click(function(){
                        var userid = $(this).closest("tr").find(".idx").val();
                        var approve = "approve";
                        $.ajax({
                            type:"post",
                            url:"operations/hod_operation.php",
                            data:{userid:userid,approve:approve},
                            success:function(result){
                                swal("",(result),"success");
                                setTimeout(function () {
                                    window.location.href = "hod.php";
                                },2000);
                            }
                        });
                    });
                });
            </script>
            </head>
            <body>

            <h2>Welcome</h2>
            <div id="profile">
                <h2 id="user"> <?php echo $_SESSION['name_of_hod'];
                    $name_of_hod=$_SESSION['name_of_hod'];
                    ?></h2>
                <div class="input-group">
                    <button type="submit" id="prt" class="btn" name="submit" onclick="print();">
                        <img src="images/icons/icons8_Print_48px.png">
                    </button>
                </div>
                <body>
                <?php
                $sql="  SELECT student.id, student.index_no,student.hod_request, student.first_name, 
            student.last_name, student.department_id, tbl_hod.department_id,tbl_hod.name_of_hod,
			student.faculty_id,faculty.faculty_name, 
			department.department_name FROM
			student INNER JOIN department ON
			student.department_id=department.department_id
			INNER JOIN faculty ON student.faculty_id=faculty.faculty_id
			INNER JOIN tbl_hod ON student.department_id=tbl_hod.department_id
            WHERE tbl_hod.name_of_hod='$name_of_hod' and student.hod_request=1";
                $records=mysqli_query($con,$sql);
                ?>
                <?php include('shared/bootstrap.php'); ?>
                <table class="table" cellpadding="5" cellspacing="8">
                    <tr>
                        <th> Index No</th>
                        <th> First Name</th>
                        <th> Last Name </th>
                        <th> Department </th>
                        <th> Faculty</th>
                        <th> Status </th>
                        <th> Action </th>
                    </tr>
                    <?php
                    while($employee=mysqli_fetch_assoc($records)){
                        $index = $employee['id'];
                        echo "<tr>";
                        echo "<td>".$employee['index_no']."</td>";
                        echo "<td>".$employee['first_name']."</td>";
                        echo "<td>".$employee['last_name']."</td>";
                        echo "<td>".$employee['department_name']."</td>";
                        echo "<td>".$employee['faculty_name']."</td>";
                        $query="SELECT student.id,student.index_no,student.hod_request,clearance.is_hod_approved
                        FROM student INNER JOIN clearance on student.id=clearance.id WHERE clearance.id='$index' and 
                        is_hod_approved=1
                        GROUP BY student.id";
                        $query2=mysqli_query($con,$query);
                        $fetch=mysqli_fetch_assoc($query2);
                        if($fetch['is_hod_approved']==1){
                            echo "<td>"."<h4 style='color:green;'>Cleared</h4>"."</td>"." ";
                        }
                        elseif($fetch['is_hod_approved']==0){
                            echo "<td>"."<h4 style='color:red;'>Not Yet Cleared</h4>"."</td>"." ";
                        }
                        elseif($fetch['is_hod_approved']==NULL) {
                            echo "<td>"."<h4 style='color:red;'> Project Work Not Complete</h4>"."</td>"." ";
                        }

                        echo "<td>".
                            "<button type='button' name='approve' id='approve' class='approve'> Approve 
			</button>";

                        ?>
                        <input type="hidden" name="text" class= "idx" value="<?php echo $index;?>">
                        <?php

                        "</td>";
                        echo "</tr>";



                    }


                    ?>


                </table>
            </div>

        <style>
            .request{
                padding: 7px;
                font-size: 15px;
                color: white;
                background:green;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }
            #approve{
                padding: 7px;
                font-size: 15px;
                color: white;
                background:green;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }
            #hod{
                padding: 7px;
                font-size: 15px;
                color: white;
                background:green;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }
            #depart{
                padding: 7px;
                font-size: 15px;
                color: white;
                background:green;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }
            #supervisor{
                padding: 7px;
                font-size: 15px;
                color: white;
                background:green;
                border: none;
                border-radius: 5px;
                cursor:pointer;
            }

            #prt{
                position:relative;
                left:80%;
                background:white;
                color:white;
            }
            .approve:hover{
                background: black;
            }
            .unapprove:hover{
                background: black;
            }
            #user{
                color:blue;
            }
        </style>
        <style>
            body{
                background:white;
                color:#555;
                font-family:Arial, Helvetica,sans-serif;
                font-size:16px;
                line-height:1.6em;
                margin:0;
            }

            .container{
                width:80%;
                margin:auto;
                overflow:hidden
            }
            #main-header{
                background-color: rgb(7,133,191);
                color:#fff;
            }
            #navbar{
                background-color: white;
                color:#fff;
            }
            #navbar ul{
                padding:0;
                list-style: none;
            }
            #navbar li{
                display:inline;
            }
            #navbar a{
                color: black;
                text-decoration: none;
                font-size:18px;
                padding:5px;
            }

            #navbar a:hover{
                background-color: #ff2fb3;


            }
            #showcase {
                background-color: rgba(224, 230, 255, 0.89);
                min-height:380px;



            }
            #showcase p{
                color: #010101;
                line-height:2em;
                font-size: 22px;
                padding-top: 80px;
            }


            #main-footer{
                background: rgb(7,133,191);
                color:#fff;
                text-align: center;
                padding:20px;
                margin-top:0px;
            }
            @media(max-width:600px){
                #main{
                    width:100%;
                    float:none;
                }


            }
        </style>
    </div>
</body>
</html>
