<?php

session_start();
if(!isset($_SESSION['login_user'])){
   header("Location:index.html");
} 


if (isset($_POST['submit'])) {
  // Create connection
  $conn = new mysqli("localhost", "root", "", "register");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $email = $_SESSION["login_user"];
  echo $email;
  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $Eventtype = $_POST["Eventtype"];
  $event=$_POST["event"];
  $sql = "INSERT INTO book (email,firstname,lastname,Eventtype,event)
  VALUES ('$email','$firstname','$lastname','$Eventtype','$event')";

  if ($conn->query($sql) === TRUE) {
    header("location: gallery.html");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
}
?>