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
  require_once "./connect.php";
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $loginID = cleanData($_POST['loginID']);
    $password = cleanData($_POST['password']);

    

    $sql = "SELECT * FROM user WHERE email = '$loginID' or fnum = '$loginID';";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
      $userData = mysqli_fetch_assoc($results);
      if ( password_verify($password, $userData['pass'])) {
        echo '<h1 style="color: antiquewhite;"> WELCOME TO OUR WEBSITE</h1>';
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
    
</body>
</html>