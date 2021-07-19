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

    $sql = "SELECT * FROM `detail` ";
    $result= mysqli_query($con,$sql);
    // // echo $result;
    $num=mysqli_num_rows($result);
    





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="css/customer.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <!-- jquery including -->
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>

    
    
    
    
    <title>Customer Details</title>
</head>
<body>


<h1>CUSTOMER DETAILS</h1>

    <?php
        if(isset($_SESSION['status']))
        {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
    ?>



<table class="table table-striped table-dark" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center" >S. No.</th>
      <th scope="col" class="text-center" >Account Number</th>
      <th scope="col" class="text-center" >Name</th>
      <th scope="col" class="text-center" >E-Mail</th>
      
      <th scope="col" class="text-center" >Balance</th>
      <th scope="col" class="text-center" >Actions</th>

    </tr>
  </thead>
  <tbody>


        <?php 
        $sql = "SELECT * FROM `detail` ";
        $result= mysqli_query($con,$sql);
        // echo $result;
        
        
        if($num>0){
            $no=0;
            
            while($row = mysqli_fetch_assoc($result)){
                $no= $no + 1;
                ?>
                <tr class="table-danger">
                    <th scope='row' class="text-center"><?php echo $no ?></th>
                    <td class="text-center"><?php echo $row['account_number']?></td>
                    <td class="text-center"><?php echo $row['name']?></td>
                    <td class="text-center"><?php echo $row['email']?></td>
                    
                    <td class="text-center"><?php echo $row['balance']?></td>
                    <td class="text-center"> 
                        <a href="info.php?account_number=<?php echo $row['account_number'];?>"> <button type='button' class='info btn btn-outline-info'>Info</button></a>
                        <a href="update.php?account_number=<?php echo $row['account_number']?>&name=<?php echo $row['name']?>&email=<?php echo $row['email']?>
                        &gender=<?php echo $row['gender']?>&address=<?php echo $row['address']?>&phoneno=<?php echo $row['phoneno']?>&balance=<?php echo $row['balance']?>"> <button type='button' class='info btn btn-outline-primary'>UPDATE</button></a>
                        <form style="display:inline-block" method="post" action="delete.php">
                            <input type='hidden' name='account_number' value="<?php echo $row['account_number']?>">
                            <button type='submit' class='btn btn-outline-success'>Delete</button>
                        </form>
                    </td>

                </tr>
                <?php 
            }

        }
     

       
     ?>
    

  </tbody>
</table>




<a href=index.php><button class="back">👈 GO TO HOME  </button></a>

    <!-- <script> 
        info=document.getElementsByClassName('info');
        Array.from(info).forEach((element)=>{
            element.addEventListener("click",(i)=>{
                console.log("info",);
                tr=i.target.parentNode.parentNode;
                account_numberInfo=tr.getElementsByTagName("td")[0].innerText;
                nameInfo=tr.getElementsByTagName("td")[1].innerText;
                emailInfo=tr.getElementsByTagName("td")[2].innerText;
                genderInfo=tr.getElementsByTagName("td")[3].innerText;
                balanceInfo=tr.getElementsByTagName("td")[4].innerText;
                console.log(account_number,name.email,gender,balance);
                account_number = account_numberInfo ;
                name= nameInfo ;
                email = emailInfo;
                gender= genderInfo;
                balance = balanceInfo;
                $('#infoModal').modal('toggle');

            })
        })

    </script> -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <!--Datables files to be included-->
    <link rel="stylesheet" href=" //cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    
    </script>


    <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="js/main.js"></script>

</body>
</html>