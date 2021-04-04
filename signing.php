<?php
$username = $_POST['username'];
$email = $_POST['email'];
$psw = $_POST['psw'];
$phone = $_POST['phone'];

if(!empty($username) || !empty($email) || !empty($psw) || !empty($phone)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "register";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    echo $conn->error;
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From signup Where email = ? Limit 1";
     $INSERT = "INSERT Into signup (username,email,psw,phone) values(?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssi" , $username , $email , $psw , $phone);
      $stmt->execute();
      echo $conn->error;
      echo "New record inserted sucessfully";
      header("location: index.html");
     } else {
        echo '<script>alert("This email is in use")</script>';
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>