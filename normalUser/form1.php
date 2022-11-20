<html dir="rtl">

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
            font-family: 'Cairo', sans-serif; !important
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

            $('#phone').html(data);

          });

      }

    });

  });
         
         
           $(document).ready(function() {
    $('#phone').on('change', function() {
      var nationalId = $(this).val();
      if (nationalId) {
        $.get(
          "whatsapp.php", {
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

<body style="color:black;" onload="login();">
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
        <p style="font-size: 18px; color:red;">إدخل جميع البيانات في الحقول</p>
    </div>
    <section class="container" id="result">
        <h4 class="container-fluid headOfPersonal mb-0 pb-0">البيانات الأساسية
            
        </h4>

        <form name="Info" method="post" action="api.php">
            <section>
       
                
                <div id="form-container" class="container">
                    <h3 id="warn" style="color:red; display:none;">لا يسمح بالتسجيل لمن هم دون 18 سنة</h3>
                    <div class="row pt-2">
                        <div class="form-check col-4 ml-2 ">
                            <label class="form-check-label pt-2 pl-2">الجنسية : </label>
                            <input onchange="foreignerCheck()" type="radio" name="nationality" id="egyptian"
                                value="مصرى" checked>
                            <label class="ml-3" for="egyptian"> مصرى </label>
                            <input onchange="foreignerCheck()" type="radio" name="nationality" id="foreigner"
                                value="غير مصرى">
                            <label for="foreigner">غير مصرى </label>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div id="enational" class="mb-3 col-4 border-right border-left">
                            <label for="nationalId" class="form-label">الرقم القومى :</label>
                            
                            <input type="text" class="form-control w-75 d-inline" name="nationalId" id="nationalId"
                                maxlength="14" autocomplete="off" onchange="validationID()">
                             <p id="idError" style="display:none; font-size:18px;">*خطأ فى الرقم القومى</p>
                            <p id="errror" style="color:red; font-size:18px;"></p>
                        </div>

                        <div id="fnational" class="mb-3 col-4 border-right border-left" style="display:none;">
                            <label for="FnationalId" class="form-label">رقم جواز السفر :</label>
                            <input type="text" class="form-control w-75" name="FnationalId" id="FnationalId"
                                maxlength="15" autocomplete="off">
                        </div>
                        <div id="fcountry" class="mb-3 col-3 border-right border-left" style="display:none;">
                            <label for="country" class="form-label">بلد الجنسية :</label>
                            <select name="country" id="country" class="form-select w-75 form-control" style="font-size:14px;">
                                <option value=" " selected>--اختر بلد الجنسية--</option>
                                <?php
       require_once '../connection.php';
       $query= "select * from country";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
       }
       ?>
                            </select>
                        </div>
                        <div class="mb-3 col-5 border-right ">
                            <label for="uname" class="form-label">الاسم (كما هو مدون بالبطاقة أو وثيقة السفر)</label>
                            <input type="text" class="form-control" name="uname" id="uname" maxlength="50"
                                autocomplete="off" onfocus="checkage()" onkeypress="return CheckArabicCharactersOnly(event);" required>

                        </div>

                    </div>



                    <div class="row">
                        <div class="mb-3 col-4 border-right border-left">
                            <label for="marriageAddress" class="form-label">عنوان سكن الزوجية :</label>
                            <input type="text" class="form-control" name="marriageAddress" id="marriageAddress"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3 col-5 border-right ">
                            <label for="address" class="form-label">العنوان بالبطاقة :</label>
                            <input type="text" class="form-control " name="address" id="address" autocomplete="off"
                                required>
                        </div>
                        
                    </div>


                    <div class="row">
                        <div class="form-check col-2 ">
                            <label class="form-check-label pt-2 pl-2">النوع : </label>
                            <input required type="radio" name="gender" id="male" value="ذكر">
                            <label class="ml-3" for="male"> ذكر </label><br>
                            <label class="form-check-label pl-2" style="visibility:hidden;">النوع : </label>
                            <input type="radio" name="gender" id="female" value="أنثى">
                            <label for="female">أنثى</label>
                        </div>
                        <div id="eage" class="mb-3  col-2  border-left">
                            <label for="age" class="form-label">السن :</label>
                            <input type="number" class="form-control " name="age" id="age" required>
                        </div>

                        <div class="mb-3 col-3 border-right ">
                            <label for="phone" class="form-label">تليفون :</label>
                            <input type="tel" class="form-control w-75" name="phone" id="phone"
                                onchange="phoneValidation();" onkeypress="return isNumberKey(event)" maxlength="11"
                                autocomplete="off" required>
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
                            <input required type="radio" name="ifRelate" id="yesRelate" value="نعم">
                            <label class="ml-3" for="yesRelate"> نعم </label>
                            <input type="radio" name="ifRelate" id="noRelate" value="لا" >
                            <label for="noRelate">لا</label>
                        </div>

                        <div class="form-check mb-4 col-5 border-right ">
                            <label class="form-check-label pt-2 pl-2">هل يوجد زواج سابق :</label>
                            <input required onchange="preMarriage()" type="radio" name="previousMarriage" id="yesPre"
                                value="نعم">
                            <label class="ml-3" for="yesPre"> نعم </label>
                            <input onchange="preMarriage()" type="radio" name="previousMarriage" id="noPre" value="لا">
                            <label for="noPre">لا</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check mb-3 col-5 mr-3 border-left" id="childern" style="visibility:hidden;">
                            <label class="form-check-label pt-2 pl-2">هل يوجد اطفال من الزواج  السابق :  </label>
                            <input onchange="childDiseases()" type="radio" name="childern" id="yesChild" value="نعم">
                            <label class="ml-3" for="yesChild"> نعم </label>
                            <input onchange="childDiseases()" type="radio" name="childern" id="noChild" value="لا" class="mr-4" checked>
                            <label for="noChild">لا</label>
                        </div>


                        <div class="form-check mb-3 col-5 border-right " id="geneticDiseases" style="visibility:hidden;">
                            <label class="form-check-label pt-2 pl-2">هل يوجد لدى الاطفال اى امراض وراثية  : </label>
                            <input type="radio" name="geneticDiseases" id="yesgenetic" value="نعم">
                            <label class="ml-3" for="yesgenetic"> نعم </label>
                            <input type="radio" name="geneticDiseases" id="noGenetic" value="لا" checked>
                            <label for="noGenetic">لا</label>
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
                            <input required type="radio" name="bloodPressure" id="yesPressure" value="نعم">
                            <label class="ml-3" for="yesPressure"> نعم </label>
                            <input type="radio" name="bloodPressure" id="noPressure" value="لا" >
                            <label for="noPressure" >لا</label>
                        </div>
     <div class="form-check col-4 mb-4 border-right border-left " >
                            <label class="form-check-label pt-2 ml-2"> مريض سكر <span class="mr-2">:</span> </label>
                            <input required type="radio" name="diabetes" id="yesDiabetes" value="نعم">
                            <label class="ml-3" for="yesDiabetes"> نعم </label>
                            <input type="radio" name="diabetes" id="noDiabetes" value="لا" >
                            <label for="noDiabetes">لا</label>
                        </div>
     <div class="form-check mb-4 col-3 border-right ">
                            <label class="form-check-label pt-2 ">Rh <span class="mr-2">:</span></label>
                            <input required type="radio" name="rh" id="positive" value="إيجابى">
                            <label class="ml-3" for="positive"> إيجابى </label>
                            <input type="radio" name="rh" id="negative" value="سلبى">
                            <label for="negative">سلبى</label>
                        </div>
     
    
</div>
                    <div class="row">
                     
                         
                          <div class="mb-4 col-4 mr-3   border-left " >
                            <label for="pressureeCheck" class="form-label">قياس الضغط :</label>
                                
                            <input type="number" class="form-control w-50 d-inline" name="pressureCheckdown" onkeypress="return isNumberKey(event)"
                                id="pressureCheckdown" autocomplete="off" placeholder="systolic" min="60" max="260" required onchange="pressureCheck()"><br>
                            <label for="pressureeCheck" class="form-label" style="visibility:hidden;">قياس الضغط :</label>
                    <input type="number" class="form-control w-50 d-inline" onkeypress="return isNumberKey(event)" name="pressureCheckup" id="pressureCheckup" autocomplete="off" placeholder="diastolic" min="30" max="150" required onchange="pressureCheck()">
<p id="pressurError" style="color:red; font-size:18px;"></p>
                        </div>
                        
                        
                          <div class="mb-4 col-4 border-right border-left">
                            <label for="diabetesCheck" class="form-label">  قياس السكر العشوائى :</label>
                            <input type="number" class="form-control w-50 d-inline " name="diabetesCheck" id="diabetesCheck"
                            onkeypress="return isNumberKey(event)" min="70"  max="600" maxlength="3" autocomplete="off" required onchange="diabetes1()">
                              <p id="diabetesError" style="color:red; font-size:18px;"></p>
                        </div>
                         <div class="mb-4 col-3 border-right  ">
                            <label for="hb" class="form-label pr-2">Hb :</label>
                            <input type="number" class="form-control w-75 d-inline" name="hb" id="hb" autocomplete="off" min="1" max="25"  step=".01" required onchange="hbCheck()">
                              <p id="hbError" style="color:red; font-size:18px;"></p>
                        </div>  
                    </div>
<div class="row ">
                        <div class="mb-4 col-4 mr-3  border-left ">
                            <label for="height" class="form-label"> الطول (سم) <span class="mr-2">:</span></label>
                            <input type="number" class="form-control w-50 d-inline mr-1" name="height" id="height"
                                min="50"  max="300" onkeypress="return isNumberKey(event)" maxlength="3" autocomplete="off" required onchange="heightCheck()">
                            <p id="heightError" style="color:red; font-size:18px;"></p>
                        </div>
                        <div class="mb-4 col-4 border-right border-left ">
                            <label for="weight" class="form-label "> الوزن (كجم) <span class="mr-2">:</span></label>
                            <input type="number" class="form-control w-50 d-inline " name="weight" id="weight" min="40"  max="250"
                                onkeypress="return isNumberKey(event)" maxlength="3" onchange="bmiCalculate(); weightCheck()"
                                autocomplete="off" required>
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
                            <input required type="radio" name="hcv" id="yesHcv" value="متفاعل" onchange="activeHcv();">
                            <label class="ml-3" for="yesHcv"> متفاعل </label>
                            <input type="radio" name="hcv" id="noHcv" value="غير متفاعل" onchange="activeHcv();">
                            <label for="noHcv">غير متفاعل</label>
                        </div>

                        
                          <div class="form-check mb-4 col-4   border-right" id="HBSDiv">
                            <label class="form-check-label  pt-2 pl-1">HBsAg <span class="mr-4 pr-3">:</span></label>
                            <input required type="radio" name="hbsag" id="yeshbsag" value="متفاعل" onchange="activeHbs();">
                            <label class="ml-3" for="yeshbsag"> متفاعل </label>
                            <input type="radio" name="hbsag" id="nohbsag" value="غير متفاعل" onchange="activeHbs();">
                            <label for="nohbsag" >غير متفاعل</label>
                        </div>
                       
                        



                    </div>

              

                    <div class="row">
<div class="form-check mr-3 mb-4 col-4  border-left " id="HIVDiv">
                            <label class="form-check-label pt-2 pl-2">Anti-HIV <span class="mr-1">:</span></label>
                            <input required type="radio" name="hiv" id="yesHiv" value="متفاعل" onchange="activeHiv();">
                            <label class="ml-3" for="yesHiv"> متفاعل </label>
                            <input type="radio" name="hiv" id="noHiv" value="غير متفاعل" onchange="activeHiv();">
                            <label for="noHiv">غير متفاعل</label>
                        </div>
                        <div class="form-check  mb-3 col-6 border-right  " >
                            <label class="form-check-label pt-2 ml-1">فصيلة الدم <span class="mr-2">:</span></label>
                            <input required type="radio" name="abo" id="+A" value="+A">
                            <label class="ml-3" for="+A"> +A </label>
                            <input type="radio" name="abo" id="+B" value="+B">
                            <label class="ml-3" for="+B">+B</label>
                            <input type="radio" name="abo" id="+AB" value="+AB">
                            <label class="ml-3" for="+AB">+AB</label>
                            <input type="radio" name="abo" id="+O" value="+O">
                            <label class="ml-3" for="+O">+O</label><br>
                            <label class="form-check-label pt-2 ml-1" style="visibility:hidden;">فصيلة الدم <span class="mr-2">:</span></label>
                            <input type="radio" name="abo" id="-A" value="-A">
                            <label class="ml-3" for="-A"> -A </label>
                            <input type="radio" name="abo" id="-B" value="-B">
                            <label class="ml-3" for="-B">-B</label>
                            <input type="radio" name="abo" id="-AB" value="-AB">
                            <label class="ml-3" for="-AB">-AB</label>
                            <input type="radio" name="abo" id="-O" value="-O">
                            <label class="ml-3" for="-O">-O</label>
                        </div>


                    </div>

                </div>
            </section>

            <button class="btn btn-lg text-white submitButton" id="submitB" type="submit" name="submit"
                >حفظ </button>
            <button class="btn btn-lg text-white backButton" type="button" name="back">
                <a href="home.php">رجوع</a></button>




        </form>
    </section>

    <footer>
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>

    </footer>




   
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
    new WOW().init();
    </script>
    <script>
            function login(){
              console.log("login");
              var gov = document.getElementById("gov").value;
              var qism = document.getElementById("qism").value;
              var location = document.getElementById("location").value;
              console.log(gov);
              console.log(qism);
              console.log(location);
              if(gov.length == 0 || qism.length == 0 || location.length == 0){
                  window.location.href="../index.php";
              }
              else{
                  console.log (gov.length);
                   console.log (qism.length);
                   console.log (location.length);
              }
            
          }
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
