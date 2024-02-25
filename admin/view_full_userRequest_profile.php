<!-- Include php files -->
<?php 
    ob_start();
        session_start();
        include_once("../dbConfig.php");
        $id = $_GET['profile_id'];
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full User Request Profile</title>
    <style>
            <?php 
                include "../css/admin.css";
                include "../css/styles.css";
            ?>
        </style>
</head>
   
<body>
    
<div class="header_sidebar">
      </div>
      <div class="row">
         <div class="col-2">
            <?php include 'admin_header_sidebar.php';?>
         </div>
         <div class="col-10 justify-content-center">
         <div class=" main_content">
            <div class="dashboard">
               <h1><b>Skyline Public Library<b></h1>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-6"><div class="h2">View User Details</div></div>
                
            </div>

        <?php
            $full_user_request_details = mysqli_query($mysqli,"SELECT * FROM `users` WHERE user_id = $id");
            while($row = mysqli_fetch_array($full_user_request_details)){
                // echo $row['first_name'];
                $_SESSION['email'] = $row['email_id'];
          
        ?>
       
    <div class="row m-4 table-responsive">
    <div class="col-2"></div>
     <div class="col-10">
        <form action="" class="" method="post">
            <div class="mb-3 row">
                <label for="fname" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="fname" name="fname" value="<?php echo $row['first_name']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="lname" name = "lname" value="<?php echo $row['last_name']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="email" name = "email" value="<?php echo $row['email_id']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="contactNo" class="col-sm-2 col-form-label">Contact No</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="phone" name = "phone" value="<?php echo $row['contact_number']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="profilePicture" class="col-sm-2 col-form-label">Profile Picture</label>
                <div class="col-sm-10">
                    <img style='height:100px; width: 100px;' src="../images/<?php echo $row['image']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="contactNo" class="col-sm-2 col-form-label">Photo ID</label>
                <div class="col-sm-10">
                    <img style='height:100px; width: 100px;' src="../images/<?php echo $row['residence_proof']; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="contactNo" class="col-sm-2 col-form-label">Address </label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="address" name = "address" value="<?php echo $row['address']; ?>">
                </div>
            </div>

            <div class="row-g-3">
                <div class="col-auto user_buttons">
                    <button class="btn btn-success"  id="approve" name = "approve">Approve</button>
                    <button class="btn btn-success" id = "decline" name = "decline">Decline</button>
                    <button class="btn btn-success" id = "back" name ="back" >Back</button>
                </div>
            </div>
        </form>
            </div>
            

    </div>  <!-- End of main-content div -->
  
    <?php
      }
    ?>

    <?php
        
        //approve user request
        if (isset($_POST['approve'])) {
        // $status = $_GET['account_status'];
        
        $approve_user_request = "UPDATE `users` SET `account_status`='0' WHERE user_id = $id";
        $user_approved = mysqli_query($mysqli,$approve_user_request);
            if($user_approved){
            echo '
                <script>
                    window.location.href = "send_mail.php"
                </script> 
            ';
            
            }
        }  
    ?>

    <?php
    //decline user
        if (isset($_POST['decline'])) {
            // echo "Hello";
            // die();   
             $decline_user_request = "DELETE FROM `users` WHERE user_id = $id";
             $user_decline = mysqli_query($mysqli,$decline_user_request);
             if($user_decline){
                echo '
                <script>
                    // alert("User Request Deleted Successfully!!")
                    window.location.href = "send_decline_mail.php"
                </script> 
            ';
             }
        }

        //user redirect back
        if (isset($_POST['back'])) {
        
            echo '
                <script> 
                    window.location.href = "user_requests.php";
                </script>
            ';

        }
        
    ?>
</div>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php
            include "../js/admin.js";
        ?>
    </script>
    
</body>
</html>