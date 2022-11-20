<?php 
require_once 'header.php'; 
 require_once '../connection.php'; 
 $query = "SELECT gender, count(*) as number from users GROUP BY gender";  
 $result = mysqli_query($conn, $query);  
$query1 = "SELECT governorate, count(*) as number from users GROUP BY governorate order by number";  
 $result1 = mysqli_query($conn, $query1);
$query2 = "SELECT nationality, count(*) as number from users GROUP BY nationality";  
 $result2 = mysqli_query($conn, $query2); 
$query3 = "SELECT bloodpresure, count(*) as number from users GROUP BY bloodpresure";  
 $result3 = mysqli_query($conn, $query3); 
$query4 = "SELECT diabetes, count(*) as number from users GROUP BY diabetes";  
 $result4 = mysqli_query($conn, $query4);
$query5 = "SELECT rh, count(*) as number from users GROUP BY rh";  
 $result5 = mysqli_query($conn, $query5); 
$query6 = "SELECT sum(case when bmi < 19 then 1 else 0 end) as underweight,sum(case when bmi BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when bmi BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when bmi BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when bmi BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when bmi BETWEEN 40 and 45 then 1 else 0 end) as morbid, sum(case when bmi > 45 then 1 else 0 end) as super , count(*) as number from users order by number";  
 $result6 = mysqli_query($conn, $query6); 
$query7 = "SELECT hcv, count(*) as number from users GROUP BY hcv";  
 $result7 = mysqli_query($conn, $query7);
$query8 = "SELECT hiv, count(*) as number from users GROUP BY hiv";  
 $result8 = mysqli_query($conn, $query8);
$query9 = "SELECT hbsag, count(*) as number from users GROUP BY hbsag";  
 $result9 = mysqli_query($conn, $query9);
$query10 = "SELECT abo, count(*) as number from users GROUP BY abo";  
 $result10 = mysqli_query($conn, $query10);
$query11 = "SELECT sum(case when hb >= 12 then 1 else 0 end) as totalnormal,sum(case when hb between 11 and 13 then 1 else 0 end) as totalrisk,sum(case when hb between 8 and 11 then 1 else 0 end) as totalanemia,sum(case when hb <  8 then 1 else 0 end) as totalvery, count(*) as number from users order by number";  
 $result11 = mysqli_query($conn, $query11);

$query12 = "SELECT count(*) as number,sum(case when diabetesCheck < 140 then 1 else 0 end) as normal,sum(case when diabetesCheck BETWEEN 140 and 200 then 1 else 0 end) as pre,sum(case when  diabetesCheck > 200 then 1 else 0 end) as diabetic from users order by number";  
 $result12 = mysqli_query($conn, $query12);
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head> 
          <style>
              p{
                  font-size: 20px;
              }
              .previous1{
	margin-top: 50px;
                
	cursor: pointer;
	box-shadow: 3px 4px 3px 4px #888888;
}
.previous1:hover{
	cursor: pointer;
	border-radius: 25px;
	box-shadow: 4px 5px 4px 5px #888888;
    transition: 0.5s;
}
          </style>
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           google.charts.setOnLoadCallback(drawChart1);  
           google.charts.setOnLoadCallback(drawChart2);
         google.charts.setOnLoadCallback(drawChart3);
        google.charts.setOnLoadCallback(drawChart4);
        google.charts.setOnLoadCallback(drawChart5);
        google.charts.setOnLoadCallback(drawChart6);
        google.charts.setOnLoadCallback(drawChart7);
        google.charts.setOnLoadCallback(drawChart8);
        google.charts.setOnLoadCallback(drawChart9);
        google.charts.setOnLoadCallback(drawChart10);
  google.charts.setOnLoadCallback(drawChart11);
