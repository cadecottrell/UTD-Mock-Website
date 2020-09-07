<?php


$servername = "localhost";
$DbUsername = "root";
$DbPassword = "PUtindoge121";
$DbName = "assignment6";


$connect = mysqli_connect($servername, $DbUsername, $DbPassword, $DbName);


if (!$connect) {
  die("Failed to Connect: ".mysqli_connect_error());
}
