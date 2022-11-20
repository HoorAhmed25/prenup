<?php include '../connection.php'; require_once 'header.php'; ?>
<html dir="rtl">
<head>
    <style>
    
        #details{
            border: 0;
            background-color: transparent;
            cursor: pointer;
        }
        
        #details a{
            color: #09c;
            
        }
    
    </style>
    <script src="../js/jquery-3.3.1.min.js"></script> 
    </head>

    <body>
      <h4 class="text-center pt-3 mr-4 font-weight-bold"> تقرير عدد مرات الطباعة  </h4>
        
 <div class="pl-5 pt-3 title text-center text-dark mb-3" style="background-color:#ffffff;">
    <div class=" WOW fadeIn text-right">
      <form name="login" id="login" action="" method="POST">
        <div class="row mr-3">
   
   <div id="national" class=" col-2">
            <label for="nationalId" class="form-label">الرقم القومى :</label>
            <input type="text" class="form-control " name="nationalId" id="nationalId" maxlength="14"
              autocomplete="off" onkeypress="return isNumberKey(event)" onchange="validationID()">
            <p id="idError" style="display:none; color:red;">*خطأ فى الرقم القومى</p>

          </div>
              <div id="ser" class=" col-2">
            <label for="serial" class="form-label">رقم الوثيقة :</label>
            <input type="text" class="form-control " name="serial" id="serial" 
              autocomplete="off" onkeypress="return isNumberKey(event)" >
           

          </div>
           <div class="col-2">
                    <label for="stdate" class="form-label">من :</label>
                <input type="date" name="stdate" id="stdate" class="form-control" value="<?php echo $_POST['stdate'] ?? ''; ?>">
                </div>
                
 <div class="col-2">
                    <label for="endate" class="form-label">إلى :</label>
                <input type="date" name="endate" id="endate" class="form-control" value="<?php echo $_POST['endate'] ?? ''; ?>">
            
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
        $stdate = $_POST['stdate'];
        $endate = $_POST['endate'];
        $nationalId = $_POST['nationalId'];
        $serial = $_POST['serial'];
        if($stdate != '' && $endate != '' && $nationalId != '' && $serial != ''){
        $result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where serial = '$serial' and nationalId = '$nationalId' and date between '$stdate' AND '$endate' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
          else if($stdate != '' && $endate != '' && $serial != ''){
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where serial = '$serial' and date between '$stdate' AND '$endate' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
                 else if($stdate != '' && $endate != '' && $nationalId != ''){
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where nationalId = '$nationalId' and date between '$stdate' AND '$endate' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
                else if($stdate != '' && $endate != ''){
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where date between '$stdate' AND '$endate' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
               else if($serial != ''){
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where serial = '$serial' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
               else if($nationalId != ''){
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print where nationalId = '$nationalId' GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
          }
        else{
           $result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    }
else{
$result = $conn->query("SELECT serial,nationalId,count(*) as total FROM print GROUP by serial,nationalId LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);       
        }           

	$result1 = $conn->query("SELECT count(id) AS id FROM print");
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
                       <th class="text-center" style="word-wrap: break-word;">الرقم القومى</th>
                   <th class="text-center" style="word-wrap: break-word;">رقم الوثيقة</th>
                        <th class="text-center" style="word-wrap: break-word;">عدد مرات الطباعة</th>
    
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['nationalId'];?></td>
                                <td><?php echo $customer['serial'];?></td>
    <td>
        <form action="details.php" method="post" target="_blank">
          <input type="text" name="nid" value="<?php echo $customer['nationalId'];?>" style="display:none;"/>
      <input type="text" name="ser" value="<?php echo $customer['serial'];?>" style="display:none;"/>
            <button type="submit" name="details" id="details"><a><?php echo $customer['total'];?></a></button>
        </form>
        
                                
                                
                                </td>
                                
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        

    </div>
              
               <script>
function exportTableToExcel(tableID, filename = 'مبادرة فحص ما قبل الزواج'){
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
   document.getElementById('nationalId').value = "<?php echo $_POST['nationalId'];?>";
                   document.getElementById('serial').value = "<?php echo $_POST['serial'];?>";
     document.getElementById('stadte').value = "<?php echo $_POST['stdate'];?>";
               document.getElementById('endate').value = "<?php echo $_POST['endate'];?>";
</script>
    </body>