<?php
require_once "./global/global.php";

  $fname = cleanData($_POST['fname']);
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
    header("Location: ./index2.html?error=Email or Phone number already exist. log in instead");
  }
  else {
    $query = "INSERT user VALUES('', '$fname', '$email', '$fnum', '$password', '$otp');";
    mysqli_query($conn, $query);
  }
  $message = "Your verification code is: ". $otp;
 if ($optOption == "fnum") {
    sendSMS($fnum, $message);
    
  }
  else {
    sendEmail($email, $message);
    
  }



?>




<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>Vérification d'email</title>
  <link rel="stylesheet" href="style/style.css">
  <script type="module" src="script.js" defer></script>

</head>
<body>
    <div class="main">
        

      <form action="site.php" method="post">

      <div>
            <h1> OTP verification</h1>
        <div class="maininput">
            <label>A code has been send to your email, Use it to verify your identity</label>
            <input type="text" name="code" id="verificationCode" placeholder="Code de vérification">
        </div>
        <button type="submit" id="verifyButton" class="btn" style="margin-top: 50px ;">Vérifier</button>
        </div>
        <div>
      </form>
           
        
    </div>
  



  
</body>

<script src="script.js"></script>
<!-- The core Firebase JS SDK is always required and must be listed first-->
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js"></script>
<!--Others firebase products we gona use-->
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.0/firebase-database.js"></script>

</html>
