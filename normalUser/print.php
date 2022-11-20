<?php session_start (); include '../connection.php'; ?><html dir="rtl">
   <head>
       <title>وزارة الصحة و السكان - مبادرة فحوصات ما قبل الزواج</title>
       <meta charset="UTF-8">
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
      <link rel="stylesheet" href="../css/all.min.css">
      <link rel="stylesheet" href="../css/animate.css">
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/font-awesome.min.css">
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
       <link rel="stylesheet" href="../css/style.css">
	   <link rel="stylesheet" href="../css/print.css">
       <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
       <link rel="preconnect" href="https://fonts.gstatic.com">
<style>
      @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
body{
     font-family: 'Cairo',sans-serif; !important
    }
 .qr-code {
	max-width: 110px;
	max-height: 100px;
	} 
    p{
        font-size: 18px;
    }  
       </style>
    </head>
    
    <body style="color:black;">
        <nav>
    <div class="row">
    <div class="col-1"><img src="../img/Ministry_of_Health_and_Population_of_Egypt.png" class="img-fluid"
                    style="height:85px;  margin-top:10px;" /></div>
            <div class="col-2 pt-3">
             <h6 class="text-white d-inline" style=" font-weight: bold;">
                  <br>جمهورية مصر العربية
                 <br>وزارة الصحة و السكان
              
                </h6>
            </div>
      
      <div class="dropdown show d-inline h3 col-4">
        <a class="h3 dropdown-toggle float-left ml-4 mt-4 text-white" href="#" role="button" id="dropdownMenuLink"
          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['unit']; ?>
        </a>
         <div class="dropdown-menu float-left" aria-labelledby="dropdownMenuLink">
                  
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
        <?php 
        require_once '../connection.php';
        if(isset($_POST['search'])){
        $unit = $_SESSION['unit'];
        $nationality = $_POST['nationality'];
        $NID = $_POST['nationalId'];
        $FID = $_POST['FnationalId']; 
          if($nationality == 'مصرى'){
       $user = "SELECT * FROM users WHERE nationalId = '$NID' And nationalId != '' and location = '$unit' ORDER BY date DESC limit 1";
       $query = mysqli_query( $conn,$user) or die('error:'.mysqli_error($conn));
       $result = mysqli_fetch_array($query);
       $count= mysqli_num_rows($query);
          if($count > 0){
                 
              
       do{?>
        <form method="post" action="count.php" onsubmit="window.print()">
    <input type="text" class="form-control" id="url" value="<?php echo "http://81.21.104.151/verify.php"?>" style="display:none;"/>
              <input type="text" class="form-control" name="nid" value="<?php echo $result['nationalId'];?>" style="display:none;"/>
      <input type="text" class="form-control" name="ser" value="<?php echo $result['serial'];?>" style="display:none;"/>

  <section class="container mt-1">
      <div class="pic" style="display:block;">
     <canvas id="myCanvas" width="150" height="150"
style="border:1px solid #000000;">

</canvas><br><span>ختم شعار الجمهورية</span>
      </div>
<div class="row">
        <div class="col-3 mr-4 font-weight-bold"><p class="text-right font-weight-bold"><?php echo "تاريخ الإصدار : " . $result['date']; ?></p></div>
        	<div class="col-4 font-weight-bold"> <p class="text-right font-weight-bold"><?php echo "اسم الوحدة: " . $result['location']; ?></p></div>
       <div class="col-4 font-weight-bold"> <p class="text-right font-weight-bold"><?php echo "المحافظة: " . $result['governorate']; ?></p></div>
        </div>
               <h3 class="container-fluid headOfPersonal mb-2 pb-1" style="border: 2px solid black;">البيانات الأساسية 
            </h3>
            
<section>
    <div id="form-container" class="form-container-Marriage pr-3 mb-1 pb-2">
        <div class="row">
         
             
             <div class="col-5">
                  <p  style="font-size: 18px; font-family: cairo;">
                      الاسم : <span class="font-weight-bold"><?php echo $result['uname'];?>  </span></p>
             </div>
                 <div class="col-4"> 
                     <p  style="font-size: 18px; font-family: cairo;">
                         الرقم القومى :   <span class="font-weight-bold"><?php echo $result['nationalId'];?></span></p></div>
              <div class="col-2"> 
                     <p style="font-size: 18px; font-family: cairo;">
             النوع :   <span class="font-weight-bold"><?php echo $result['gender'];?></span>
        </p>
            </div>

        
        </div>
        <div class="row">
              <div class="col-5">
                  
              <p style="font-size: 18px; font-family: cairo;">  الجنسية : <span class="font-weight-bold"><?php echo $result['nationality'];?></span></div>
                  
                  
                  <div class="col-4">
                      <p  style="font-size: 18px; font-family: cairo;">
                          السن :  <span class="font-weight-bold"><?php echo $result['age'];?></span></p>
                          
            </div>
            <div class="col-3">
                      <p  style="font-size: 18px; font-family: cairo;">
            تليفون :   <span class="font-weight-bold"><?php echo $result['phone'];?></span>
        </p>
            </div>
       
         </div>
           
                         <div class="row">
                                  <div class="col-5">
                                      <p  style="font-size: 18px; font-family: cairo;">  العنوان بالبطاقة : <span class="font-weight-bold"><?php echo $result['address'];?>  </span></p></div>
                  
                  <div class="col-5">
              <p  style="font-size: 18px; font-family: cairo;">
           عنوان سكن الزوجية :   <span class="font-weight-bold"><?php echo $result['marriageAddress'];?></span>
        </p>
            </div>
                       
    </div>
    </div>
     <h3 class="container-fluid headOfMarriage mb-2 pb-1" style="border: 2px solid black;">بيانات الزواج 
      
            </h3>
    <div class="form-container-Marriage text-right mb-1 pb-2" style="background-color:#eeeeee;">
          
                     <div class="row">
                                       <div class="col-4">
                                           <p class="mr-3" style="font-size: 18px; font-family: cairo;"> هل توجد قرابة مع الطرف الاخر : <span class="font-weight-bold"><?php echo $result['ifRelate'];?>  </span></p></div>
                         
                         <div class="col-5">
                         
                         <p style="font-size: 18px; font-family: cairo;">
          هل يوجد زواج سابق :   <span class="font-weight-bold"><?php echo $result['previousMarriage'];?></span>
        </p>
            </div>
                     
                                 
</div>        
                <div class="row"> 
                               <div class="col-4">
                                   <p  class="mr-3" style="font-size: 18px; font-family: cairo;"> هل يوجد اطفال من الزواج السابق : <span class="font-weight-bold"><?php echo $result['childern'];?>  </span></p></div>
                    <div class="col-5">
                         <p  style="font-size: 18px; font-family: cairo;">
         هل يوجد لدى الاطفال اى امراض وراثية :   <span class="font-weight-bold"><?php echo $result['geneticDiseases'];?></span>
                    
        </p>
        </div>
            </div>       
             </div>	
  
    <h3 class="container-fluid headOfRep mb-2 pb-1" style="border: 2px solid black;">الفحوصات الطبية
            </h3>
        <div class="form-container-rep text-right mb-1 pb-2" style="background-color:#eeeeee;">
            
            
               <div class="row">
                    <div class="col-4">
                        <p class="mr-3"  style="font-size: 18px; font-family: cairo;"> الطول(سم) : <span class="font-weight-bold"><?php echo $result['height']  ;?>  </span></p></div>
                 <div class="col-4">
                        <p  style="font-size: 18px; font-family: cairo;">   
         الوزن(كجم) :   <span class="font-weight-bold"><?php echo $result['weight'];?></span>
                     </p></div>
                   
                           <div class="col-4">
                        <p  style="font-size: 18px; font-family: cairo;"> 
                    BMI: <span class="font-weight-bold" ><?php echo $result['bmi'];?>  </span>     
        </p>
            </div>
   
                    </div>
                
           
                     <div class="row">
                               <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> 
                  
                  RH :  <span class="font-weight-bold"><?php echo $result['rh'];?>  </span>
                                   </p></div>
                      <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">
                  فصيلة الدم: <span class="font-weight-bold" ><?php echo $result['abo'];?>  </span>
                  
                  
                  
                
        </p>
            </div>
                      <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">    
             Hb :   <span class="font-weight-bold" ><?php echo $result['hb'];?></span>
                          </p></div>
                    
            </div>
            
            <div class="row">
            <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> 
                hbsAg : <span class="font-weight-bold"><?php echo $result['hbsag'];?>  </span> 
                     </p></div>
                <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;"> 
              Anti-HIV :   <span class="font-weight-bold"><?php echo $result['hiv'];?></span>    
                  
                  
                  
                
        </p>
            </div>	
                <div class="col-4">
              <p style="font-size: 18px; font-family: cairo;">
        Anti-HCV : <span class="font-weight-bold"><?php echo $result['hcv'];?>  </span>
                  
                  
                  
                
        </p>
            </div>
            </div>
            
            
              <div class="row">
                       <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> هل يوجد إصابة بمرض ضغط الدم : <span class="font-weight-bold"><?php echo $result['bloodPresure'];?>  </span>
                           </p></div>
                  <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">
                  الضغط :   <span class="font-weight-bold"><?php echo $result['systolic'];?>/<?php echo $result['diastolic'];?></span></p></div>
                  
             
                  
            </div> 
           
            <div class="row">
                        <div class="col-4">
              <p  class="mr-3" style="font-size: 18px; font-family: cairo;">
                  هل يوجد إصابة بمرض السكر : <span class="font-weight-bold"><?php echo $result['diabetes'];?> 
                  </span></p></div>
                  
                  <div class="col-4">
              <p style="font-size: 18px; font-family: cairo;">
                  نتيجة فحص السكر(العشوائى) : <span class="font-weight-bold"><?php echo $result['diabetesCheck'];?>  </span></p></div>
             
                  

</div>
			       
		  
    </div>
       
     <h3 class="container-fluid headOfMarriage mb-2 pb-1" style="border: 2px solid black;"> إقرار المنتفع بإعلامه بنتيجة الفحص وتوصيات الطبيب 
            </h3>
   <div class="form-container-Marriage text-right" style="background-color:#eeeeee;">
       
           <div class="row pt-2">
       
          <div class="col-4 pt-4">
           <p class="mr-3"> اسم الممرضة : ----------------------</p>
            <p class="mr-3"> اسم الطبيب : ----------------------</p>
            <p class="mr-3"> مدير الوحدة  : ----------------------</p>
           </div>
           <div class="col-4 pt-4">
               <p class="mr-3"> التوقيع : ----------------------</p> 
               <p class="mr-3"> التوقيع : ----------------------</p> 
               <p class="mr-3"> التوقيع : ----------------------</p> 
           </div>
               
              <div class="col-3">
                 <canvas id="myCircle" width="180" height="125"></canvas>
           <p style="padding-top:2px; padding-right:45px;">ختم الوحدة</p>
           </div>  
               
               
       </div>
       
        <hr style="color:black;">
       <div class="row pt-2">
           <div class="col-6">
               <p class="mr-3" style="font-size: 18px; font-family: cairo;">  أقر أنا الموقع أدناه : <span class="font-weight-bold"><?php echo $result['uname'];?>  </span></p></div>
            <div class="col-4">
               <p class="mr-3" style="font-size: 18px; font-family: cairo;">   رقم القومى :   <span class="font-weight-bold"><?php echo $result['nationalId'];?>  </span></p></div>
       </div>
         
           
    <p class="mr-3" style="font-size: 18px; font-family: cairo;">بأنه قد تم إعلامى بنتيجة الفحص الطبى والتوصيات الطبية المذكورة سابقا وقد تلقيت المشورة الخاصة بحالتى الصحية وألتزم بإعلام طرف الزواج الأخر 
قبل إجراءات الزواج وأصبحت بذلك مسئول عما يترتب على ذلك دون أدنى مسئولية على المنشأة الصحية والفريق الطبى الذى يمثلها  .</p><br>
         
       <div class="row">
          <div class="col-4 border-left">
           <p class="mr-3"> الاسم (رباعى) : ------------------</p>
             <p class="mr-3"> التوقيع : -----------------------</p> 
           </div>
           <div class="col-3 border-left">
                 <canvas id="myCircle1" width="180" height="125"></canvas>
           <p style="padding-top:2px; padding-right:35px;">بصمة الإبهام </p>
           </div>
		   <div class="col-5">
		   <p class="mr-3"> اسم الطرف الاخر(رباعى) : ---------------</p>
             <p class="mr-3"> توقيع الطرف الاخر  : --------------------</p> 
		    <p class="mr-3"> الرقم القومى للطرف الاخر  : -------------</p> 
		   </div>
       
       </div>
	   <div class="row">
    
       <div class="col-sm-8"></div>     
  <div class="col-sm-4"><img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" /></div>
       </div>
       <div class="row">
            <div class="col-sm-8"></div>
           
            <div class="col-sm-4 mb-1"> <p  style="color:black; font-weight:bold; font-size:14px;">SN:<?php echo $result['serial']; ?></p></div>
    </div>
    </div>
	   </section>
        </section>
        <button class="btn btn-lg text-white submitButton" type="submit" name="print"   id="print-button">طباعة </button>
        <button class="btn btn-lg text-white backButton" type="button" name="back" style="margin-left:200px;">
           <a href="search.php">رجوع</a></button>
        </form>
<?php } while($result=mysqli_fetch_array($query));
        }
              else{
        ?>
                   <h4 class="text-center font-weight-bold mt-5">لا يوجد بيانات مُسجلة</h4>
              <?php
              }
          
          }
        
        
        ?>
<?php
  

 
             if($nationality == 'غير مصرى'){
       $user = "SELECT * FROM users WHERE FnationalId = '$FID' and FnationalId !='' and location = '$unit' ORDER BY date DESC limit 1";
       $query = mysqli_query( $conn,$user) or die('error:'.mysqli_error($conn));
       $result = mysqli_fetch_array($query);
         $count= mysqli_num_rows($query);
          if($count > 0){        
                 
       do{?>
        <form method="post" action="count.php" onsubmit="window.print()">
               <input type="text" class="form-control" name="nid" value="<?php echo $result['FnationalId'];?>" style="display:none;"/>
      <input type="text" class="form-control" name="ser" value="<?php echo $result['serial'];?>" style="display:none;"/>
       <input type="text" class="form-control" id="url" value="<?php echo "http://81.21.104.151/verify.php"?>" style="display:none;"/>
       
      <section class="container mt-3">
      <div class="pic" style="display:block;">
     <canvas id="myCanvas" width="150" height="150"
style="border:1px solid #000000;">

</canvas><br><span>ختم شعار الجمهورية</span>
      </div>
<div class="row">
              <div class="col-3 mr-4 font-weight-bold"><p class="text-right font-weight-bold"><?php echo "تاريخ الإصدار : " . $result['date']; ?></p></div>
        	<div class="col-4 font-weight-bold"> <p class="text-right font-weight-bold"><?php echo "اسم الوحدة: " . $result['location']; ?></p></div>
       <div class="col-4 font-weight-bold"> <p class="text-right font-weight-bold"><?php echo "المحافظة: " . $result['governorate']; ?></p></div>
        </div>
               <h3 class="container-fluid headOfPersonal mb-2 pb-1" style="border: 2px solid black; font-weight: bold;">البيانات الأساسية 
            </h3>
            
<section>
    <div id="form-container" class="form-container-Marriage pr-3 mb-1 pb-2">
        <div class="row">
         
             
             <div class="col-5">
                  <p  style="font-size: 18px; font-family: cairo;">
                      الاسم : <span class="font-weight-bold"><?php echo $result['uname'];?>  </span></p>
             </div>
                 <div class="col-4"> 
                     <p  style="font-size: 18px; font-family: cairo;">
                        رقم جواز السفر :   <span class="font-weight-bold"><?php echo $result['FnationalId'];?></span></p></div>
              <div class="col-2"> 
                     <p style="font-size: 18px; font-family: cairo;">
             النوع :   <span class="font-weight-bold"><?php echo $result['gender'];?></span>
        </p>
            </div>

        
        </div>
        <div class="row">
              <div class="col-5">
                  
              <p style="font-size: 18px; font-family: cairo;">  بلد الجنسية : <span class="font-weight-bold"><?php echo $result['country'];?></span></div>
                  
                  
                  <div class="col-4">
                      <p  style="font-size: 18px; font-family: cairo;">
                          السن :  <span class="font-weight-bold"><?php echo $result['age'];?></span></p>
                          
            </div>
            <div class="col-3">
                      <p  style="font-size: 18px; font-family: cairo;">
            تليفون :   <span class="font-weight-bold"><?php echo $result['phone'];?></span>
        </p>
            </div>
       
         </div>
           
                         <div class="row">
                                  <div class="col-5">
                                      <p  style="font-size: 18px; font-family: cairo;">  العنوان بالبطاقة : <span class="font-weight-bold"><?php echo $result['address'];?>  </span></p></div>
                  
                  <div class="col-5">
              <p  style="font-size: 18px; font-family: cairo;">
           عنوان سكن الزوجية :   <span class="font-weight-bold"><?php echo $result['marriageAddress'];?></span>
        </p>
            </div>
                       
    </div>
    </div>
     
     <h3 class="container-fluid headOfPersonal mb-2 pb-1" style="border: 2px solid black; font-weight: bold;">بيانات الزواج 
      
            </h3>
    <div class="form-container-Marriage text-right mb-1 pb-2" style="background-color:#eeeeee;">
          
                     <div class="row">
                                       <div class="col-4">
                                           <p class="mr-3" style="font-size: 18px; font-family: cairo;"> هل توجد قرابة مع الطرف الاخر : <span class="font-weight-bold"><?php echo $result['ifRelate'];?>  </span></p></div>
                         
                         <div class="col-5">
                         
                         <p style="font-size: 18px; font-family: cairo;">
          هل يوجد زواج سابق :   <span class="font-weight-bold"><?php echo $result['previousMarriage'];?></span>
        </p>
            </div>
                     
                                 
</div>        
                <div class="row"> 
                               <div class="col-4">
                                   <p  class="mr-3" style="font-size: 18px; font-family: cairo;"> هل يوجد اطفال من الزواج السابق : <span class="font-weight-bold"><?php echo $result['childern'];?>  </span></p></div>
                    <div class="col-5">
                         <p  style="font-size: 18px; font-family: cairo;">
         هل يوجد لدى الاطفال اى امراض وراثية :   <span class="font-weight-bold"><?php echo $result['geneticDiseases'];?></span>
                    
        </p>
        </div>
            </div>       
             </div>	
    
    <h3 class="container-fluid headOfPersonal mb-2 pb-1" style="border: 2px solid black; font-weight: bold;">الفحوصات الطبية
            </h3>
        <div class="form-container-rep text-right mb-1 pb-2" style="background-color:#eeeeee;">
            
            
               <div class="row">
                    <div class="col-4">
                        <p class="mr-3"  style="font-size: 18px; font-family: cairo;"> الطول(سم) : <span class="font-weight-bold"><?php echo $result['height']  ;?>  </span></p></div>
                 <div class="col-4">
                        <p  style="font-size: 18px; font-family: cairo;">   
         الوزن(كجم) :   <span class="font-weight-bold"><?php echo $result['weight'];?></span>
                     </p></div>
                   
                           <div class="col-4">
                        <p  style="font-size: 18px; font-family: cairo;"> 
                    BMI: <span class="font-weight-bold" ><?php echo $result['bmi'];?>  </span>     
        </p>
            </div>
   
                    </div>
                
           
                     <div class="row">
                               <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> 
                  
                  RH :  <span class="font-weight-bold"><?php echo $result['rh'];?>  </span>
                                   </p></div>
                      <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">
                  فصيلة الدم: <span class="font-weight-bold" ><?php echo $result['abo'];?>  </span>
                  
                  
                  
                
        </p>
            </div>
                      <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">    
             Hb :   <span class="font-weight-bold" ><?php echo $result['hb'];?></span>
                          </p></div>
                    
            </div>
            
            <div class="row">
            <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> 
                hbsAg : <span class="font-weight-bold"><?php echo $result['hbsag'];?>  </span> 
                     </p></div>
                <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;"> 
              Anti-HIV :   <span class="font-weight-bold"><?php echo $result['hiv'];?></span>    
                  
                  
                  
                
        </p>
            </div>	
                <div class="col-4">
              <p style="font-size: 18px; font-family: cairo;">
        Anti-HCV : <span class="font-weight-bold"><?php echo $result['hcv'];?>  </span>
                  
                  
                  
                
        </p>
            </div>
            </div>
            
            
              <div class="row">
                       <div class="col-4">
              <p class="mr-3" style="font-size: 18px; font-family: cairo;"> هل يوجد إصابة بمرض ضغط الدم : <span class="font-weight-bold"><?php echo $result['bloodPresure'];?>  </span>
                           </p></div>
                  <div class="col-4">
              <p  style="font-size: 18px; font-family: cairo;">
                  الضغط :   <span class="font-weight-bold"><?php echo $result['systolic'];?>/<?php echo $result['diastolic'];?></span></p></div>
                  
             
                  
            </div> 
           
            <div class="row">
                        <div class="col-4">
              <p  class="mr-3" style="font-size: 18px; font-family: cairo;">
                  هل يوجد إصابة بمرض السكر : <span class="font-weight-bold"><?php echo $result['diabetes'];?> 
                  </span></p></div>
                  
                  <div class="col-4">
              <p style="font-size: 18px; font-family: cairo;">
                  نتيجة فحص السكر(العشوائى) : <span class="font-weight-bold"><?php echo $result['diabetesCheck'];?>  </span></p></div>
             
                  

</div>
			       
		  
    </div>
         
     <h3 class="container-fluid headOfPersonal mb-1 pb-1" style="border: 2px solid black; font-weight: bold;"> إقرار المنتفع بإعلامه بنتيجة الفحص وتوصيات الطبيب 
            </h3>
     <div class="form-container-Marriage text-right" style="background-color:#eeeeee;">
       
           <div class="row pt-2">
       
          <div class="col-4">
           <p class="mr-3"> اسم الممرضة : ----------------------</p>
            <p class="mr-3"> اسم الطبيب : ----------------------</p>
            <p class="mr-3"> مدير الوحدة  : ----------------------</p>
           </div>
           <div class="col-4">
               <p class="mr-3"> التوقيع : ----------------------</p> 
               <p class="mr-3"> التوقيع : ----------------------</p> 
               <p class="mr-3"> التوقيع : ----------------------</p> 
           </div>
               
              <div class="col-3">
                 <canvas id="myCircle" width="180" height="125"></canvas>
           <p style="padding-top:2px; padding-right:45px;">ختم الوحدة</p>
           </div>  
               
               
       </div>
       
        <hr style="color:black;">
       <div class="row pt-2">
           <div class="col-6">
               <p class="mr-3" style="font-size: 18px; font-family: cairo;">  أقر أنا الموقع أدناه : <span class="font-weight-bold"><?php echo $result['uname'];?>  </span></p></div>
            <div class="col-4">
               <p class="mr-3" style="font-size: 18px; font-family: cairo;">   رقم جواز السفر :   <span class="font-weight-bold"><?php echo $result['FnationalId'];?>  </span></p></div>
       </div>
         
           
    <p class="mr-3" style="font-size: 18px; font-family: cairo;">بأنه قد تم إعلامى بنتيجة الفحص الطبى والتوصيات الطبية المذكورة سابقا وقد تلقيت المشورة الخاصة بحالتى الصحية وألتزم بإعلام طرف الزواج الأخر 
قبل إجراءات الزواج وأصبحت بذلك مسئول عما يترتب على ذلك دون أدنى مسئولية على المنشأة الصحية والفريق الطبى الذى يمثلها  .</p><br>
         
       <div class="row">
          <div class="col-4 border-left">
           <p class="mr-3"> الاسم (رباعى) : ------------------</p>
             <p class="mr-3"> التوقيع : -----------------------</p> 
           </div>
           <div class="col-3 border-left">
                 <canvas id="myCircle1" width="180" height="125"></canvas>
           <p style="padding-top:2px; padding-right:35px;">بصمة الإبهام </p>
           </div>
		   <div class="col-5">
		   <p class="mr-3"> اسم الطرف الاخر(رباعى) : ---------------</p>
             <p class="mr-3"> توقيع الطرف الاخر  : --------------------</p> 
		    <p class="mr-3"> الرقم القومى للطرف الاخر  : -------------</p> 
		   </div>
       
       </div>
	   <div class="row">
    
       <div class="col-sm-8"></div>     
  <div class="col-sm-4"><img src="https://chart.googleapis.com/chart?cht=qr&chl=Hello+World&chs=160x160&chld=L|0" class="qr-code img-thumbnail img-responsive" /></div>
       </div>
       <div class="row">
            <div class="col-sm-8"></div>
           
            <div class="col-sm-4 mb-1"> <p  style="color:black; font-weight:bold; font-size:14px;">SN:<?php echo $result['serial']; ?></p></div>
    </div>
    </div>
	   </section>
        </section>
        <button class="btn btn-lg text-white submitButton" type="submit" name="print"  id="print-button">طباعة </button>
         
        <button class="btn btn-lg text-white backButton" type="button" name="back" style="margin-left:200px;">
           <a href="search.php">رجوع</a></button>
        </form>
<?php } while($result=mysqli_fetch_array($query));
          }
                 else{
        ?>
                    <h4 class="text-center font-weight-bold mt-5">لا يوجد بيانات مُسجلة</h4>
                <?php 
                 }
          }
        
        }
        ?>
       
        <script src="../js/jquery-3.3.1.min.js"></script> 
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
        <script src=
	"https://code.jquery.com/jquery-3.5.1.js">
</script>
       
        <script>
        
      var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
ctx.font = "16px Arial";
            ctx.textAlign = "left";
ctx.fillText("6*4",60,70);
        
         var c = document.getElementById("myCircle");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(100, 75, 50, 0, 2 * Math.PI);
ctx.stroke();   
            
       var c = document.getElementById("myCircle1");
var ctx = c.getContext("2d");
ctx.beginPath();
ctx.arc(100, 75, 50, 0, 2 * Math.PI);
ctx.stroke();
            
        </script>
        <script>
	// Function to HTML encode the text
	// This creates a new hidden element,
	// inserts the given text into it
	// and outputs it out as HTML
	function htmlEncode(value) {
	return $('<div/>').text(value)
		.html();
	}

	$(function () {

	// Specify an onclick function
	// for the generate button
	$(document).ready(function () {

		// Generate the link that would be
		// used to generate the QR Code
		// with the given data
		let finalURL =
'https://chart.googleapis.com/chart?cht=qr&chl=' +
	htmlEncode($('#url').val())  +
		'&chs=160x160&chld=L|0'

		// Replace the src of the image with
		// the QR code image
		$('.qr-code').attr('src', finalURL);
	});
	});
</script>
    </body>
</html>
		