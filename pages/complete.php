
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.css" />
  </head>
  <body class="bg-light">
    <?php
      require_once "../global/global.php";
      require "./connect.php";
      session_start();

      $email =  $_SESSION["userEmail"];
      $fnum = $_SESSION['userNumber'];
      

        $code = cleanData($_POST['code']);
        $query = "SELECT * FROM user WHERE email = '$email' or fnum = '$fnum';";
        $results = mysqli_query($conn, $query);

        $userInfo = mysqli_fetch_assoc($results);

        
        if ($userInfo['otp'] == $code) {
          echo "<h1 class='text-center mt-5'>You have verified your account</h1>
          <div class='text-center'>
            <a href='login.php' class='btn btn-danger btn-lg'>Log In</a>
          </div>";


          
        }
        
      
    ?>
  </body>
</html>
