<?php
if(isset($_GET['qism']) && !empty($_GET['qism'])){
   
    include ('../connection.php');
    $id= $_GET['qism'];
    $query= "select DISTINCT location from users where qism='$id'";
    $do= mysqli_query($conn,$query);
    $count= mysqli_num_rows($do);
    if($count >0){
        
        echo '<option>--اختر--</option>';
        while($row= mysqli_fetch_array($do)){
            
            echo '<option value="'.$row['location'].'">'.$row['location'].'</option>';
        }
        
    }

    else {
        echo 'error1';
    }
}



else{
    
    echo 'Error';
}

?>