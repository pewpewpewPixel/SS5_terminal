<?php
session_start();
include "databaseConnection.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Home - InReach</title>
</head>

<body>
<?php 

  if(isset($_SESSION['loggedInUserId'])){
    include "profileHeader.inc.php";
  }else{
    include "header.php";
  }
?>

<div class="box z-0" id="myDiv">
    <div class="advisory-message">
      <div class="advisory-text-div">
        <h3>ADVISORY!</h3>
        <button class="advisory-remove-button" onclick="hideDiv()">&#10005;</button>
      </div>

      <div>
        <p class="advisory-paragraph">InReach is dedicated to offering information about various In-person service providers in Iligan City. The details provided here are sourced from local service providers and adhere to the goals established by the InReach.</p>
        <p class="advisory-paragraph">It's important to clarify that InReach is not involved in the processing or facilitation of service applications. Any inquiries, service requests, or related questions should be directed to the respective service providers whose contact information is made available on this website.</p>
        <p class="advisory-paragraph">It's crucial to note that the Iligan City Community Services does not guarantee the accuracy, completeness, or suitability of the information presented on this platform. We disclaim any legal liability or responsibility for the outcomes arising from the use of the information provided. Users are encouraged to verify details directly with the concerned service providers.</p>
      </div>
    </div>
  </div>

  <script>
    function hideDiv() {
      var div = document.getElementById('myDiv');
      div.classList.add('hidden');
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>