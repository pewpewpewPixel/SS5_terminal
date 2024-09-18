<?php 

if (isset($_SESSION["loggedInUserId"])) {

    $userId = $_SESSION["loggedInUserId"];
    
  } else {

    echo "<script>window.location.href='login.php';</script>";
    exit();
  }


  $userId = $_SESSION["loggedInUserId"];
  $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE userId = $userId"));

  $userId = $user["userId"];
  $firstname = $user["firstname"];
  $lastname = $user["lastname"];
  $email = $user["email"];
  $profilePicture = $user["profilePicture"];

?>