<?php session_start(); require_once '../connection.php';?><html dir="rtl">
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
       <script src="../js/jquery-3.3.1.min.js"></script> 
              <script>
   $(document).ready(function() {

        $('#governorate').on('change', function() {

            var governorate = $(this).val();
            if (governorate) {
                $.get(
                    "ajax.php", {
                        governorate: governorate
                    },
                    function(data) {

                        $('#qism').html(data);

                    });

            } else {
                $('#qism').html('<option>اختر المحافظة اولا</option>')
            }

        });

    });

                
    </script>
	   <style>
           @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        body{
            font-family: 'Cairo', sans-serif; !important
        }
		   p{
			   font-size: 27px;
			   font-weight: 400;
		   }
           .card-body{
               width: 90%;
           }
	   </style>
    </head>
    <body style="background-color:#eeeeee;">
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
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
        
        <div class="title text-center text-dark border-bottom mb-1" style="background-color:#ffffff;">
        <h3 class="heading">تعديل بيانات المستخدم</h3>
            
            </div>
        <div class="container">
      <?php
            
    if(isset($_POST['update'])){
        $id = $_POST['id'];
           $user = "SELECT * FROM admins WHERE id = '$id' limit 1";
       $query = mysqli_query( $conn,$user) or die('error:'.mysqli_error($conn));
       $result = mysqli_fetch_array($query);
       $count= mysqli_num_rows($query);
          if($count > 0){
                 
              
       do{       
      ?>      
	<div class="card-body container WOW fadeIn text-right">
    	<form name="login" action="" method="POST">
         
             <div class="row">
                  <div class="col-4" style="display:none;">
 <label for="id">id :</label><br>
   <input type="text" name="id" class="form-control w-75" value="<?php echo $id; ?>" >
  </div>  
                <div class="col-4">       
            <label for="permission">الصلاحيات:</label>
    <select   name="permission" id="permission" class="form-control w-75">
        <?php
           if($result['permission'] == "1"){?>
               <option value="<?php echo '1' ?>"><?php echo 'مدير';?></option>
         <option  value="2">مدخل بيانات</option> 
      <option  value="3">تقارير</option>  
        
        
          <?php }
           elseif($result['permission'] == "2"){?>
                     <option value="<?php echo '2' ?>"><?php echo 'مدخل بيانات';?></option>
         <option  value="1">مدير</option> 
      <option  value="3">تقارير</option> 
       
          <?php }
           else{?>
              <option value="<?php echo '3' ?>"><?php echo 'تقارير';?></option>
         <option  value="1">مدير</option> 
      <option  value="2">مدخل بيانات</option>   
           <?php }
           ?>
        
        
        
    </select>
             </div>
                        <div class="col-4">
 <label for="unit">الاسم :</label><br>
   <input type="text" name="unit" class="form-control w-75" value="<?php echo $result['unit']; ?>">
  </div>  
          
                   <div class="col-4">
            <label for="username">اسم المستخدم:</label><br>
   <input type="text" name="username" class="form-control w-75"  value="<?php echo $result['username']; ?>">
    
            </div>
                
 
    
                
            </div>
                  <div class="row mt-3">
                  <div id="gov" class="mb-3 col-4">
                            <label for="gov" class="form-label">المحافظة :</label>
                           <input type="text" name="governorate" class="form-control w-75"  value="<?php echo $result['governorate']; ?>">
                        </div>
                
  <div id="qismDIV" class="mb-3 col-4">
                            <label for="qism" class="form-label">المركز :</label>
                            <input type="text" name="qism" class="form-control w-75"  value="<?php echo $result['qism']; ?>">
                        </div>

         <div class="col-1 mt-4">
             <?php if($result['activation'] == '1'){?>
               <input class="form-check-input" type="checkbox" value="1" id="ACTIVE" style="width:18px;height:18px;" checked><label class="control-label col-md-4 form-check-label mr-2" for="ACTIVE">
                        مفعل
                    </label>
          <?php }
             else{?>
              <input class="form-check-input" type="checkbox" value="1" id="ACTIVE" name="active" style="width:18px;height:18px;" ><label class="control-label col-md-4 form-check-label mr-2" for="ACTIVE">
                        مفعل
                    </label>   
            <?php }
             ?>
    </div>
                
 
            </div>
            <div class="row">  
   
   <div class="col-4" style="margin-top:28px;">
                 <button class="btn btn-lg text-white submitButton mt-3 float-right" type="submit" name="editUser" style="margin-right:50px; paddint-top:5px; padding-bottom:5px;">تعديل</button>
        <button class="btn btn-lg text-white backButton mt-3 mr-3" type="button" name="back" onclick="location.href='home.php'">رجوع</button>
        </div>
                </div>
           
          
           
            
        
             </form>
            </div>
				</div>	
 
     
           
   
        
<?php
       }
              while($result=mysqli_fetch_array($query));
          }
    }
    
    if(isset($_POST['editUser'])){
        $id = $_POST['id'];
        $permission = $_POST['permission'];
        $unit = $_POST['unit'];
        $username = $_POST['username'];
        $governorate = $_POST['governorate'];
        $qism = $_POST['qism'];
        $active = $_POST['active'];
        
            $ins="UPDATE admins SET governorate='$governorate',qism='$qism',unit='$unit',username='$username',permission=' $permission ',activation='$active' where id = '$id' ";  
$query= mysqli_query($conn,$ins) or die("error:".mysqli_error($conn));
        if($query) 
{
     echo '<script type="text/javascript">';
     echo ' alert("تم التعديل بنجاح");';
    echo'window.location.href="editAdmin.php";';
    echo '</script>';  
}
 else{
      echo '<script type="text/javascript">';
     echo ' alert("لم يتم التعديل");';
    echo'window.location.href="editAdmin.php";';
    echo '</script>';  
 }
    }        
            
            
            
            
            
            
            
            
            
            
            
            
            
?>

        <footer style="position:fixed; margin-top:3px;">
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        
        </footer>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
        <script>
        function perm(){
            var permission = document.getElementById("permission").value;
            if(permission == '2'){
                document.getElementById("gov").style.display = "block";
                 document.getElementById("qismDIV").style.display = "block";   
            }
            else{
                 document.getElementById("gov").style.display = "none";
                 document.getElementById("qismDIV").style.display = "none";   
            }
        }
        
        
        </script>
    </body>
</html>