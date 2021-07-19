<?php

    
    $servername="localhost";
    $username="root";
    $password = "";
    $database="bank";

    $errors=[];
    

    $con= mysqli_connect($servername, $username, $password, $database);

    if(!$con){
        die("connection to this databse failed due to". mysqli_connect_error());
    }
    // echo "connection successful";

    $account_number= $_GET['account_number'];
    $name = $_GET['name'];
    $email = $_GET['email'];
    $gender = $_GET['gender'];
    $address=$_GET['address'];
    $phoneno=$_GET['phoneno'];
    $balance = $_GET['balance'];


    if(isset($_GET['update']))
{

    $accnum=$_GET['account_number'];
    $namec=$_GET['name'];
    $emailc=$_GET['email'];
    $genderc=$_GET['gender'];
    $addressc=$_GET['address'];
    $phonenoc=$_GET['phoneno'];
    $balancec=$_GET['balance'];

    if(!$accnum){
        $errors[]= "ACCOUNT NUMBER FIELD CANNOT BE EMPTY!";
    }
    
    if(!$namec){
        $errors[]= "NAME FIELD CANNOT BE EMPTY!";
    }

    if(!$emailc){
        $errors[]= "E-MAIL FIELD CANNOT BE EMPTY!";
    }

    if(!$genderc){
        $errors[]= "GENDER FIELD CANNOT BE EMPTY!";
    }

    if(!$balancec){
        $errors[]= "BALANCE FIELD CANNOT BE EMPTY!";
    }

    if(empty($errors)){

            $sql="UPDATE `detail` SET `account_number` ='$accnum', `name` = '$namec', `email`='$emailc', 
                    `gender`= '$genderc', `address`= '$addressc', `phoneno`= '$phonenoc', `balance`= '$balancec', `dt`=current_timestamp() 
                    WHERE `detail`.`account_number` = '$accnum';";
                    
            $query=mysqli_query($con,$sql);

            if($query)
            {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Account has been updated sucessfully.</strong>
            <button type='button' class='close' data-bs-dismiss='alert'>&times;</button>
            </div>";
            }
            else{
            echo "error in updating the database";
            }

    }

   


}

    
    

    ?>

    


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/form.css">   
</head>
<body>


<div class="registration-form">
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error):?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
    
    
    <form>  

        <h1>UPDATE THE EXIXSTING USER</h1>        

        <div class="mb-3 row form-group">
            <label for="AccountNumber" class="col-sm-2 col-form-label">Account Number</label>
            <div class="col-sm-10">
            <input type="number" class="form-control item" name="account_number" id="account_number" value="<?php echo $account_number?>" placeholder="Account Number">
            </div>
        </div>
        
        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Account Holder Name</label>
            <div class="col-sm-10">
            <input type="text" class="form-control item" name="name" id="name" value="<?php echo $name ?>">
            </div>
        </div>


        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
            <input type="email" class="form-control item" name="email" id="email" value="<?php echo $email?>" placeholder="Email">

            </div>
        </div>

        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
            <input type="text" class="form-control item" name="gender" id="gender" value="<?php echo $gender ?>" placeholder="Gender">

            </div>
        </div>


        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" class="form-control item" name="address" id="address" value="<?php echo $address ?>" placeholder="Address">

            </div>
        </div>

        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Contact Number</label>
            <div class="col-sm-10">
            <input type="number" class="form-control item" name="phoneno" id="phoneno" value="<?php echo $phoneno ?>" placeholder="Contact Number">

            </div>
        </div>

        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Current Balance</label>
            <div class="col-sm-10">
            <input type="text" class="form-control item" name="balance" id="balance" value="<?php echo $balance?>" placeholder="Balance">

            </div>
        </div>


        <input type="submit" name="update" id="update" class="back" value="UPDATE">



    </form>
</div>

        

<a href=customer.php><button class="back">GO BACK TO CUSTOMER DETAILS PAGE </button></a>



<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>