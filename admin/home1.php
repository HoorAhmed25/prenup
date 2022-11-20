<?php session_start();if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: ../index.php");
    die();
} else{ include '../connection.php'; ?><html dir="rtl">
   <head>
       <title>وزارة الصحة و السكان - مبادرة فحوصات ما قبل الزواج</title>
       <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/all.min.css">
      <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
	   <link rel="preconnect" href="https://fonts.gstatic.com">
       <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

	   <style>
		   p{
			   font-size: 27px;
			   font-weight: 400;
		   }
                   .previous{
    
	margin-top: 25px;
	cursor: pointer;
	background-color: white;
	height: 200px;
	padding-top: 50px;
	border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
	box-shadow: 1px 2px #888888;
}
.previous:hover{
	cursor: pointer;
	background-color: white;
	height: 200px;
	padding-top: 50px;
	border-top-right-radius: 20px;
    border-top-right-radius: 20px;
    border-bottom-left-radius: 20px;
	box-shadow: 3px 4px 3px 4px #888888;
    transition: 0.5s;
}
           nav{
   background-image: linear-gradient(to right, #000428, #004e92);
    text-align: right;
    padding-right: 30px;
    width: 100%;
    height: 80px;
}
           footer{
    background-image: linear-gradient(to right, #000428, #004e92);  
    text-align: center;
    width: 100%;
    height: 60px;
    color: white;
    padding-top: 20px;
    font-size: 22px; !important
    font-weight: 500;
     bottom: 0px;
    left: 0px;
    right: 0px;
    margin-bottom: 0px;
}
           .nav-item a{
               color: black;
               text-decoration: none;
               text-align: right;
               font-size: 16px;
           }
	   </style>
    </head>
    <body style="overflow-x:hidden;">
       <nav>
    <div class="row">
    <div class="col-1"><img src="../img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid"
                    style="height:75px;  margin-top:5px;" /></div>
            <div class="col-2">
             <h6 class="text-white d-inline" style=" font-weight: bold;">
                  <br>جمهورية مصر العربية
                 <br>وزارة الصحة و السكان
              
                </h6>
            </div>
      
      <div class="dropdown show d-inline h3 col-4">
        <a class="h4 dropdown-toggle float-left ml-4 mt-4 text-white" href="#" role="button" id="dropdownMenuLink"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['unit']; ?>
        </a>
         <div class="dropdown-menu float-left" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
<ul class="nav nav-tabs pt-3">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">الرئيسية</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" id="reports">التقارير</a>
    <ul class="dropdown-menu" aria-labelledby="reports">
      <li><a class="dropdown-item" href="bmi.php">تقرير نسب السمنة بين المتقدمين</a></li>
      <li><a class="dropdown-item" href="illnesses.php">تقرير نسبة الامراض المعدية بين المتقدمين </a></li>
      <li><a class="dropdown-item" href="diabetes.php">تقرير نسبة مرضى السكري بين المتقدمين</a></li>
     <li><a class="dropdown-item" href="anemia.php">تقرير نسب الانيميا بين المتقدمين</a></li>
      <li><a class="dropdown-item" href="rh.php">تقرير معامل ريساس RH factor </a></li>
      <li><a class="dropdown-item" href="#">تقرير فصائل الدم للمتقدمين </a></li>
   <li><a class="dropdown-item" href="users.php">تقرير أداء المستخدمين</a></li>
    </ul>
  </li>

              <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" id="setting">الإعدادات العامة</a>
    <ul class="dropdown-menu" aria-labelledby="setting">
      <li><a class="dropdown-item" href="admin.php">إضافة مستخدم جديد</a></li>
    </ul>
  </li>
 
</ul>
        
         <div class="mr-5 ml-5 mt-5 mb-5 pb-5" style="background-color: #eee;" >

</div>
        
        
        
        
        
        
        
        
        
        
        
        
		
        <footer style="position:fixed;">
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>

        
          <script src="../js/jquery-3.3.1.min.js"></script> 
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
    </body>
</html>
<?php
      }
?>