google.charts.setOnLoadCallback(drawChart12);







                
              
   
   
             
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Gender', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["gender"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
               
               
               function drawChart1()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Governorate', 'الإجمالى'],  
                          <?php  
                          while($row = mysqli_fetch_array($result1))  
                          {  
                               echo "['".$row["governorate"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
legend:'none',
                    chartArea: {
            left: 0,
            right: 0
          }
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart1'));  
                chart.draw(data, options);  
           } 
                        function drawChart2()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Ntionality', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result2))  
                          {  
                               echo "['".$row["nationality"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart2'));  
                chart.draw(data, options);  
           }  
               
                  function drawChart3()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['bloodpresure', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result3))  
                          {  
                               echo "['".$row["bloodpresure"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart3'));  
                chart.draw(data, options);  
           }
            
               
               function drawChart4()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['diabetes', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result4))  
                          {  
                               echo "['".$row["diabetes"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart4'));  
                chart.draw(data, options);  
           }
                  
                function drawChart5()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['rh', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result5))  
                          {  
                               echo "['".$row["rh"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart5'));  
                chart.draw(data, options);  
           }
                  
               
                 function drawChart6()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','Underweight','Normal','Overweight','Obese','Serve obesity','Morbid obesity','Super obesity'],  
                          <?php  
                          while($row = mysqli_fetch_array($result6))  
                          {  
        echo "['',".$row["underweight"].",".$row["normal"].",".$row["overweight"].",".$row["obese"].",".$row["serve"].",".$row["morbid"].",".$row["super"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart6'));  
                chart.draw(data, options);  
           }
               
               
                function drawChart7()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['hcv', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result7))  
                          {  
                               echo "['".$row["hcv"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart7'));  
                chart.draw(data, options);  
           }
            
                   function drawChart8()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['hiv', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result8))  
                          {  
                               echo "['".$row["hiv"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart8'));  
                chart.draw(data, options);  
           }
               
                function drawChart9()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['hbsag', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result9))  
                          {  
                               echo "['".$row["hbsag"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart9'));  
                chart.draw(data, options);  
           }
               
                function drawChart10()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['abo', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result10))  
                          {  
                               echo "['".$row["abo"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
                    legend:'bottom',
                  
                      //is3D:true,  
                      pieHole: 0.4
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart10'));  
                chart.draw(data, options);  
           }
       

               
               
                    function drawChart11()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','طبيعي','أنيميا بسيطة','أنيميا متوسطة','أنيميا شديدة'],  
                          <?php  
                          while($row = mysqli_fetch_array($result11))  
                          {  
        echo "['',".$row["totalnormal"].",".$row["totalrisk"].",".$row["totalanemia"].",".$row["totalvery"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                       animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart11'));  
                chart.draw(data, options);  
           }    
               
               
               
               
                         function drawChart12()  
           {  
             var data = google.visualization.arrayToDataTable([  
                          ['الإجمالى','Normal','Prediabetic','Diabetic'],  
                          <?php  
                          while($row = mysqli_fetch_array($result12))  
                          {  
        echo "['',".$row["normal"].",".$row["pre"].",".$row["diabetic"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = { 
                        animation: {
          duration: 5000,
          easing: 'out',
          startup: true
      },
        
       legend:'bottom'
                     };  
                var chart = new google.visualization.ColumnChart(document.getElementById('piechart12'));  
                chart.draw(data, options);  
           }    
               
               
               
               
               
               
               
       
           </script>  
      </head>  
      <body>  
          <div class="container-fluid mb-5">
         <div class="row mb-5">
           <div class="previous1 col-11 mr-5 pt-5">   
              <p class="text-center font-weight-bold">الأعداد طبقاً للمحافظة</p>
                <div  id="piechart1" style="width: 100%; height: 500px;">
              </div>
           </div> 
             </div>
           <div class="row">
               <div class="col-1 "></div>
              <div class="previous1 col-4 mr-3  pt-2">
                  <p class="text-center font-weight-bold">النسب طبقاً للنوع</p>
                <div id="piechart" style="width: 500px; height: 300px;"></div>  
           </div>  
             
               <div class="col-1 "></div>
             <div class=" previous1 col-4  pt-2">     
                   <p class="text-center font-weight-bold">النسب طبقاً للجنسية</p>
                <div id="piechart2" style="width: 500px; height: 300px;"></div>  
           </div>
              </div>
              <div class="row">
                   <div class="col-1 "></div>
                 <div class="previous1 col-4 mr-3 pt-3">   
                     <p class="text-center font-weight-bold">النسب طبقاً للتاريخ المرضـي <br>للإصابة بإرتفاع ضغط الدم </p>
                <div  id="piechart3" style="width: 100%; height: 300px;"></div> 
           </div>
               <div class="col-1 "></div>
               <div class="previous1 col-4   pt-3">   
                   <p class="text-center font-weight-bold">النسب طبقاً للتاريخ المرضـي<br> للإصابة بالسكر</p>
                <div  id="piechart4" style="width: 100%; height: 300px;"></div> 
           </div> 
              </div>
                <div class="row">
               
              <div class="col-1 "></div>
               
               <div class="previous1 col-9 mr-3 pt-2"> 
                     <p class="text-center font-weight-bold"> نتائج فحص مؤشر كتلة الجسم</p>
                <div  id="piechart6" style="width: 100%; height: 350px;"></div> 
           </div> 
              </div>
              <div class="row">
                  <div class="col-1 "></div>
                <div class="previous1 col-3 mr-3  pt-2">
                  <p class="text-center font-weight-bold">HCV</p>
                <div id="piechart7" style="width: width: 100%; height: 300px;"></div>  
           </div>  
               
               <div class="previous1 col-3 mr-3  pt-2">
                  <p class="text-center font-weight-bold">HIV</p>
                <div id="piechart8" style="width: 100%; height: 300px;"></div>  
           </div> 
               
               <div class="previous1 col-3 mr-3  pt-2">
                  <p class="text-center font-weight-bold">HBsAg</p>
                <div id="piechart9" style="width: 100%; height: 300px;"></div>  
           </div> 
              </div>
              <div class="row">
                  <div class="col-1 "></div>
                <div class="previous1 col-4 mr-3  pt-2">
                  <p class="text-center font-weight-bold"> RH factor</p>
                <div id="piechart5" style="width: 100%; height: 300px;"></div>  
           </div>  
                  <div class="col-1 "></div>
                <div class="previous1 col-4 mr-3  pt-2">
                  <p class="text-center font-weight-bold">النسب طبقاً لفصائل الدم</p>
                <div id="piechart10" style="width: 100%; height: 300px;"></div>  
           </div> 
                   
               
               
              </div>
                  <div class="row">
               
              
               
               <div class="previous1 col-5 mr-5 pt-2"> 
                     <p class="text-center font-weight-bold"> الأعداد طبقاً لنتائج فحص الهيموجلوبين</p>
                <div  id="piechart11" style="width: 100%; height: 350px;"></div> 
           </div>
                      <div class="col-1"></div>
                    <div class="previous1 col-5 mr-3 pt-2"> 
                     <p class="text-center font-weight-bold"> الأعداد طبقاً لنتائج قياسات السكر العشوائى</p>
                <div  id="piechart12" style="width: 100%; height: 350px;"></div> 
           </div>   
              </div>
                     
              
         
          </div>
      </body>  
 </html>  