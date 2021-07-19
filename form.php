<?php

    $insert=false;
    $servername="localhost";
    $username="root";
    $password = "";
    $database="bank";
    

    $con= mysqli_connect($servername, $username, $password, $database);

    if(!$con){
        die("connection to this databse failed due to". mysqli_connect_error());
    }
    // echo "connection successful";

    $account_number= '';
    $name = '';
    $email = '';
    $gender = '';
    $address='';
    $phoneno='';
    $balance = '';

    
    $errors=[];
    
    
    
    // echo $_SERVER['REQUEST_METHOD'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $account_number= $_POST['account_number'];
        $name= $_POST['name'];
        $email=  $_POST['email'];
        $gender= $_POST['gender'];
        $address=$_POST['address'];
        $phoneno=$_POST['phoneno'];
        $balance= $_POST['balance'];


        if(!$account_number){
            $errors[]= "PLEASE PROVIDE AN ACCOUNT NUMBER";
        }
        
        if(!$name){
            $errors[]= "PLEASE PROVIDE A NAME";
        }

        if(!$email){
            $errors[]= "PLEASE PROVIDE A E-MAIL";
        }

        if(!$gender){
            $errors[]= "PLEASE PROVIDE A GENDER";
        }

        if(!$balance){
            $errors[]= "PLEASE PROVIDE A BALANCE";
        }



        if(empty($errors)){
        
            $sql= "INSERT INTO `detail` (`account_number`, `name`, `email`, `gender`, `address`, `phoneno`, `balance`, `dt`) 
            VALUES ('$account_number', '$name', '$email', '$gender', '$address', '$phoneno', '$balance', current_timestamp());";
            //echo $sql;

            $result= mysqli_query($con,$sql);

            if($result){
                $insert=true;
                $account_number= '';
                $name = '';
                $email = '';
                $gender = '';
                $address='';
                $phoneno='';
                $balance = '';
                
                
            }else{
                echo "there is an error in the connection". mysqli_error($con);
            }

        }
 

    }



    // if($con->query($sql) == true){
    //     echo "succesfully inserted";
    // }else{
    //     echo "Error $sql <br> $con->error";
    // }

    // $con->close();


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="css/form.css">   
</head>
<body>
<?php
        if($insert){
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>SUCCESS!</strong> Account has been created sucessfully.
            
            <button type='button' class='close' data-bs-dismiss='alert'>&times;</button>
            </div>";
        }

    ?>
    <!-- <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>&times;</button> -->

<div class="registration-form">
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error):?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    
    <form method="post" action="form.php">

        <h2> CREATE NEW USER</h2>

        <div class="form-group">
            <!-- <label>name</label> -->
            <input type="number" class="form-control item" name="account_number" id="account_number" value="<?php echo $account_number ?>" placeholder="Account Number">
        </div>
        
        <div class="form-group">
            <!-- <label>name</label> -->
            <input type="text" class="form-control item" name="name" id="name" value="<?php echo $name ?>" placeholder="Name">
        </div>
        <div class="form-group">
            <!-- <label>email</label> -->
            <input type="email" class="form-control item" name="email" id="email" value="<?php echo $email ?>" placeholder="Email">
        </div>
        <div class="form-group">
            <!-- <label>gender</label> -->
            <input type="text" class="form-control item" name="gender" id="gender" value="<?php echo $gender ?>" placeholder="Gender">
        </div>
        <div class="form-group">
            <!-- <label>gender</label> -->
            <input type="text" class="form-control item" name="address" id="address" value="<?php echo $address ?>" placeholder="Address">
        </div>
        <div class="form-group">
            <!-- <label>gender</label> -->
            <input type="number" class="form-control item" name="phoneno" id="phoneno" value="<?php echo $phoneno ?>" placeholder="Contact Number">
        </div>
        <div class="form-group">
            <!-- <label>balance</label> -->
            <input type="text" class="form-control item" name="balance" id="balance" value="<?php echo $balance ?>" placeholder="Balance">
        </div>
        <button type="submit" class="btn btn-primary end">CREATE ACCOUNT</button>
    </form>
</div>

<a href=index.php><button class="search">👈 GO TO HOME </button></a>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>

