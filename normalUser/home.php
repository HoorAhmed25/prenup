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
       <link rel="stylesheet" href="../css/style.css">
       <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
	   <style>
            @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body{
            font-family: 'Cairo', sans-serif; !important
        }
		   p{
			   font-size: 24px;
			   font-weight: 400;
		   }
	   </style>
    </head>
    <body>
      <nav>
    <div class="row">
    <div class="col-1"><img src="../img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid"
                    style="height:85px;  margin-top:10px;" /></div>
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
                    <a class="dropdown-item border-bottom text-center" href="form.php">تسجيل جديد</a>
                    <a class="dropdown-item border-bottom text-center" href="search.php">بحث</a>
             <a class="dropdown-item border-bottom text-center" href="editPass.php">تغيير كلمة المرور</a>
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
        
    
        
        
      <div class="container mt-3" style="background-color: #eeeeee; height: 500px;" >
          <h2 class="heading text-center pt-4" style="font-family: Cairo;">مبادرة السيد رئيس الجمهورية</h2>
          <h3 class="heading text-center pt-1">لفحص ما قبل الزواج</h3>
          
		  <div class="row">
              <div class="col-1"></div>
			   <div onclick="location.href='form.php'" class="new col-3">
	   <p class="text-center"><i class="fas fa-female"></i><i class="fas fa-male"></i> </p>
		  <p class="text-center">تسجيل جديد</p>
		  
		  </div>
		
			  <div class="col-1"></div>
   <div onclick="location.href='search.php'" class="previous col-3 ">
		  <p class="text-center"><i class="fas fa-users"></i></p>
		  <p class="text-center">بحث عن تسجيل سابق</p>
		  </div>
              <div class="col-1"></div>
			  </div>
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
      }?>