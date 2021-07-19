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

    // $sql = "SELECT * FROM `detail` ";
    // $result= mysqli_query($con,$sql);
    // echo $result;

    // $account_number= $_POST['account_number'];
    
    

    
    





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/info.css"> 
    <title>Information</title>
</head>
<body>

<?php
        if(isset($_SESSION['status']))
        {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
    ?>

<form class="registration-form">


    <?php 

      $account_number= $_GET['account_number'];


        $sql = "SELECT * FROM `detail` WHERE account_number = '$account_number'";
            // $sql='select * from detail where account_number="'.$account_number.'"';

            
        $result= mysqli_query($con,$sql);
            //echo $result;

            while($row = mysqli_fetch_assoc($result)){
                    
            ?>
            

        <div class="mb-3 row form-group">
            <label for="AccountNumber" class="col-sm-2 col-form-label">Account Number</label>
            <div class="col-sm-10">
            <input type="number" readonly class="form-control item" name="account_number" id="account_number" value="<?php echo  $row['account_number'] ?>" placeholder="Account Number">
            </div>
        </div>
        
        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Account Holder Name</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control item" name="name" id="name" value="<?php echo  $row['name'] ?>">
            </div>
        </div>


        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">E-mail</label>
            <div class="col-sm-10">
            <input type="email" readonly class="form-control item" name="email" id="email" value="<?php echo  $row['email']?>" placeholder="Email">

            </div>
        </div>

        
        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control item" name="gender" id="gender" value="<?php echo  $row['gender'] ?>" placeholder="Gender">

            </div>
        </div>


        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control item" name="address" id="address" value="<?php echo  $row['address'] ?>" placeholder="Address">

            </div>
        </div>

        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Contact Number</label>
            <div class="col-sm-10">
            <input type="number" readonly class="form-control item" name="number" id="number" value="<?php echo  $row['phoneno'] ?>" placeholder="Contact Number">

            </div>
        </div>

        <div class="mb-3 row form-group">
            <label for="AccountHolder" class="col-sm-2 col-form-label">Current Balance</label>
            <div class="col-sm-10">
            <input type="text" readonly class="form-control item" name="balance" id="balance" value="<?php echo  $row['balance'] ?>" placeholder="Balance">

            </div>
        </div>

        <div class="start">
    
            <a href="update.php?account_number=<?php echo $row['account_number']?>&name=<?php echo $row['name']?>&email=<?php echo $row['email']?>
                &gender=<?php echo $row['gender']?>&address=<?php echo $row['address']?>&phoneno=<?php echo $row['phoneno']?>&balance=<?php echo $row['balance']?>"> <button type='button' class='info btn btn-outline-primary end'>UPDATE</button></a>
                
            
            <a href="transact.php?account_number=<?php echo $row['account_number']?>&name=<?php echo $row['name']?>"> <button type='button' class='info btn btn-outline-primary end'>TRANSACT</button></a>
        </div>
    </form>
     </div>

              <?php 
            }

        
    ?>



<a href=customer.php><button class="back">GO BACK TO CUSTOMER PAGE </button></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    
</body>
</html>