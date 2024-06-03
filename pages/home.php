<?php
  require_once "../global/global.php";
  require_once "./connect.php";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginID = cleanData($_POST['loginID']);
    $password = cleanData($_POST['password']);

    

    $sql = "SELECT * FROM user WHERE email = '$loginID' or fnum = '$loginID';";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
      $userData = mysqli_fetch_assoc($results);
      if ( password_verify($password, $userData['pass'])) {
        echo "<h1 class='text-center mt-5'>Your Loged In</h1>
        <div class='text-center'>
          <a href='login.php' class='btn btn-danger btn-lg'>Log Out</a>
        </div>";
      }
      else{
        header("Location: login.php?error=Wrong Password try again");
      }
    }
    else {
      header("Location: login.php?error=Wrong Email or phone number. try again");
    }
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
  
  </body>
</html>
