<?php require_once 'connection.php';  session_start(); ?><html>

<head>
    <title>وزارة الصحة و السكان - مبادرة فحوصات ما قبل الزواج</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
body{
     font-family: 'Cairo',sans-serif; !important
    }
    
    </style>
   
</head>

<body style="background-color:#eeeeee; overflow-x: hidden; overflow-y:scroll;">
    <nav>
        <div class="row">
            <div class="col-4 pt-1"><img src="img/100million.png" class="img-fluid" style="height:80px;" /></div>
            <div class="col-3"></div>
            <div class="col-4">
                <h6 class="text-white d-inline" style=" font-weight: bold;"><br>جمهورية مصر العربية <br>وزارة الصحة و
                    السكان </h6>
            </div>
            
            
            
            <div class="col-1"><img src="img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid"
                    style="height:85px;  margin-top:10px;" /></div>
        </div>
    </nav>
    <form method="post" action="">
    <div class="container mt-5 mb-5 text-center">
    <h3>ادخل اخر اربعة ارقام من رقم الوثيقة</h3>
    <div class="row text-center mt-4 mb-3">
        <div class="col-3 col-md-4"></div>
<div class="col-2 col-md-1 text-center"><input id="in1" name="4" type="text" class="form-control text-center" maxlength="1" onkeypress="return isNumberKey(event)" autocomplete="off" required onkeyup="next1();"></div>
        <div class="col-2  col-md-1 text-center"><input id="in2" name="3" type="text" class="form-control text-center" maxlength="1" onkeypress="return isNumberKey(event)" autocomplete="off" required onkeyup="next2();"></div>
        <div class="col-2 col-md-1 text-center"><input id="in3" name="2" type="text" class="form-control text-center" maxlength="1" onkeypress="return isNumberKey(event)" autocomplete="off" required onkeyup="next3();"></div>
        <div class="col-2 col-md-1 text-center"><input id="in4" name="1" type="text" class="form-control text-center" maxlength="1" onkeypress="return isNumberKey(event)" autocomplete="off" required onkeyup="next4();"></div>
        </div>
    <button class="btn btn-lg text-white loginButton" id="in5" type="submit" name="login">Enter</button>
    </div>
    </form>
    <?php
    if(isset($_POST['login'])){
        $NID = $_POST['4'].$_POST['3'].$_POST['2'].$_POST['1'];
         $ins="SELECT * FROM users WHERE serial like '2022_____$NID'";
        $query=mysqli_query($conn, $ins) or die("error:".mysqli_error($conn));
        $result=mysqli_fetch_array($query);
        if(mysqli_num_rows($query)==1) {
            $_SESSION['NID'] = $result['nationalId'];
            $_SESSION['FNID'] = $result['FnationalId'];
             echo '<script type="text/javascript">';
                echo'window.location.href="qrCode.php";';
                echo '</script>';
        }
        else{
            echo "لا يوجد بيانات";
        }
    }
    
    
    ?>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <script src="js/mine.js"></script>
    <script>
        window.onload = function() {
  document.getElementById("in1").focus();
}
    function next1(){
        $in1 = document.getElementById("in1").value;
        console.log ($in1.length);
       if($in1.length == 1){
           document.getElementById("in2").focus();
       }
    }
     function next2(){
        $in2 = document.getElementById("in2").value;
        console.log ($in2.length);
       if($in2.length == 1){
           document.getElementById("in3").focus();
       }
    } 
    function next3(){
        $in3 = document.getElementById("in3").value;
        console.log ($in3.length);
       if($in3.length == 1){
           document.getElementById("in4").focus();
       }
    }
         function next4(){
        $in4 = document.getElementById("in4").value;
        console.log ($in4.length);
       if($in4.length == 1){
           document.getElementById("in5").focus();
       }
    }
    </script>
</body>

</html>