<?php
session_start (); 
include '../connection.php';
if(isset($_POST['print'])){
    $user = $_SESSION['unit'];
    $nid = $_POST['nid'];
    $serial = $_POST['ser'];
    $date = date("Y/m/d");
    $ins="INSERT INTO print(serial,nationalId,date,user)VALUES ('$serial','$nid','$date','$user')";
$query= mysqli_query($conn,$ins) or die("error:".mysqli_error($conn));
    if($query){
        echo '<script type="text/javascript">';echo'window.location.href="search.php";';echo '</script>';
    }
}
?>