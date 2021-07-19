<?php 
    $servername="localhost";
    $username="root";
    $password = "";
    $database="bank";

    $insert=false;
    

    $con= mysqli_connect($servername, $username, $password, $database);

    if(!$con){
        die("connection to this databse failed due to". mysqli_connect_error());
    }
    // echo "connection successful";

   
    $sname='';
    $saccount='';
    $rname='';
    $raccount='';
    $amount='';
    $msg='';

    
    $errors=[];


     
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['transact']))
        {

            $sname=$_POST['sname'];
            $saccount=$_POST['saccount'];
            $rname=$_POST['rname'];
            $raccount=$_POST['raccount'];
            $amount=$_POST['amount'];
            $msg=$_POST['msg'];

            if(!$sname){
                $errors[]= "PLEASE PROVIDE SENDER'S NAME";
            }
            
            if(!$saccount){
                $errors[]= "PLEASE PROVIDE SENDER'S ACCOUNT NUMBER";
            }
    
            if(!$rname){
                $errors[]= "PLEASE PROVIDE RECEIVER'S NAME";
            }
    
            if(!$raccount){
                $errors[]= "PLEASE PROVIDE RECEIVER'S ACCOUNT NUMBER";
            }
    
            if(!$amount){
                $errors[]= "PLEASE PROVIDE AMOUNT TO BE TRANSFERRED";
            }

            if(empty($errors)){
        
            

                $sql = "SELECT * FROM `detail` WHERE account_number = '$saccount'";
                echo $con->error;
                $query= mysqli_query($con,$sql);
                $sql1=mysqli_fetch_array($query);
                echo $con->error;
                $sql= "SELECT * FROM `detail` WHERE account_number = '$raccount'";
                $query= mysqli_query($con,$sql);
                // echo $query;
                $sql2=mysqli_fetch_array($query);
                echo $con->error;
                // echo $amount;
                echo $con->error;
                // echo $sql1['balance'];
                echo $con->error;

                if(($amount) < 0){

                    echo '<script type="text/javascript">';
                    echo 'alert("negative value cannot be entered")';
                    echo '</script>';
                }
                else if(($amount) > $sql1['balance']){
            
                    echo '<script type="text/javascript">';
                    echo 'alert("Insufficient Balance")';
                    echo '</script>';
                }

                else{

                    $new= $sql1['balance'] - $amount;
                    echo $con->error;
                    $sqls= 'UPDATE detail set balance= "'.$new.'" where account_number="'.$saccount.'"';
                    mysqli_query($con,$sqls);
                    $new= $sql2['balance'] + $amount;
                    $sqlr= 'UPDATE detail set balance= "'.$new.'" where account_number="'.$raccount.'"';
                    mysqli_query($con,$sqlr);
            
                    $sqlup="INSERT INTO `transaction`(`sendername`,`senderaccount`,`receivername`,`receiveraccount`,`amount`, `msg` )
                        VALUES('$sname','$saccount','$rname','$raccount','$amount','$msg');";
                    $result=mysqli_query($con,$sqlup)
                    or die (mysqli_error($con));
                    
                        $new=0;
                        $amount=0;

                        if($result){
                            $insert=true;
                            $sname= '';
                            $saccount = '';
                            $rname = '';
                            $raccount = '';
                            $amount='';
                            $msg='';
                            
                        }else{
                            echo "there is an error in the connection". mysqli_error($con);
                        }

                        
                }

                    
           

                
            }


        }

    }
    



    
?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>-->
    
    <link rel="stylesheet" href="css/transfer.css"> 
    


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
        crossorigin="anonymous"></script>

    <title>Transfer</title>
  </head>
  <body>

  <?php
        if($insert){
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Amount has been transferred successfully.</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }

    ?>


    <h1> TRANSACTIONS AND TO VIEW ALL TRANSACTIONS </h1>

    <div class="registration_form">
    <form class="transact" method="post">

    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error):?>
                <div><?php echo $error ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
        <section class="half">
        
            <div class="mb-3 debit">
                <label for="debitAccount" class="form-label">Account to be debited</label>
                <input type="number" class="form-control  item debited" name="saccount" id="saccount" value="<?php echo $saccount ?>">

                <script type="text/javascript">
                    $(function() {
                        $( "#saccount" ).autocomplete({
                        source: 'search.php',
                        });
                    });
                </script>


                <label for="debitName" class="form-label">Name</label>
                <input type="text" class="form-control  item debited" name="sname" id="sname" value="<?php echo $sname ?>">
            
                <script type="text/javascript">
                    $(function() {
                        $( "#sname" ).autocomplete({
                        source: 'searchn.php',
                        });
                    });
                </script>
        


            </div>
        
        </section>

        <section class="half">
            <div class="mb-3 debit">
                <label for="creditAccount" class="form-label">Account to be credited</label>
                <input type="number" class="form-control debited" name="raccount" id="raccount" value="<?php echo $raccount ?>">

                <script type="text/javascript">
                    $(function() {
                        $( "#raccount" ).autocomplete({
                        source: 'search.php',
                        });
                    });
                </script>

                <label for="creditName" class="form-label">Name</label>
                <input type="text" class="form-control debited" name="rname" id="rname" value="<?php echo $rname ?>">
          
                <script type="text/javascript">
                    $(function() {
                        $( "#rname" ).autocomplete({
                        source: 'searchn.php',
                        });
                    });
                </script>


            </div>
        </section>

   
        
        <section class="whole">

        <div class="mb-3 row">
            <label for="amount" class="col-sm-2 col-form-label">Amount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control"  name="amount" id="amount" value="<?php echo $amount ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="message" class="col-sm-2 col-form-label">Message</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="msg" id="msg">
            </div>
        </div>


        <button type="submit" class="btn btn-primary end" name="transact">TRANSACT</button>
        </section>

        
    </form>

    </div>


<table class="table table-striped table-dark" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th scope="col" class="text-center">S. No.</th>
      <th scope="col" class="text-center">Sender's Name</th>
      <th scope="col" class="text-center">Sender's Account Number</th>
      <th scope="col" class="text-center">Receiver's Name</th>
      <th scope="col" class="text-center">Receiver's Account Number</th>
      <th scope="col" class="text-center">Amount</th>
      

    </tr>
  </thead>
  <tbody>

    <?php 
        $sql = "SELECT * FROM `transaction` ";
        $result= mysqli_query($con,$sql);
        // echo $result;
        $num=mysqli_num_rows($result);
        
        if($num>0){
            $no=0;
            
            while($row = mysqli_fetch_assoc($result)){
                $no= $no + 1;
                ?>
                <tr class="table-danger">
                    <th scope='row' class="text-center"><?php echo $no ?></th>
                    <td class="text-center"><?php echo $row['sendername']?></td>
                    <td class="text-center"><?php echo $row['senderaccount']?></td>
                    <td class="text-center"><?php echo $row['receivername']?></td>
                    <td class="text-center"><?php echo $row['receiveraccount']?></td>
                    <td class="text-center"><?php echo $row['amount']?></td>
                    
                </tr>
                <?php 
            }

        }
     

       
     ?>
    

  </tbody>
</table>


    <a href=index.php><button class="btn search">👈 HOME PAGE </button></a>






   

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

   
  </body>
</html>