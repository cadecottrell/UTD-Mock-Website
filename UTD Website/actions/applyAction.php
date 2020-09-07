<?php

if(isset($_POST['apply']))
{
require 'databaseHandler.php';

$firstName = $_POST['FirstName'];
$lastName = $_POST['LastName'];
$gpa = $_POST['GPA'];
$sat = $_POST['SAT'];
$birth = $_POST['Birthday'];
$address = $_POST['Address'];
$zip = $_POST['Zipcode'];


if (empty($firstName) || empty($lastName) || empty($gpa) || empty($sat) || empty($birth) || empty($zip) || empty($address)) {
  header("Location: ../admission.html?error=missinginfo");
  exit();
}
else {
  $sqlCommand = "SELECT FirstName, LastName, Birthday FROM students WHERE FirstName=? AND LastName=? AND Birthday=?";
  $runSt = mysqli_stmt_init($connect);

  if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
    header("Location: ../admission.html?error=sqlerror");
    exit();
  }
  else {
    $tempBirth = strtotime($birth);
    $tempBirth = date('Y-m-d',$tempBirth);
    mysqli_stmt_bind_param($runSt, "sss", $firstName, $lastName, $tempBirth);
    mysqli_stmt_execute($runSt);
    mysqli_stmt_store_result($runSt);

    $result = mysqli_stmt_num_rows($runSt);


    if ($result > 0) {
      header("Location: ../admission.html?error=studentduplicate");
      exit();
    }
    else{
      $sqlCommand = "INSERT INTO students (FirstName, LastName, SATScore, GPA, Address, Zipcode, Birthday) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $runSt = mysqli_stmt_init($connect);

      if (!mysqli_stmt_prepare($runSt, $sqlCommand)) {
        header("Location: ../Signup.php?error=sqlerror");
        exit();
      }
      else{
        mysqli_stmt_bind_param($runSt, "sssssss", $firstName, $lastName, $sat, $gpa, $address, $zip, $tempBirth);
        mysqli_stmt_execute($runSt);

        header("Location: ../admission.html?apply=success");
        exit();
      }
    }
  }

}
mysqli_stmt_close($runSt);
mysqli_close($connect);
}
