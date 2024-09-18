<?php
session_start();
include_once "databaseConnection.php";
include "changeName.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services | InReach</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body class="bg-light">
  <?php
  include "profileHeader.inc.php";
  ?>

  <div class="container-fluid">
    <div class="row fullscreen bg-custom">
      <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-12 border border-1">
        <div>
          <div class="bg-light box h-100 d-flex row  p-0 m-0 ">

            <?php

            include "userSession.inc.php";

            ?>

            <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
              <div class="upload d-flex row">


                <div class="row mt-5 d-flex justify-content-center">
                  <div class="d-flex justify-content-center col-7 col-md-8 ">
                    <!-- Profile Picture Container with Fixed Aspect Ratio -->
                    <div class="embed-responsive embed-responsive-1by1 mb-5" style="max-width: 250px;">

                      <img class="rounded-circle border border-5 shadow border-primary p-1 img-fluid embed-responsive-item" src="<?php
                                                                                                                                  if ($_SESSION['loggedInUserId']) {
                                                                                                                                    $profilePicture = $user["profilePicture"];
                                                                                                                                    $defaultProfilePicture = "img/defaultProfilePicture.png";

                                                                                                                                    if ($profilePicture !== null) {
                                                                                                                                      echo "img/" . $profilePicture;
                                                                                                                                    } else {
                                                                                                                                      echo $defaultProfilePicture;
                                                                                                                                    }
                                                                                                                                  }
                                                                                                                                  ?>
                                                                                                                                  ">
                    </div>
                  </div>
                </div>

            <div class="row mb-3">
              <h1 class="text-dark mb-0 fs-3">
                <span id="firstname"><?php echo $firstname; ?></span>
                <span id="lastname"><?php echo $lastname; ?></span>
                <p class="badge text-bg-primary fs-6  m-0">Verified &#10003</p>
              </h1>
              <h6 class="fw-light text-secondary"><?php echo "&nbsp" . $email; ?></span></h6>
            </div>

            <div>
              <h6 class="text-dark mb-0">Description</h6>
              <div class="p-3  mb-2 ">
                <p class="text-secondary fs-6 text-start mb-0 text-break fw-light w-100">Hey there! I'm Faith Syvell, a caring nurse ready to offer you the best private care experience. With a warm heart and gentle touch, I provide personalized support just for you. Let's journey together towards better health and happiness, where your comfort and well-being are my top priorities.</p> <!-- put the description variable here -->
              </div>
              <h6 class="text-dark mb-0">Location</h6>
              <div class="p-3  mb-2 ">
                <p class="text-secondary fs-6 text-start mb-0 text-break fw-light w-100">Phase 3, Fatima Subdivision, Abuno, Iligan City, Philippines
              </div>
              <h6 class="text-dark">Service(s)</h6>

            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-xxl-8 col-xl-8 col-lg-7 col-md-6 col-sm-12 border border-1">
        <div class="box px-4 py-3 m-0 bg-light h-100 text-dark">
          <h2>Location <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-geo-alt-fill mb-2" viewBox="0 0 16 16">
              <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
            </svg>
          </h2>
          <!-- add the location variable here  -->

        </div>
      </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>