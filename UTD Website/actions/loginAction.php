<?php

if (isset($_POST['login'])){

  require 'databaseHandler.php';

  $email = $_POST['Email'];
  $password = $_POST['Password'];

  if(empty($email) || empty($password)){
    header("Location: ../login.php?error=emptyinfo");
    exit();
  }
  else{
    $sqlCommand = "SELECT * FROM users WHERE Email=?";
    $runSt = mysqli_stmt_init($connect);

    if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
      header("Location: ../login.php?error=sqlerror");
      exit();
    }
    else{
      mysqli_stmt_bind_param($runSt, "s", $email);
      mysqli_stmt_execute($runSt);
      $result = mysqli_stmt_get_result($runSt);

      if ($row = mysqli_fetch_assoc($result)) {

        $verifyPassword = password_verify($password, $row['Password']);

        if ($verifyPassword == true) {
            session_start();
            $_SESSION['userEmail'] = $row['Email'];
            $_SESSION['userFirstName'] = $row['FirstName'];
            $_SESSION['userLastName'] = $row['LastName'];

            header("Location: ../login.php?login=success");
            exit();
        }
        else{
          header("Location: ../login.php?error=wrongpassword");
          exit();
        }

      }
      else {
        header("Location: ../login.php?error=nouser");
        exit();
      }

    }
  }

}
