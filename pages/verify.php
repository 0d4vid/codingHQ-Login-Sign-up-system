<?php
require_once "../global/global.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET' ) {
  $fname = cleanData($_POST['fname']);
  $lname = cleanData($_POST['lname']);
  $email = cleanData($_POST['email']);
  $fnum = cleanData($_POST['fnum']);
  $password = cleanData($_POST['password']);
  $password = hashPassword($password);
  
  $optOption = cleanData($_POST['options']);
  session_start();
  
  $fnum = '237'.$fnum;

  $_SESSION["userEmail"] = $email;
  $_SESSION['userNumber'] = $fnum;

  
  require_once "connect.php";

  $sql = "SELECT * FROM user WHERE email = '$email' or fnum = '$fnum';";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    header("Location: ../signup.php?error=Email or Phone number already exist. log in instead");
  }
  else {
    $query = "INSERT user VALUES('', '$fname', '$lname', '$email', '$fnum', '$password', '$otp');";
    mysqli_query($conn, $query);
  }
  $message = "Your verification code is: ". $otp;
 /* if ($optOption == "fnum") {
    sendSMS($fnum, $message);
    
  }
  else {
    sendEmail($email, $message);
    
  }*/
}
  
else{
  header("Location: ../signup.php");
}

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.css" />
  </head>
  <body class="bg-light">
    <div class="container">
      <div class="row mt-5">
        <div class="col-6 m-auto ">
          <h2 class="text-center pt-3">Enter code</h2>
          <p class="mt-4">Averification code was sent</p>
          <form action="complete.php" method="post">
          <?php
              if (isset($_GET['error'])) {
                echo "<p class='bg-success text-white p-1 m-3'>".$_GET['error']."</p>";
              }
            ?>
          <div class="input-group mb-3">
              <input
              required
                type="text"
                class="form-control"
                name="code"
                placeholder="Enter code"
              />
            </div>
            <div class=" mt-3 d-grid">
              <button type="submit" class="btn btn-danger">Complete Verification</button>
             
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
