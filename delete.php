<?php

session_start();

$servername="localhost";
$username="root";
$password = "";
$database="bank";


$con= mysqli_connect($servername, $username, $password, $database);

if(!$con){
    die("connection to this databse failed due to". mysqli_connect_error());
}
// echo "connection successful";


    $anum=$_POST['account_number']??null;
    // if(!$id){
    //     header('Location:customer.php');
    //     exit;
    // }

    $sql = "DELETE FROM `detail` WHERE `detail`.`account_number` = '$anum'";
    $result= mysqli_query($con,$sql);

    

    if($result){

        $_SESSION['status']="<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Account has been deleted sucessfully.</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";

        header("Location:customer.php");
        

    }

    


    
    



?>


