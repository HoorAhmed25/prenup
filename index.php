<?php  session_start(); ?><html dir="rtl">

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
       <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body{
            font-family: 'Cairo', sans-serif; !important
        }
    .leftD {
        width: 25%;
    }

    .rightD {
        width: 30%
    }

    .centerD {
        width: 45%;
    }

    @media screen and (max-width: 1000px) {

        .leftD,
        .mainD,
        .rightD {
            width: 80%;
            /* The width is 100%, when the viewport is 800px or smaller */
        }
    }

    /* Use a media query to add a break point at 800px: */
    @media screen and (max-width: 800px) {

        .leftD,
        .mainD,
        .rightD {
            width: 100%;
            /* The width is 100%, when the viewport is 800px or smaller */
        }
    }
    </style>
</head>

<body style="background-color:#eeeeee; overflow-x: hidden; overflow-y:scroll;">
    <nav>
        <div class="row">
            <div class="col-1"><img src="img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid"
                    style="height:85px;  margin-top:10px;" /></div>
            <div class="col-2">
                <h6 class="text-white d-inline" style=" font-weight: bold;"><br>جمهورية مصر العربية <br>وزارة الصحة و
                    السكان </h6>
            </div>
            <div class="col-5"></div>
            <div class="col-4 pt-1"><img src="img/100million.png" class="img-fluid" style="height:80px;" /></div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="leftD" style=" padding-top:90px;"><img src="img/sisi.png" style="width:430px; height:420px;">
            </div>
            <div class="container centerD">
                <div class="card-body container WOW fadeIn text-center" style="padding-top:50px; width:400px;">
                    <h2>تسجيل دخول</h2>
                    <form name="login" action="" method="POST">
                        <div class="form-group pt-3"><input name="username" type="text" class="form-control"
                                placeholder="اسم المستخدم" required><br><input name="password" type="password"
                                class="form-control" placeholder="**********" required><br><button
                                class="btn btn-lg text-white loginButton" type="submit" name="login">دخول</button></div>
                    </form>
                </div>
            </div>
            <div class="rightD"><img class="img-fluid" src="img/m.png" style="padding-top:120px;"><br>
                <div style="border:3px #00204f solid; border-radius:10px;">
                    <p class="text-center font-weight-bold" style="font-size:25px;">مبادرة السيد رئيس الجمهورية <br>لفحص
                        ما قبل الزواج</p>
                </div>
            </div>
        </div>
    </div><?php require_once 'connection.php';

    if(isset($_POST['login'])) {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $ins="SELECT * FROM admins WHERE username = '$username' AND password = '$password' And activation = '1' limit 1";
        $query=mysqli_query($conn, $ins) or die("error:".mysqli_error($conn));
        $result=mysqli_fetch_array($query);
        $permission=$result['permission'];
        $_SESSION['username']=$username;
        $_SESSION['unit']=$result['unit'];
        $_SESSION['governorate']=$result['governorate'];
        $_SESSION['qism']=$result['qism'];
        $_SESSION['userLogin']="Loggedin";

        if(mysqli_num_rows($query)==1) {

            if($permission==1) {

                echo '<script type="text/javascript">';
                echo'window.location.href="admin/home.php";';
                echo '</script>';
            }

            elseif($permission==2) {

                echo '<script type="text/javascript">';
                echo'window.location.href="normalUser/home.php";';
                echo '</script>';
            }

            elseif($permission==3) {

               echo '<script type="text/javascript">';echo'window.location.href="admin/dashboard.php";';echo '</script>';
            }
              
  elseif($permission==4) {

               echo '<script type="text/javascript">';echo'window.location.href="print/search.php";';echo '</script>';
            }
        }

        else {
            echo "<script type='text/javascript'>alert('تأكد من صلاحية دخولك للموقع');</script>";

        }

    }


    ?><footer style="background-image: linear-gradient(to right, #000428, #004e92); position:fixed;">
        <p style="font-size:19px;">&copy;
            2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
    </footer>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <script src="js/mine.js"></script>
</body>

</html>