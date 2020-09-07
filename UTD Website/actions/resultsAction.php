<?php
session_start();
if(isset($_POST['result'])){
  require 'databaseHandler.php';

  $sqlCommand = "SELECT GPA, SATScore FROM students WHERE FirstName=? AND LastName=?";
  $runSt = mysqli_stmt_init($connect);

  if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
    header("Location: ../admission.html?error=sqlerror");
    exit();
  }
  else {
    $firstname = $_SESSION['userFirstName'];
    $lastname = $_SESSION['userLastName'];
    mysqli_stmt_bind_param($runSt, "ss", $firstname, $lastname);
    mysqli_stmt_execute($runSt);
    $result = mysqli_stmt_get_result($runSt);

    if($row = mysqli_fetch_assoc($result)){

      if ($row['GPA'] > 3.2 && $row['SATScore'] > 1200) {
        header("Location: ../admission.html?results=success");
        exit();
      }
      else {
        header("Location: ../admission.html?results=denied");
        exit();
      }

    }
    else {
      header("Location: ../admission.html?error=nullstudent");
      exit();
    }

  }

  mysqli_stmt_close($runSt);
  mysqli_close($connect);

}
