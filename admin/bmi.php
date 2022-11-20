<?php include '../connection.php'; require_once 'header.php'; ?>
<html dir="rtl">


    <body>
      <h4 class="text-center pt-3 mr-4 font-weight-bold"> تقرير مؤشر كتلة الجسم بين المتقدمين لفحص قبل الزواج </h4>
        
      <div class="pl-5 pt-3 title text-center text-dark mb-3" style="background-color:#ffffff;">
    <div class=" WOW fadeIn text-right">
      <form name="login" id="login" action="" method="POST">
        <div class="row mr-3">
          <div id="gov" class="mb-3 col-2">
            <label for="gov" class="form-label">المحافظة :</label>
            <select name="governorate" id="governorate" class="form-select  form-control">
              <option value="none">--اختر--</option>
             <?php
      
       $query= "select DISTINCT governorate from users";
       $do= mysqli_query($conn,$query)or die('error'.mysqli_error($conn));
       while($row=mysqli_fetch_array($do)){
      echo '<option value="'.$row['governorate'].'"  "selected">'.$row['governorate'].'</option>';
       }
       ?>
            </select>
          </div> 
       <div id="ageG" class="mb-3 col-2">
            <label for="age" class="form-label">الفئة العمرية :</label>
            <select name="age" id="age" class="form-select  form-control">
                <option value="none">الكل</option>
                <option value="1">18-30</option>
                <option value="2">31-40</option>
                <option value="3">اكبر من 40</option>
            </select>
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
        $governorate = $_POST['governorate'];
                $age = $_POST['age'];
        if($stdate != '' && $endate != '' && $governorate != 'none' && $age == '1'){
        $result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and date between '$stdate' AND '$endate' and age between 18 and 30  GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
        elseif($stdate != '' && $endate != '' && $governorate != 'none' && $age == '2'){
        $result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and date between '$stdate' AND '$endate' and age between 31 and 40  GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
                  elseif($stdate != '' && $endate != '' && $governorate != 'none' && $age == '3'){
        $result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and date between '$stdate' AND '$endate' and age > 40  GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
          elseif($stdate != '' && $endate != '' && $governorate != 'none' && $age == 'none'){
        $result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and date between '$stdate' AND '$endate' GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);
            }
     
   
elseif($stdate == '' && $endate == '' && $governorate != 'none' && $age == 'none'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
elseif($stdate == '' && $endate == '' && $governorate != 'none' && $age == '1'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and age between 18 and 30 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    elseif($stdate == '' && $endate == '' && $governorate != 'none' && $age == '2'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and age between 31 and 40 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
                    elseif($stdate == '' && $endate == '' && $governorate != 'none' && $age == '3'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where governorate = '$governorate' and age > 40 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
                elseif($stdate == '' && $endate == '' && $governorate == 'none' && $age == '1'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where age between 18 and 30 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
                elseif($stdate == '' && $endate == '' && $governorate == 'none' && $age == '2'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where age between 31 and 40 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
                 elseif($stdate == '' && $endate == '' && $governorate == 'none' && $age == '3'){
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users where age > 40 GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    else{
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users GROUP by governorate order by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC); 
        }
    }
else{
$result = $conn->query("SELECT governorate,count(id) as total,sum(case when gender = 'أنثى' then 1 else 0 end) as Female,sum(case when gender = 'ذكر' then 1 else 0 end) as Male,
sum(case when BMI < 19 then 1 else 0 end) as underweight,sum(case when BMI < 19 AND gender = 'أنثى' then 1 else 0 end) as underweightFemale,sum(case when BMI < 19 and gender = 'ذكر' then 1 else 0 end) as underweightMale,
sum(case when BMI BETWEEN 19 and 24 then 1 else 0 end) as normal,sum(case when BMI BETWEEN 19 and 24 AND gender = 'أنثى' then 1 else 0 end) as normalFemale,sum(case when BMI BETWEEN 19 and 24 and gender = 'ذكر' then 1 else 0 end) as normalMale,
sum(case when BMI BETWEEN 25 and 29 then 1 else 0 end) as overweight,sum(case when BMI BETWEEN 25 and 29 AND gender = 'أنثى' then 1 else 0 end) as overweightFemale,sum(case when BMI BETWEEN 25 and 29 and gender = 'ذكر' then 1 else 0 end) as overweightMale,
sum(case when BMI BETWEEN 30 and 34 then 1 else 0 end) as obese,sum(case when BMI BETWEEN 30 and 34 AND gender = 'أنثى' then 1 else 0 end) as obeseFemale,sum(case when BMI BETWEEN 30 and 34 and gender = 'ذكر' then 1 else 0 end) as obeseMale,
sum(case when BMI BETWEEN 35 and 39 then 1 else 0 end) as serve,sum(case when BMI BETWEEN 35 and 39 AND gender = 'أنثى' then 1 else 0 end) as serveFemale,sum(case when BMI BETWEEN 35 and 39 and gender = 'ذكر' then 1 else 0 end) as serveMale,
sum(case when BMI BETWEEN 40 and 45 then 1 else 0 end) as morbid,sum(case when BMI BETWEEN 40 and 45 AND gender = 'أنثى' then 1 else 0 end) as morbidFemale,sum(case when BMI BETWEEN 40 and 45 and gender = 'ذكر' then 1 else 0 end) as morbidMale, 
sum(case when BMI > 45 then 1 else 0 end) as super,sum(case when BMI > 45 AND gender = 'أنثى' then 1 else 0 end) as superFemale,sum(case when BMI > 45 and gender = 'ذكر' then 1 else 0 end) as superMale from users GROUP by governorate ORDER by governorate LIMIT $start,$limit");
	$customers = $result->fetch_all(MYSQLI_ASSOC);       
        }            
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
            	<div class="mx-5 mt-5" style="border: 1px solid #eeeeee;"> 
        
	
		<div style="overflow-x: auto; margin-x:10px;">
			<table id="tblData" class="table table-striped table-bordered">
	        	<thead>
	           <tr>
                       <th class="text-center" style="word-wrap: break-word;">المحافظة</th>
                   <th class="text-center" style="word-wrap: break-word;" colspan="3">الإجمالى</th>
                        <th class="text-center" style="word-wrap: break-word;" colspan="3">Underweight</th>
                   <th class="text-center" style="word-wrap: break-word;" colspan="3">Normal</th>
                        <th class="text-center" style="word-wrap: break-word;" colspan="3"> 
                       Overweight
                   </th>
	                    <th class="text-center" style="word-wrap: break-word;" colspan="3"> 
                   Obese
                            </th>
	                    <th class="text-center" style="word-wrap: break-word;" colspan="3"> 
                        Severe obesity
                   </th>
                     <th class="text-center" style="word-wrap: break-word;" colspan="3"> 
                        Morbid obesity
                   </th>
                     <th class="text-center" style="word-wrap: break-word;" colspan="3"> 
                        Super obesity
                   </th>
	              	</tr>
                    
                    
                    
                           <tr>
                          <th></th>
                        <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                               <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>
                               
                        <th class="text-center" style="word-wrap: break-word;">ذكر</th>
	                    <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                            <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>
                               
                               <th class="text-center" style="word-wrap: break-word;">ذكر</th>
	                    <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                             <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>
                               
                   <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                        <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>
                               
                     <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                           <th class="text-center" style="word-wrap: break-word;">الإجمالى</th> 
                               
                        <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                             <th class="text-center" style="word-wrap: break-word;">الإجمالى</th>   
                               
                        <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                             <th class="text-center" style="word-wrap: break-word;">الإجمالى</th> 
                                <th class="text-center" style="word-wrap: break-word;">ذكر</th>
                   <th class="text-center" style="word-wrap: break-word;">أنثى</th>
                             <th class="text-center" style="word-wrap: break-word;">الإجمالى</th> 
                               
                               
	              	</tr>
	          	</thead>
	        	<tbody>
	        		<?php foreach($customers as $customer) :  ?>
	 		    		    <tr>
    <td><?php echo $customer['governorate'];?></td>
    <td><?php echo $customer['Male'];?></td>
      <td><?php echo $customer['Female'];?></td>                            
         <td><?php echo $customer['total'];?></td>
                                
      <td><?php echo $customer['underweightMale'];?></td>
      <td><?php echo $customer['underweightFemale'];?></td>                            
         <td><?php echo $customer['underweight'];?></td>
                                
      <td><?php echo $customer['normalMale'];?></td>
      <td><?php echo $customer['normalFemale'];?></td>                            
         <td><?php echo $customer['normal'];?></td>                          
                                
          <td><?php echo $customer['overweightMale'];?></td>
      <td><?php echo $customer['overweightFemale'];?></td>                            
         <td><?php echo $customer['overweight'];?></td>                            
                                
           <td><?php echo $customer['obeseMale'];?></td>
      <td><?php echo $customer['obeseFemale'];?></td>                            
         <td><?php echo $customer['obese'];?></td> 
                                
       <td><?php echo $customer['serveMale'];?></td>
      <td><?php echo $customer['serveFemale'];?></td>                            
         <td><?php echo $customer['serve'];?></td>                           
                                
        <td><?php echo $customer['morbidMale'];?></td>
      <td><?php echo $customer['morbidFemale'];?></td>                            
         <td><?php echo $customer['morbid'];?></td>                          
                                
                                
         <td><?php echo $customer['superMale'];?></td>
      <td><?php echo $customer['superFemale'];?></td>                            
         <td><?php echo $customer['super'];?></td>                         
                                
                                
                                
      </tr>
	        		<?php endforeach; ?>
	        	</tbody>
      		</table>

      		
		</div>

        

    </div>
              
               <script>
function exportTableToExcel(tableID, filename = 'مبادرة فحوصات ما قبل الزواج'){
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
               document.getElementById('age').value = "<?php echo $_POST['age'];?>";
     document.getElementById('stadte').value = "<?php echo $_POST['stdate'];?>";
               document.getElementById('endate').value = "<?php echo $_POST['endate'];?>";
</script>
    
    </body>