<?php
/*
if(isset($_GET['phone']) && !empty($_GET['phone'])){
 $curl = curl_init();
 //
 $url = 'https://wloop.net/engine/messages/sendMessage';
 $headers = array(
 'CHANNELID: instance21444', // Channel ID
 'CHANNELTOKEN: bmglhawnv4i7sd3z', // ( Token )
 );
 $data = [
 'phone' => '01014461347', // Recipient's phone
 'body' => 'hello', // content of the message
 ];
 curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 curl_setopt_array($curl, array(
 CURLOPT_URL => $url,
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => '',
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 0,
 CURLOPT_FOLLOWLOCATION => true,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => 'POST',
 CURLOPT_POSTFIELDS => json_encode($data),
 ));

 // POST
 $response = curl_exec($curl);
 curl_close($curl);
    }
echo 'error';
*/
   
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.ultramsg.com/instance21444/messages/chat",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "token=bmglhawnv4i7sd3z&to=+201014461347&body=WhatsApp API on UltraMsg.com works good&priority=1&referenceId=",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
?>