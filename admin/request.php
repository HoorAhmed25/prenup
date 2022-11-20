<?php session_start();if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    header("Location: ../index.php");
    die();
} else{include '../connection.php'; require_once 'header.php'; ?><html dir="rtl">
    
    
    
    
    </html>
<?php
      }?>