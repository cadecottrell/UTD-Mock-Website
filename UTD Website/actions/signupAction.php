<?php
if (isset($_POST['signup'])) {

  require 'databaseHandler.php';

  $firstName = $_POST['FirstName'];
  $lastName = $_POST['LastName'];
  $password = $_POST['Password'];
  $retypePassword = $_POST['RetypePassword'];
  $email = $_POST['Email'];

  if ($password !== $retypePassword){
    header("Location: ../Signup.php?error=passwordmismatch&FirstName=".$firstName."&LastName".$lastName."&Email".$email);
    exit();
  }
  else {

    $sqlCommand = "SELECT Email FROM users WHERE Email=?";
    $runSt = mysqli_stmt_init($connect);

    if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
      header("Location: ../Signup.php?error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($runSt, "s", $email);
      mysqli_stmt_execute($runSt);
      mysqli_stmt_store_result($runSt);

      $result = mysqli_stmt_num_rows($runSt);

      if ($result > 0) {
        header("Location: ../Signup.php?error=emailtaken");
        exit();
      }
      else {
        $sqlCommand = "INSERT INTO users (FirstName, LastName, Email, Password) VALUES (?, ?, ?, ?)";
        $runSt = mysqli_stmt_init($connect);

        if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
          header("Location: ../Signup.php?error=sqlerror");
          exit();
        }
        else {

          $lockPassword = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($runSt, "ssss", $firstName, $lastName, $email, $lockPassword);
          mysqli_stmt_execute($runSt);

          header("Location: ../Signup.php?signup=success");

          exit();
        }
      }
    }
  }

  mysqli_stmt_close($runSt);
  mysqli_close($connect);




}
