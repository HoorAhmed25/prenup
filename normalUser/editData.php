<?php session_start();if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: ../index.php");
    die();
} else{include '../connection.php';?><html dir="rtl">

<head>
    <title>وزارة الصحة و السكان - مبادرة فحوصات ما قبل الزواج</title>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.gstatic.com">
     <script src="../js/jquery-3.3.1.min.js"></script>
      <style>
              @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
body{
     font-family: 'Cairo',sans-serif; !important
    }
        label{
            font-size: 18px; !important
        }
    
    
    </style>
      <script>
  $(document).ready(function() {
    $('#nationalId').on('change', function() {
      var nationalId = $(this).val();
      if (nationalId) {
        $.get(
          "fetch.php", {
            nationalId: nationalId
          },
          function(data) {

            $('#result').html(data);

          });

      }

    });

  });
  </script>

</head>

<body style="color:black;">
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
                    <a class="dropdown-item border-bottom text-center" href="search.php">بحث</a>
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
    <div class="title text-center text-dark border-bottom mb-3">
        <h2 class="heading">استمارة فحص ما قبل الزواج</h2>
    </div>
    <section class="container" id="result">
        <h4 class="container-fluid headOfPersonal mb-0 pb-0">البيانات الأساسية
          
        </h4>

        
            <?php 
       if(isset($_POST['edit'])){
           $serial = $_POST['serial'];
         $user = "SELECT * FROM users WHERE serial = '$serial' ORDER BY date DESC limit 1";
       $query = mysqli_query( $conn,$user) or die('error:'.mysqli_error($conn));
       $result = mysqli_fetch_array($query);
       $count= mysqli_num_rows($query);
          if($count > 0){
                 
              
       do{
       
       ?>
        <form name="Info" method="post" action="edit.php">
            <section>
<input type="text" style="display:none;" value="<?php echo $_SESSION['unit']; ?>" name="location" id="location">
       <input type="text" style="display:none;"  value="<?php echo $_SESSION['governorate']; ?>" name="gov" id="gov">
       <input type="text" style="display:none;"  value="<?php echo $_SESSION['qism']; ?>" name="qism" id="qism">  
        <input type="text" style="display:none;"  value="<?php echo  $serial; ?>" name="serial" id="serial">       
                
                <div id="form-container" class="container">
                    <h3 id="warn" style="color:red; display:none;">لا يسمح بالتسجيل لمن هم دون 18 سنة</h3>
                    <div class="row">
                         <div id="fnational" class="mb-3 col-4 border-left">
                            <label for="FnationalId" class="form-label">الجنسية:</label>
                            <input type="text" class="form-control w-75" name="nationality" id="nationality" value="<?php echo $result['country']; ?>">
                        </div>
                        <?php
           if($result['country'] != 'مصرى'){?>
                         <div id="fnational" class="mb-3 col-4 border-right border-left" style="display:none;">
                            <label for="FnationalId" class="form-label">رقم جواز السفر :</label>
                            <input type="text" class="form-control w-75" name="FnationalId" id="FnationalId"
                                maxlength="15" autocomplete="off" value="<?php echo $result['FnationalId']; ?>">
                        </div>
          <?php }
           else{?>
                        <div id="enational" class="mb-3 col-4 border-right border-left">
                            <label for="nationalId" class="form-label">الرقم القومى :</label>
                            <input type="text" class="form-control w-75" name="nationalId" id="nationalId"
                                maxlength="14" autocomplete="off" onchange="validationID()" value="<?php echo $result['nationalId']; ?>">
                            <p id="idError" style="display:none; font-size:18px;">*خطأ فى الرقم القومى</p>
                            <p id="errror" style="color:red; font-size:18px;"></p>
                        </div>  
         <?php  }
           ?>
                       
                        <div class="mb-3 col-4 border-right ">
                            <label for="uname" class="form-label">الاسم (كما هو مدون بالبطاقة أو وثيقة السفر)</label>
                            <input type="text" class="form-control" name="uname" id="uname" maxlength="50"
                                autocomplete="off" onfocus="checkage()" onkeypress="return CheckArabicCharactersOnly(event);" value="<?php echo $result['uname']; ?>">

                        </div>

                    </div>



                    <div class="row">
                        <div class="mb-3 col-4 border-right border-left">
                            <label for="marriageAddress" class="form-label">عنوان سكن الزوجية :</label>
                            <input type="text" class="form-control" name="marriageAddress" id="marriageAddress"
                                autocomplete="off" value="<?php echo $result['marriageAddress']; ?>">
                        </div>
                        <div class="mb-3 col-5 border-right ">
                            <label for="address" class="form-label">العنوان بالبطاقة :</label>
                            <input type="text" class="form-control " name="address" id="address" autocomplete="off"
                                value="<?php echo $result['address']; ?>">
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="form-check col-2 ">
                            <label class="form-check-label pt-2 pl-2">النوع : </label>
                           <input type="text" class="form-control " name="gender" id="gender" value="<?php echo $result['gender']; ?>">
                        </div>
                        <div id="eage" class="mb-3  col-2  border-left">
                            <label for="age" class="form-label">السن :</label>
                            <input type="number" class="form-control " name="age" id="age" value="<?php echo $result['age']; ?>">
                        </div>

                        <div class="mb-3 col-3 border-right ">
                            <label for="phone" class="form-label">تليفون :</label>
                            <input type="tel" class="form-control w-75" name="phone" id="phone"
                                onchange="phoneValidation();" onkeypress="return isNumberKey(event)" maxlength="11"
                                autocomplete="off" value="<?php echo $result['phone']; ?>">
                            <p id="phoneError" style="display:none; color:red; font-size:18px;">* رقم هاتف غير صحيح </p>
                        </div>

                      
                        
                    </div>

                </div>
                <hr>
                <h4 class="container-fluid headOfMarriage mb-2 pb-2">بيانات الزواج
                   
                </h4>
                <div class="form-container-Marriage text-right" style="background-color:#eeeeee;">

                    <div class="row pt-2">

                        <div class="form-check mb-4 col-5 mr-3  border-left">
                            <label class="form-check-label pt-2 pl-2">هل توجد قرابة مع الطرف الاخر  : </label>
                              <select name="ifRelate" id="ifRelate" class="form-select w-50 form-control">
                                  <?php
           if($result['ifRelate'] == "نعم"){?>
               <option value="<?php echo $result['ifRelate']; ?>"><?php echo $result['ifRelate']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['ifRelate']; ?>"><?php echo $result['ifRelate']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
      
    </select> 
                        </div>

                        <div class="form-check mb-4 col-5 border-right ">
                            <label class="form-check-label pt-2 pl-2">هل يوجد زواج سابق :</label>
                            <select name="previousMarriage" id="previousMarriage" class="form-select w-50 form-control">
                                 <?php
           if($result['previousMarriage'] == "نعم"){?>
               <option value="<?php echo $result['previousMarriage']; ?>"><?php echo $result['previousMarriage']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['previousMarriage']; ?>"><?php echo $result['previousMarriage']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
      
      
    </select> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-5 mr-3 border-left" id="childern">
                            <label class="form-check-label pt-2 pl-2">هل يوجد اطفال من الزواج  السابق :  </label>
                            
                             <select name="childern" id="childern" class="form-select w-50 form-control">
                                                          <?php
           if($result['childern'] == "نعم"){?>
               <option value="<?php echo $result['childern']; ?>"><?php echo $result['childern']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['childern']; ?>"><?php echo $result['childern']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
    </select> 
                            
                        
                        </div>


                        <div class="form-check mb-3 col-5 border-right " id="geneticDiseases">
                            <label class="form-check-label pt-2 pl-2">هل يوجد لدى الاطفال اى امراض وراثية  : </label>
                            <select name="geneticDiseases" id="geneticDiseases" class="form-select w-50 form-control d-inline">
                                                   <?php
           if($result['geneticDiseases'] == "نعم"){?>
               <option value="<?php echo $result['geneticDiseases']; ?>"><?php echo $result['geneticDiseases']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['geneticDiseases']; ?>"><?php echo $result['geneticDiseases']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
    </select> 
                        </div>

                    </div>




                </div>



                <hr>
                <h4 class="container-fluid headOfRep mb-2 pb-2">الفحوصات الطبية
                 
                </h4>
                <div class="form-container-rep text-right" style="background-color:#eeeeee;">
  
<div class="row pt-2  ">
         <div class="form-check mb-4 col-4 mr-3  border-left ">
                            <label class="form-check-label pt-2 ml-1">   مريض ضغط الدم :  </label>
             <select name="bloodPressure" id="bloodPressure" class="form-select w-50 form-control">
     <?php
           if($result['bloodPresure'] == "نعم"){?>
               <option value="<?php echo $result['bloodPresure']; ?>"><?php echo $result['bloodPresure']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['bloodPresure']; ?>"><?php echo $result['bloodPresure']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
    </select> 
                            
                        </div>
     <div class="form-check col-4 mb-4 border-right border-left " >
                            <label class="form-check-label pt-2 ml-2"> مريض سكر <span class="mr-2">:</span> </label>
           <select name="diabetes" id="diabetes" class="form-select w-50 form-control">
       <?php
           if($result['diabetes'] == "نعم"){?>
               <option value="<?php echo $result['diabetes']; ?>"><?php echo $result['diabetes']; ?></option>
         <option value="لا">لا</option>
          <?php }
           else{?>
             <option value="<?php echo $result['diabetes']; ?>"><?php echo $result['diabetes']; ?></option>
       <option value="نعم" >نعم</option>
          <?php }
           ?>
    </select> 
                   
                        </div>
     <div class="form-check mb-4 col-3 border-right ">
                            <label class="form-check-label pt-2 ">RH <span class="mr-2">:</span></label>
         
              <select name="rh" id="rh" class="form-select w-75 form-control">
                 <?php
           if($result['rh'] == "إيجابى"){?>
               <option value="<?php echo $result['rh']; ?>"><?php echo $result['rh']; ?></option>
          <option value="سلبى">سلبى</option>
          <?php }
           else{?>
             <option value="<?php echo $result['rh']; ?>"><?php echo $result['rh']; ?></option>
       <option value="إيجابى" >إيجابى</option>
          <?php }
           ?> 
                
    </select> 
                   
                        </div>
     
    
</div>
                    <div class="row">
                     
                         
                          
                              <div class="mb-4 col-4 mr-3   border-left " >
                            <label for="pressureeCheck" class="form-label">قياس الضغط :</label>
                                
                            <input type="number" class="form-control w-50 d-inline" name="pressureCheckdown" onkeypress="return isNumberKey(event)"
                                id="pressureCheckdown" autocomplete="off" placeholder="systolic" min="60" max="260" required onchange="pressureCheck()" value="<?php echo $result['systolic']; ?>"><br>
                            <label for="pressureeCheck" class="form-label" style="visibility:hidden;">قياس الضغط :</label>
                    <input type="number" class="form-control w-50 d-inline" onkeypress="return isNumberKey(event)" name="pressureCheckup" id="pressureCheckup" autocomplete="off" placeholder="diastolic" min="30" max="150" required onchange="pressureCheck()" value="<?php echo $result['diastolic']; ?>">
<p id="pressurError" style="color:red; font-size:18px;"></p>
                        </div>
                        
                        
                          <div class="mb-4 col-4 border-right border-left">
                            <label for="diabetesCheck" class="form-label">  قياس السكر العشوائى :</label><br>
                            <input type="number" class="form-control w-50 d-inline " name="diabetesCheck" id="diabetesCheck"
                            onkeypress="return isNumberKey(event)" min="70"  max="600" maxlength="3" autocomplete="off" required onchange="diabetes1()" value="<?php echo $result['diabetesCheck']; ?>">
                              <p id="diabetesError" style="color:red; font-size:18px;"></p>
                        </div>
                         <div class="mb-4 col-3 border-right  ">
                            <label for="hb" class="form-label pr-2">Hb :</label><br>
                            <input type="number" class="form-control w-75 d-inline" name="hb" id="hb" autocomplete="off" min="1" max="25"  step=".01" required onchange="hbCheck()" value="<?php echo $result['hb']; ?>">
                              <p id="hbError" style="color:red; font-size:18px;"></p>
                        </div>  
                    </div>
<div class="row ">
                        <div class="mb-4 col-4 mr-3  border-left ">
                            <label for="height" class="form-label"> الطول (سم) <span class="mr-2">:</span></label><br>
                            <input type="number" class="form-control w-50 d-inline mr-1" name="height" id="height"
                                min="50"  max="300" onkeypress="return isNumberKey(event)" maxlength="3" autocomplete="off" required onchange="heightCheck()" value="<?php echo $result['height']; ?>">
                            <p id="heightError" style="color:red; font-size:18px;"></p>
                        </div>
                        <div class="mb-4 col-4 border-right border-left ">
                            <label for="weight" class="form-label "> الوزن (كجم) <span class="mr-2">:</span></label><br>
                            <input type="number" class="form-control w-50 d-inline " name="weight" id="weight" min="40"  max="250"
                                onkeypress="return isNumberKey(event)" maxlength="3" onchange="bmiCalculate(); weightCheck()"
                                autocomplete="off" required value="<?php echo $result['weight']; ?>">
                            <p id="weightError" style="color:red; font-size:18px;"></p>
                        </div>

    
                        <div id="bmiDiv" class="mb-4 col-3 border-right  " style="display:none; visibility:hidden;">
                            <span for="bmi" class="form-label d-inline">BMI :</span>
                              
                          
                           
                         
                         <div class="d-inline" id="bmi" name="bmi" style="width:120px; height:40px; background-color:white; border-radius: 5px; border:2px solid #000; padding-top:8px; padding-bottom:8px; padding-right:2px; color:black;"></div>

                        </div>
                    </div>
                    <div class="row">


                         <div class="form-check mr-3 mb-4 col-4  border-left " id="HCVDiv">
                            <label class="form-check-label pt-2 ml-2">Anti-HCV :</label>
                        
                             
                             <select name="hcv" id="hcv" class="form-select w-50 form-control">
                                         <?php
           if($result['hcv'] == "متفاعل"){?>
               <option value="<?php echo $result['hcv']; ?>"><?php echo $result['hcv']; ?></option>
           <option value="غير متفاعل">غير متفاعل</option>
          <?php }
           else{?>
             <option value="<?php echo $result['hcv']; ?>"><?php echo $result['hcv']; ?></option>
        <option value="متفاعل" >متفاعل</option>
          <?php }
           ?> 
    </select>     
                             
                        </div>

                        
                          <div class="form-check mb-4 col-4   border-right" id="HBSDiv">
                            <label class="form-check-label  pt-2 pl-1">HBsAg <span class="mr-1">:</span></label>
  
                                         <select name="hbsag" id="hbsag" class="form-select w-50 form-control">
    <?php
           if($result['hbsag'] == "متفاعل"){?>
               <option value="<?php echo $result['hbsag']; ?>"><?php echo $result['hbsag']; ?></option>
           <option value="غير متفاعل">غير متفاعل</option>
          <?php }
           else{?>
             <option value="<?php echo $result['hbsag']; ?>"><?php echo $result['hbsag']; ?></option>
        <option value="متفاعل" >متفاعل</option>
          <?php }
           ?> 
    </select> 
                        </div>
                       
                        
<div class="form-check mb-4 col-3 border-right border-left " id="HIVDiv">
                            <label class="form-check-label pt-2 pl-2">Anti-HIV <span class="mr-1">:</span></label>
<select name="hiv" id="hiv" class="form-select w-75 form-control">
      <?php
           if($result['hiv'] == "متفاعل"){?>
               <option value="<?php echo $result['hiv']; ?>"><?php echo $result['hiv']; ?></option>
           <option value="غير متفاعل">غير متفاعل</option>
          <?php }
           else{?>
             <option value="<?php echo $result['hiv']; ?>"><?php echo $result['hiv']; ?></option>
        <option value="متفاعل" >متفاعل</option>
          <?php }
           ?>
    </select> 
    
                        </div>


                    </div>

              

                    <div class="row">

                        <div class="form-check mr-3 mb-3 col-4 border-right  " >
                            <label class="form-check-label pt-2 ml-1">فصيلة الدم <span class="mr-2">:</span></label>
                              <select name="abo" id="abo" class="form-select w-50 form-control">
              <?php
           if($result['abo'] == "+A"){?>
               <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>                   
          <?php }
           else if($result['abo'] == "-A"){?>
             <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>
          <?php }
           else if($result['abo'] == "+B"){?>
          <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>                
                <?php}
           else if($result['abo'] == "-B"){?>
            <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>
           <?php}
           else if($result['abo'] == "+AB"){?>
         <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>
          <?php }
           else if($result['abo'] == "-AB"){?>
            <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="+O">+O</option>
           <option value="-O">-O</option>
           <?php}
           else if($result['abo'] == "+O"){?>
             <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="-O">-O</option>
          <?php }
           else{?>
              <option value="<?php echo $result['abo']; ?>"><?php echo $result['abo']; ?></option>
           <option value="+A">+A</option>
           <option value="-A">-A</option>
           <option value="+B">+B</option>
           <option value="-B">-B</option>
           <option value="+AB">+AB</option>
           <option value="-AB">-AB</option>
           <option value="+O">+O</option>   
         <?php  }
               ?>      
                                         
    </select>   
   
                        </div>


                    </div>

                </div>
            </section>

            <button class="btn btn-lg text-white submitButton" id="submitB" type="submit" name="edit"
                onclick="return confirm('هل جميع البيانات صحيحة؟');">تعديل و طباعة </button>
            <button class="btn btn-lg text-white backButton" type="button" name="back"   onclick="return confirm(فى حالة إلغاء التعديل لا يمكنك تعديل هذة البيانات مرة اخرى هل تريد الاستمرار ؟');"> 
                <a href="home.php">رجوع</a></button>

<?php
       }
              while($result=mysqli_fetch_array($query));
          }?>


        </form>
    </section>

    <footer>
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>

    </footer>



<?php
       }
       else{
            echo '<script type="text/javascript">';echo'window.location.href="form.php";';echo '</script>';
       }
           ?>
   
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <script>
      function validationID() {
     var str = document.getElementById("nationalId").value;
    var res = str.split('');
    var Array = res;
    var month = Array[3] + Array[4];
    var day = Array[5] + Array[6];
    console.log(res);
    console.log(Array);
     var length = str.length;
        if (length !== 14)
        {
            document.getElementById("idError").style.display = "block";
        document.getElementById("idError").style.color = "red";
             document.getElementById("submitB").style.display = "none";
        }

        // Check the left most digit
		if (Array[0] != 2 && Array[0] != 3)
		{
			document.getElementById("idError").style.display = "block";
        document.getElementById("idError").style.color = "red";
             document.getElementById("submit").style.display ="none";
		}
            
		if(month < 01 && month > 12){
            console.log("MonthError");
           document.getElementById("idError").style.display = "block";
        document.getElementById("idError").style.color = "red";
             document.getElementById("submit").style.display ="none";
        }
     if(day < 01 || day > 31){
          console.log("DayError" + day);
         document.getElementById("errror").innerHTML = "خطأ فى الرقم القومى *";
                console.log("month is " + month);
                document.getElementById("submitB").style.display = "none";
           document.getElementById("uname").readOnly = true;
        document.getElementById("age").readOnly = true;
        document.getElementById("phone").readOnly = true;
        document.getElementById("address").readOnly = true;
        document.getElementById("marriageAddress").readOnly = true;
        }
            if(month < 01 || month > 12){
                document.getElementById("errror").innerHTML = "خطأ فى الرقم القومى *";
                console.log("month is " + month);
                document.getElementById("submitB").style.display = "none";
                  document.getElementById("uname").readOnly = true;
        document.getElementById("age").readOnly = true;
        document.getElementById("phone").readOnly = true;
        document.getElementById("address").readOnly = true;
        document.getElementById("marriageAddress").readOnly = true;
                
            }
          else{
              document.getElementById("errror").innerHTML = " ";
              document.getElementById("submitB").style.display = "block";
                document.getElementById("uname").readOnly = false;
        document.getElementById("age").readOnly = false;
        document.getElementById("phone").readOnly = false;
        document.getElementById("address").readOnly = false;
        document.getElementById("marriageAddress").readOnly = false;
        
    var res1 = Array[0] * 2;
    var res2 = Array[1] * 7;
    var res3 = Array[2] * 6;
    var res4 = Array[3] * 5;
    var res5 = Array[4] * 4;
    var res6 = Array[5] * 3;
    var res7 = Array[6] * 2;
    var res8 = Array[7] * 7;
    var res9 = Array[8] * 6;
    var res10 = Array[9] * 5;
    var res11 = Array[10] * 4;
    var res12 = Array[11] * 3;
    var res13 = Array[12] * 2;
    var res14 = Array[13];
    console.log(res1);
    var totalres = (res1 + res2 + res3 + res4 + res5 + res6 + res7 + res8 + res9 + res10 + res11 + res12 + res13);
    console.log(totalres);
    var x = totalres / 11;
    var out = parseInt(x) * 11;
    var ot = totalres - out;
    console.log(ot);
    var y = 11 - ot;
    console.log(y);
           if(y == 11){
        y = 1;
               console.log("y =" + y); 
    }
    else if(y == 10){
        y = 0
        console.log("y =" + y); 
    }     
              
    if (res14 == y) {
        document.getElementById("idError").style.display = "none";
    } else {
        console.log("y =" + y); 
        document.getElementById("idError").style.display = "block";
        document.getElementById("idError").style.color = "red";
         document.getElementById("submitB").style.display = "none";
        return false;
    }
    if (Array[12] % 2 == 0) {
        document.getElementById("female").checked = true;
        console.log("female");

    } else {
        document.getElementById("male").checked = true;
        console.log("male");
    }
    if (Array[0] == 2) {
        var today = new Date();
        var currentYear = today.getFullYear();
        console.log (currentYear);
        var yearArray = 19 + Array[1] + Array[2];
        var month = Array[3] + Array[4];
        var day = Array[5] + Array[6];
        var birthday = month + '/' + day + '/' + yearArray;
        var age = currentYear - yearArray;
        console.log(age);
        document.getElementById("age").value = age;
        console.log(birthday);
        console.log(yearArray);
    }

    if (Array[0] == 3) {
       var today = new Date();
        var currentYear = today.getFullYear();
        console.log (currentYear);
        var yearArray = 20 + Array[1] + Array[2];
        var month = Array[3] + Array[4];
        var day = Array[5] + Array[6];
        var birthday = month + '/' + day + '/' + yearArray;
        var age = currentYear - yearArray;
        console.log(age);
        document.getElementById("age").value = age;
        console.log(birthday);
        console.log(yearArray);
    }
  }
}
    
    </script>
    <script src="../js/mine.js"></script>
        <script>
      
        function CheckArabicCharactersOnly(e) {
               if(document.getElementById("egyptian").checked){
var unicode = e.charCode ? e.charCode : e.keyCode
if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
if (unicode == 32)
return true;
else {
if ((unicode < 0x0600 || unicode > 0x06FF)) //if not  arabic
return false; //disable key press
}
}
}
else if (document.getElementById("foreigner").checked){
                   console.log("ellse");
  var charCode = (e.which) ? e.which : e.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return true;
        return false;
    
               }
           }
            function pressureCheck(){
             var systolic = document.getElementById("pressureCheckdown").value;
            var diastolic = document.getElementById("pressureCheckup").value;
                console.log(systolic);
                console.log(diastolic);
            if(systolic < 60 || systolic > 260 || diastolic < 30 || diastolic > 150){
                document.getElementById("pressurError").innerHTML = " *  قياس ضغط غير صحيح";
            } 
                else{
                    document.getElementById("pressurError").innerHTML = " ";
                }
                
            }
            function diabetes1(){
                  var diabetes = document.getElementById("diabetesCheck").value;
                console.log(diabetes);
                if(diabetes < 70 || diabetes > 600){
                    document.getElementById("diabetesError").innerHTML = " قياس سكر تراكمى غير صحيح *";
                }
                else{
                   document.getElementById("diabetesError").innerHTML = " ";  
                } 
            }
            function hbCheck(){
                var hb = document.getElementById("hb").value;
                console.log(hb);
                if(hb < 1 || hb > 25){
                    document.getElementById("hbError").innerHTML = " قياس هيموجلوبين غير صحيح *";
                }
                else{
                   document.getElementById("hbError").innerHTML = " ";  
                }
            }
          function heightCheck(){
              var height = document.getElementById("height").value;
              console.log(height);
              if(height < 50 || height > 300){
                  document.getElementById("heightError").innerHTML = " قياس طول غير صحيح *";
              }
              else{
                document.getElementById("heightError").innerHTML = " ";
              }
          }
            function weightCheck(){
                var weight = document.getElementById("weight").value;
                console.log(weight);
                if(weight < 40 || weight > 250){
                    document.getElementById("weightError").innerHTML = "قياس وزن غير صحيح *";
                }
                else{
                     document.getElementById("weightError").innerHTML = " ";
                }
            }
            function activeHcv(){
                if(document.getElementById("yesHcv").checked){
                    document.getElementById("HCVDiv").style.border = "thick solid red";
                     document.getElementById("HCVDiv").style.color = "red";
                }
                else{
                    document.getElementById("HCVDiv").style.border = "thick solid transparent";
                    document.getElementById("HCVDiv").style.color = "black";
                }
            }
            
               function activeHiv(){
                if(document.getElementById("yesHiv").checked){
                    document.getElementById("HIVDiv").style.border = "thick solid red";
                     document.getElementById("HIVDiv").style.color = "red";
                }
                else{
                    document.getElementById("HIVDiv").style.border = "thick solid transparent";
                    document.getElementById("HIVDiv").style.color = "black";
                }
            }
            
                function activeHbs(){
                if(document.getElementById("yeshbsag").checked){
                    document.getElementById("HBSDiv").style.border = "thick solid red";
                     document.getElementById("HBSDiv").style.color = "red";
                }
                else{
                    document.getElementById("HBSDiv").style.border = "thick solid transparent";
                    document.getElementById("HBSDiv").style.color = "black";
                }
            }
            
        </script>
    
</body>

</html>
<?php 
      }
?>