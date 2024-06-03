<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php
require_once "./global/global.php";
      require "./connect.php";
      session_start();

      $email =  $_SESSION["userEmail"];
      $fnum = $_SESSION['userNumber'];
      

        $code = cleanData($_POST['code']);
        $query = "SELECT * FROM user WHERE email = '$email' or fnum = '$fnum';";
        $results = mysqli_query($conn, $query);

        $userInfo = mysqli_fetch_assoc($results);

        
        if ($userInfo['otp'] == $code) {
          echo '<h1 style="color: antiquewhite;"> WELCOME TO OUR WEBSITE</h1>';


          
        }
        
      
    ?>
    <
</body>
</html>