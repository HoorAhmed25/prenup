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
                    "ajax4.php", {
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
        <h3 class="heading">مستخدمى النظام</h3>
            </div>
           <div class="pl-5 title text-center text-dark border-bottom mb-3" style="background-color:#ffffff;">
             <div class=" WOW fadeIn text-right" style="margin-top:10px;">
    	<form name="login" id="login" action="" method="POST">
            <div class="row">
    <div id="gov" class="mb-3 col-2 mr-5">
    <label for="gov" class="form-label">المحافظة :</label>
    <select name="governorate" id="governorate" class="form-select  form-control" >
      <option value="none">--اختر--</option>
        <?php
      
       $query= "select DISTINCT governorate from admins where governorate != ''";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['governorate'].'"  "selected">'.$row['governorate'].'</option>';
       }
       ?>
    </select>                               
  </div>
                 <div id="followHospital" class="mb-3 col-2">
    <label for="qism" class="form-label">القسم :</label>
    <select name="qism" id="qism" class="form-select form-control" >
      <option value="none">--اختر--</option>
         <?php
      
       $query= "select DISTINCT qism from admins where qism != ''";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['qism'].'"  "selected">'.$row['qism'].'</option>';
       }
       ?>
       
    </select>                               
  </div>
           <div class="col-2 mr-5">
    <label for="uname" class="form-label">اسم الوحدة :</label>
    <input type="text" class="form-control " name="name" id="name" maxlength="50" autocomplete="off"  onkeypress="return CheckArabicCharactersOnly(event);">
    
  </div>  
            </div>
            
            
            <div class="row">
<div class="col-2 mr-5">
    <label for="uname" class="form-label">اسم المستخدم :</label>
    <input type="text" class="form-control " name="uname" id="uname" maxlength="50" autocomplete="off"  onkeypress="return CheckArabicCharactersOnly(event);">
    
  </div>
          <div class="col-2">       
            <label for="permission">الصلاحيات:</label>
    <select   name="permission" id="permission" class="form-control">
    <option value="">--اختر--</option>
    <option  value="1">مدير </option>
    <option  value="2">مدخل بيانات</option> 
      <option  value="3">تقارير</option>   
    </select>
             </div>
            </div>
               <div class="row">
              <div class="col-5"></div>
          <div class="col-4">
            <button class="btn btn-lg text-white submitButton mt-4" type="submit" name="search">بحث</button>
               <button class="btn btn-lg text-white mt-4" type="button" name="excel" onclick="exportTableToExcel('tblData')" style="background-color: #127c5b;">اكسيل</button>
             <button class="btn btn-lg text-white backButton mt-4" type="button" name="back" onclick="location.href='home.php'">رجوع</button> 
            
          </div>
              
        </div>
        </form>
        </div>
     
            
            </div>
 
    <?php
         {
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 100;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
               if(isset($_POST['search'])){
        $qism = $_POST['qism'];
        $name = $_POST['name'];
        $uname= $_POST['uname'];
        $permission = $_POST['permission'];
        $governorate = $_POST['governorate'];
        if($governorate != 'none' && $qism == 'none'){
        $result = $conn->query("SELECT * FROM admins where governorate = '$governorate' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
          else if($governorate != 'none' && $qism != 'none'){
$result = $conn->query("SELECT * FROM admins where governorate = '$governorate' and qism = '$qism' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
       else if($name != ''){
$result = $conn->query("SELECT * FROM admins where unit = '$name'");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          } 
        else if($uname != ''){
$result = $conn->query("SELECT * FROM admins where username = '$uname' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          } 
                   else if($permission != ''){
$result = $conn->query("SELECT * FROM admins where permission = '$permission' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          } 
        else{
           $result = $conn->query("SELECT * FROM admins LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    }
  else{
           $result = $conn->query("SELECT * FROM admins LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
   $result1 = $conn->query("SELECT count(id) AS id FROM admins");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
              
          }     
        ?>
         
        
         	<div class="mx-5 mt-5" style="border: 1px solid #eeeeee;"> 
        
	
		<div style="overflow-x: auto; margin-x:10px;">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                       <th class="text-center" style="word-wrap: break-word;">المحافظة</th>
                   <th class="text-center" style="word-wrap: break-word;">القسم</th>
                        <th class="text-center" style="word-wrap: break-word;">اسم الوحدة</th>
                   <th class="text-center" style="word-wrap: break-word;">اسم المستخدم</th>
                        <th class="text-center" style="word-wrap: break-word;"> 
                       الصلاحيات
                   </th>
	                  <th></th>  
	              	</tr>
                    
         
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
                     <form method="post" action="fetch.php">
	 		    		    <tr>
    <td><?php echo $customer['governorate'];?></td>
    <td><?php echo $customer['qism'];?></td>
      <td><?php echo $customer['unit'];?></td>                            
         <td><?php echo $customer['username'];?></td>
                                
      <td>
          
          <?php
          if($customer['permission'] == '1'){
              echo 'مدير';
          }
          elseif($customer['permission'] == '2'){
              echo 'مدخل بيانات';
          }
          else{
            echo 'تقارير';  
          }
         
          
          
          ?>
                                
                                
                                
                                </td>
                       <td>
                           <input type="text" name="id" value="<?php echo $customer['id']; ?>" style="display:none;" >
                           <button type="submit" name="update" class="btn text-white" style="background-color: #127c5b;">تعديل</button>
                                </td>
                                
                                
                                
      </tr>
                    </form>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

          <div style="background-color:transparent; " aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="editAdmin.php?page=<?= $Previous; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo; السابق</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
          
    
    <li class="page-item">
      <a class="page-link" href="editAdmin.php?page=<?= $Next; ?>" aria-label="Next">
        <span aria-hidden="true">التالى &raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>

    </div>
  
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
          <script>
function exportTableToExcel(tableID, filename = 'مبادرة الاعتلال الكلوى'){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType 
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        //triggering the function
        downloadLink.click() }}
</script>
            <script type="text/javascript">
   document.getElementById('governorate').value = "<?php echo $_POST['governorate'];?>";
                   document.getElementById('qism').value = "<?php echo $_POST['qism'];?>";
     document.getElementById('name').value = "<?php echo $_POST['name'];?>";
               document.getElementById('uname').value = "<?php echo $_POST['uname'];?>";
               document.getElementById('permission').value = "<?php echo $_POST['permission'];?>";  
                
                
</script>
    </body>
</html>