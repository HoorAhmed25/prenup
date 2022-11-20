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
        <h4 class="text-center pt-3 mr-4 font-weight-bold"> التفاصيل  </h4> 
        <?php
         if(isset($_POST['details'])){
        $nationalId = $_POST['nid'];
        $serial = $_POST['ser'];
        
      $result = $conn->query("SELECT serial,nationalId,count(*) as total,user,date FROM print where serial = '$serial' and nationalId = '$nationalId' GROUP by user,date order by date DESC");
	$customers = $result->fetch_all(MYSQLI_ASSOC);       
                  


          }
          ?>
            	<div class="mx-5 mt-5" style="border: 1px solid #eeeeee;"> 
        
	
		<div style="overflow-x: auto; margin-x:10px;">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                        <th class="text-center" style="word-wrap: break-word;">الرقم القومى</th>
                        <th class="text-center" style="word-wrap: break-word;">رقم الوثيقة</th>
                        <th class="text-center" style="word-wrap: break-word;">اسم المستخدم</th>
                   <th class="text-center" style="word-wrap: break-word;">تاريخ الطباعة</th>
                        <th class="text-center" style="word-wrap: break-word;">عدد مرات الطباعة</th>
    
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['nationalId'];?></td>
                                <td><?php echo $customer['serial'];?></td>
                                   <td><?php echo $customer['user'];?></td>
                                <td><?php echo $customer['date'];?></td>
    <td>
      <?php echo $customer['total'];?>
     
        
                                
                                
                                </td>
                                
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        

    </div>
    </body>
</html>
