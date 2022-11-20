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
       <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<script src="../js/jquery-3.3.1.min.js"></script> 
    </head>
 
            <script>
    
    $(document).ready(function(){
        
       $('#governorate').on('change',function(){
           
           var governorate= $(this).val();
           if(governorate){
               $.get(
                   "ajax.php",
                   {governorate: governorate},
                   function(data){
                   
                   $('#qism').html(data);
               
                   
               });
               
           }
           
           
       }); 
    $('#qism').on('change',function(){
           
           var qism= $(this).val();
           if(qism){
               $.get(
                   "unit.php",
                   {qism: qism},
                   function(data){
                   
                   $('#location').html(data);
               
                   
               });
               
           }
           
           
       }); 
    });       
            
    </script>
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
                    <a class="dropdown-item border-bottom text-center" href="home.php">الرئيسية</a>
                    <a class="dropdown-item border-bottom text-center" href="admin.php">الإدراة</a>
                    <a class="dropdown-item text-center" href="../index.php">تسجيل خروج</a>

                </div>
      </div>
        <div class="col-1"></div>
         <div class="col-4 pt-1">
             
        
        <img src="../img/100million.png" class="img-fluid" style="height:80px;" />
             
        </div>
    </div>
  </nav>
    <div class="pl-5 title text-center text-dark border-bottom mb-3 mt-4" style="background-color:#ffffff;">
             <div class="WOW fadeIn text-right" style="margin-top: 10px; visibility: visible; animation-name: fadeIn;">
    	<form name="login" id="login" action="" method="POST">
            <div class="row">
        <div id="gov" class="mb-3 col-3 mr-3">
            <label for="gov" class="form-label">المحافظة :</label>
            <select name="governorate" id="governorate" class="form-select w-75 form-control">
              <option value="not">--اختر--</option>
              <?php
      
                $query= "select DISTINCT governorate from users";
                $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
                while($row=mysqli_fetch_array($do)){
                    echo '<option value="'.$row['governorate'].'"  "selected">'.$row['governorate'].'</option>';
                }
              ?>
            </select>
          </div>
                
                
                     <div id="gov" class="mb-3 col-3">
            <label for="qism" class="form-label">الإدارة :</label>
            <select name="qism" id="qism" class="form-select w-75 form-control">
              <option value="not">--اختر--</option>
              <?php
      
                $query= "select DISTINCT qism from users";
                $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
                while($row=mysqli_fetch_array($do)){
                    echo '<option value="'.$row['qism'].'"  "selected">'.$row['qism'].'</option>';
                }
              ?>
            </select>
          </div>
                
                
                 <div id="gov" class="mb-3 col-3">
            <label for="location" class="form-label">اسم الوحدة :</label>
            <select name="location" id="location" class="form-select w-75 form-control">
              <option value="not">--اختر--</option>
              <?php
      
                $query= "select DISTINCT location from users";
                $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
                while($row=mysqli_fetch_array($do)){
                    echo '<option value="'.$row['location'].'"  "selected">'.$row['location'].'</option>';
                }
              ?>
            </select>
          </div>
                
   
             
            </div>
            
            
            <div class="row">
                         <div class="col-3 mr-3">
                    <label for="stdate" class="form-label">من :</label>
                <input type="date" name="stdate" id="stdate" class="form-control w-75" value="<?php echo $_POST['stdate'] ?? ''; ?>">
                </div>
                
 <div class="col-3">
                    <label for="endate" class="form-label">إلى :</label>
                <input type="date" name="endate" id="endate" class="form-control w-75" value="<?php echo $_POST['endate'] ?? ''; ?>">
            
                </div>
                
                 <div class="col-3">
                    <label for="NID" class="form-label">الرقم القومى :</label>
                <input type="number" name="NID" id="NID" class="form-control w-75" value="<?php echo $_POST['NID'] ?? ''; ?>">
            
                </div>
            <div class="col-2 mt-2"> 
                <button class="btn btn-lg text-white submitButton mt-4" type="submit" name="search">بحث</button>
                </div>
            </div>
        </form>
        </div>
     
            
            </div>      
       <?php
      if(isset($_POST['search'])){
          $governorate = $_POST['governorate'];
          $qism = $_POST['qism'];
          $location = $_POST['location'];
          $stdate = $_POST['stdate'];
          $endate = $_POST['endate'];
          $nationalId = $_POST['NID'];
if($governorate == 'not' && $qism == 'not' && $location == 'not'){
    $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
          }
elseif($governorate != 'not' && $qism != 'not' && $location != 'not'){ 
    $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where governorate = '$governorate' OR qism = '$qism' OR location = '$location' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where governorate = '$governorate' OR qism = '$qism' OR location = '$location'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
          }
elseif($governorate != 'not' && $qism == 'not' && $location == 'not'){
        $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where governorate = '$governorate' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where governorate = '$governorate'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}
          
elseif($governorate != 'not' && $qism != 'not' && $location == 'not'){
        $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where governorate = '$governorate' OR qism = '$qism' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where governorate = '$governorate' OR qism = '$qism'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}          
                   
elseif($qism != 'not' && $governorate == 'not' && $location == 'not'){
        $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where qism = '$qism' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where qism = '$qism'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}

elseif($qism != 'not' && $governorate == 'not' && $location != 'not'){
        $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where location = '$location' OR qism = '$qism' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where location = '$location' OR qism = '$qism'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}
elseif($qism == 'not' && $governorate == 'not' && $location != 'not'){
        $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where location = '$location' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where location = '$location'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}  
if($stdate != '' && $endate != ''){
      $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where date BETWEEN '$stdate' AND '$endate' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where date BETWEEN '$stdate' AND '$endate'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
}
if($nationalId != ''){
                  $limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users where nationalId = '$nationalId' LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users where nationalId = '$nationalId'");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit  );
if($page < 1){
    $page = 1;
}
	$Previous = $page - 1;
	$Next = $page + 1;
          }
          
      }
          
          
