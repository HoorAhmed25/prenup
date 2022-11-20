<?php session_start (); include '../connection.php'; ?><html dir="rtl">
   <head>
       <title>وزارة الصحة و السكان - مبادرة فحوصات ما قبل الزواج</title>
       <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/all.min.css">
      <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
       <link rel="stylesheet" href="../css/style.css">
       <link rel="preconnect" href="https://fonts.gstatic.com">
<style>
          @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
body{
     font-family: 'Cairo',sans-serif; !important
    }
       
       </style>
    </head>
    
    <body style="color:black; background-color:#eeeeee;">
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
                    <a class="dropdown-item border-bottom text-center" href="home.php">الرئيسية</a>
                    <a class="dropdown-item border-bottom text-center" href="form.php">تسجيل جديد</a>
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
        <div class="title text-center text-dark border-bottom mb-3" style="background-color:white; border-bottom:solid 2px black;">
        <h3 class="heading">طباعة استمارة مسجلة</h3>
        <p>أدخل جميع البيانات المطلوبة في الحقول المميزة بالعلامة (*) </p>

            </div>
        <form name="search-form" action="print.php" method="post">
        <div class="search text-right" style="margin-right:40%; padding-top:50px;">
        
        <div class="form-check col-6">
                <label class="form-check-label pt-2 pl-2">الجنسية* : </label>
               <input onchange="foreignerCheck1()" type="radio" name="nationality" id="egyptian" value="مصرى" checked >
                <label class="ml-3"  for="egyptian"> مصرى </label>
                            
              <input onclick="foreignerCheck1()" type="radio" name="nationality" id="foreigner" value="غير مصرى">
             <label for="foreigner">غير مصرى </label>
            </div>
            <div id="enational" class="mb-3 col-6">
    <label for="nationalId" class="form-label">الرقم القومى* :</label>
    <input type="text" class="form-control w-75" name="nationalId" id="nationalId" onchange="validationID()" onkeypress="return isNumberKey(event)" maxlength="14" autocomplete="off" onkeyup="check();">
                   <p id="idError" style="display:none;">*خطأ فى الرقم القومى</p>
  </div> 
          <div id="fnational" class="mb-3 col-6" style="display:none;">
    <label for="FnationalId" class="form-label">رقم جواز السفر* :</label>
    <input type="text" class="form-control w-75" name="FnationalId" id="FnationalId" onkeypress="return isNumberKey(event)" maxlength="15" autocomplete="off" onkeyup="checkF();">
  </div>
            <button class="btn btn-lg text-white searchbutton" type="submit" name="search" id="search" disabled>بحث</button>
         <button class="btn btn-lg text-white backButton" type="button" name="back" style="margin-left:500px;">
           <a href="home.php">رجوع</a></button>
        </div>
        </form>
      <footer style="position:fixed;"><p> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p></footer>

        
        <script>
        function foreignerCheck1(){
    
    if(document.getElementById("egyptian").checked){
        console.log("egypt");
       document.getElementById("enational").style.display = "block";
        document.getElementById("fnational").style.display = "none";
        
    }
    else{
        console.log("not");
    document.getElementById("enational").style.display = "none";
       document.getElementById("fnational").style.display = "block";
        
    }
}
        function check(){
            var NID = document.getElementById("nationalId").value;
           var FNID = document.getElementById("FnationalId").value;
            
            if(document.getElementById("egyptian").checked){
                console.log("egypt")
               
                if(NID.length != 14){
                    console.log(NID);
                    document.getElementById("search").disabled = true;
                }
                else{
                  document.getElementById("search").disabled = false;  
                }
            }  
        }
        function checkF(){
            
           var FNID = document.getElementById("FnationalId").value;
            
            if(document.getElementById("foreigner").checked){
                console.log("foreigner")
               
                if(FNID.length == 0){
                    console.log(FNID);
                    document.getElementById("search").disabled = true;
                }
                else{
                  document.getElementById("search").disabled = false;  
                }
            }  
        } 
        
        
        </script>
        
        
        
        <script src="../js/jquery-3.3.1.min.js"></script> 
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
    </body>
</html>
		
		