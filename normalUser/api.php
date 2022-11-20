<?php
//  API url
if(isset($_POST['submit'])){
    if($_POST['hcv'] == "متفاعل"){
        $hcv = 1;
    }
    elseif($_POST['hcv'] == "غير متفاعل"){
        $hcv = 0;
    }
    
     if($_POST['hbsag'] == "متفاعل"){
        $hbv = 1;
    }
    elseif($_POST['hbsag'] == "غير متفاعل"){
        $hbv = 0;
    }

      if($_POST['hiv'] == "متفاعل"){
        $hiv = 1;
    }
    elseif($_POST['hiv'] == "غير متفاعل"){
        $hiv = 0;
    }

    
    
$url = 'https://www.nccvh.org.eg/api2/wedding-reservation';

// Initializes a new cURL session
$curl = curl_init($url);

// Set custom headers for Auth and Content-Type header
curl_setopt($curl, CURLOPT_USERPWD, "hbv21:pnyv7578");
// Data 
$data = [
  
    "nid"=> $_POST['nationalId'],
    "name" => $_POST['uname'],
    "mobile" => $_POST['phone'],
    "hcv" => $hcv,
    "hbv" => $hbv,
    "hiv" => $hiv
];

// Set the CURLOPT_RETURNTRANSFER option to true
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Set the CURLOPT_POST option to true for POST request
curl_setopt($curl, CURLOPT_POST, true);

// Set the request data as JSON using json_encode function
curl_setopt($curl, CURLOPT_POSTFIELDS,  json_encode($data));

// Execute cURL request with all previous settings
$response = curl_exec($curl);
$result = json_decode($response, true);

$msg = $result['msg'];
$reservationId = $result['reservationId'];
 if(strlen($response) != 139){
     echo "done";
     echo '<script type="text/javascript">';
     echo 'alert("رقم الحجز : " + "'.$reservationId.'" + "\n"  "'.$msg.'" )';
     echo '</script>';
      
  }
    /*
     else{
             $nid = $result['nid'];
    $cname = $result['cname'];
      $entered_date = $result['entered_date'];
      $hcv = $result['hcv'];
      $hbv = $result['hbv'];
      $hiv = $result['hiv'];
      if($hcv == 1){
          $hcv = "مصاب بفيروس C";
      }
      else{
         $hcv = "غير مصاب بفيروس C "; 
      }
       if($hbv == 1){
          $hbv = "مصاب بفيروس B";
      }
      else{
         $hbv = "غير مصاب بفيروس B "; 
      }
       if($hiv == 1){
          $hiv = "مصاب بفيروس نقص المناعة البشرية";
      }
      else{
         $hiv = "غير مصاب بفيروس نقص المناعة البشرية "; 
      }
     echo '<script type="text/javascript">';
     echo ' alert("الرقم القومى : " + "'.$nid.'" + "\n" + "الاسم : " + "'.$cname.'" + "\n" + "تاريخ التسجيل : " + "'.$entered_date.'" 
     + "\n" + "'.$hcv.'" + "\n" + "'.$hbv.'" + "\n" + "'.$hiv.'");';
     echo '</script>';
 
    }
    */
// Close cURL session
curl_close($curl);
echo $response."\n";
echo gettype($response)."\n";
echo strlen($response);
//echo $nid;
//echo $msg;
    
    
    
    
    
 
}
?>