else{
$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 50;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
              $result = $conn->query("SELECT * FROM users LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
	$result1 = $conn->query("SELECT count(id) AS id FROM users");
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

          
            
            	<div class=" mt-5" style="border: 1px solid #eeeeee;"> 
        
		<div class="row border-bottom">
            <div class="col-5" ><h3 class="text-right pt-3 mr-4">إجمالى المسجلين <span class="font-weight-bold" style="color:red;">(<?php echo $total; ?>)</span></h3></div>
            <div class="col-5"> </div>
         <div class="col-1 ml-1 border-right pt-2" ><input type="image" onclick="exportTableToExcel('tblData')" src="../img/excel.png" style="height: 40px;"></div>
    
        </div>
		<div class="text-left ml-2" style="margin-top: 10px; " class="col-md-3">
				<form method="post" action="#">
                     <label for="limit-records" class="form-label mr-3">عدد السجلات لكل صفحة :</label>
						<select name="limit-records" id="limit-records">
							<option  selected="selected">100</option>
							<?php foreach([100,500,1000,5000] as $limit): ?>
								<option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>
		<div style="overflow-x: auto; margin-x:10px;">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                       <th>م</th>
                   <th>تاريخ التسجيل</th>
                        <th>مكان التشخيص</th>
                   <th>الإدارة</th>
                        <th>المحافظة</th>
	                    <th>الاسم</th>
	                    <th>الرقم القومى </th>
	                    <th>السن</th>
                   <th>الوزن</th>
                   <th>الطول</th>
	                    <th>مؤشر كتلة الجسم </th>
                   <th>إصابة بمرض السكر</th>
                    <th>إصابة بمرض الضغط</th>
                    <th>قياس السكر العشوائى </th>
                        <th>ضغط الدم</th>
                        <th>ABO</th>
	                    <th>RH </th>
                        <th>HB</th>
	                    <th>HBASAG </th>
                        <th>HCV</th>
	                    <th>HIV </th>
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['id'];?></td>
                                <td><?php echo $customer['date'];?></td>
    <td><?php echo $customer['location'];?></td>
                                <td><?php echo $customer['qism'];?></td>
      <td><?php echo $customer['governorate'];?></td>
      <td><?php echo $customer['uname'];?></td>
      <td><?php echo $customer['nationalId'];?></td>
      <td><?php echo $customer['age'];?></td>
                                <td><?php echo $customer['weight'];?></td>
                                <td><?php echo $customer['height'];?></td>
        <td><?php echo $customer['bmi'];?></td>
           <td><?php echo $customer['diabetes'];?></td>
            <td><?php echo $customer['bloodPresure'];?></td>
            <td><?php echo $customer['diabetesCheck'];?></td>
       <td><?php echo $customer['pressureCheck'];?></td>
      <td><?php echo $customer['abo'];?></td>
        <td><?php echo $customer['rh'];?></td>
      <td><?php echo $customer['hb'];?></td>
        <td><?php echo $customer['hbsag'];?></td>
     	<td><?php echo $customer['hcv'];?></td>
      <td><?php echo $customer['hiv'];?></td>
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        
        
<div style="background-color:transparent; " aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Previous; ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo; السابق</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
          
    
    <li class="page-item">
      <a class="page-link" href="followup.php?page=<?= $Next; ?>" aria-label="Next">
        <span aria-hidden="true">التالى &raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>
    </div>
              
        

      
        
          
          
           <footer>
        <p style="font-size:19px;"> &copy; 2021 جميع الحقوق محفوظة لوزارة الصحة و السكان المصرية. </p>
        </footer>
          
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>  
        <script src="../js/wow.min.js"></script> 
        <script>new WOW().init();</script> 
        <script src="../js/mine.js"></script>
           <script>
function exportTableToExcel(tableID, filename = 'مبادرة فحص قبل الزواج'){
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
  document.getElementById('location').value = "<?php echo $_POST['location'];?>";
     document.getElementById('stadte').value = "<?php echo $_POST['stdate'];?>";
               document.getElementById('endate').value = "<?php echo $_POST['endate'];?>";
</script>
    </body>
</html>