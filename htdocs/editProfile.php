<?php
session_start();
include "databaseConnection.php";
include "userSession.inc.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>InReach - Edit Profile</title>
</head>

<body class="bg-light">

    <nav class="navbar bg-white shadow-sm ">
        <div class="container-fluid">
            <a href="index.php">
                <button class="fs-6 hover-custom bg-white py-2 px-3 shadow-sm">Back</button>
            </a>
            <a href="#editInfo">
                <button class="fs-6 hover-custom bg-white py-2 px-3 shadow-sm">Edit Info</button>
            </a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row fullscreen ">
            <div class="col-xxl-4 col-xl-4 col-md-6 col-sm-12 border border-1 bg-light">
                <div>
                    <div class="h-100 d-flex row  p-0 m-0 ">

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

                                <div class="row mb-4 input-group-sm">
                                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>">
                                    <input class="form-control " type="file" name="profilePicture" id="profilePicture" accept=".jpg, .jpeg, .png">
                                </div>
                            </div>
                            <script type="text/javascript">
                                // When profile picture changes value, it automatically changes
                                document.getElementById("profilePicture").onchange = function() {
                                    document.getElementById("form").submit();
                                };
                            </script>
                        </form>

                        <?php
                        if (isset($_FILES["profilePicture"]["name"])) {
                            $userId = $user["userId"];
                            $firstname = $user["firstname"];
                            $lastname = $user["lastname"];

                            $imageName = $_FILES["profilePicture"]["name"];
                            $imageSize = $_FILES["profilePicture"]["size"];
                            $tmpName = $_FILES["profilePicture"]["tmp_name"];

                            // Image validation
                            $validImageExtension = ['jpg', 'jpeg', 'png'];
                            $imageExtension = explode('.', $imageName);
                            $imageExtension = strtolower(end($imageExtension));
                            if (!in_array($imageExtension, $validImageExtension)) {
                                echo "
                  <script>
                    alert('Invalid Image Extension');
                    window.location.href = 'profile.php';
                  </script>";
                            } elseif ($imageSize > 1200000) {
                                echo "
                  <script>
                    alert('Image Size Is Too Large');
                    window.location.href = 'profile.php';
                  </script>";
                            } else {
                                $newImageName = $firstname . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
                                $newImageName .= '.' . $imageExtension;
                                $query = "UPDATE user SET profilePicture = '$newImageName' WHERE userId = $userId";
                                mysqli_query($conn, $query);
                                move_uploaded_file($tmpName, 'img/' . $newImageName);
                                echo "
                  <script>
                    window.location.href = 'editProfile.php';
                  </script>";
                            }
                        }
                        ?>

                        <div class="row mb-3">
                            <h1 class="text-dark mb-0 fs-3"><?php echo $firstname . "&nbsp" . $lastname; ?> <p class="badge text-bg-primary p-1 m-0 fs-6">Verified &#10003</p>
                            </h1>

                            <h6 class="fw-light text-secondary"><?php echo "&nbsp" . $email; ?></span></h6>
                        </div>

                        <div>
                            <h6 class="text-dark mb-0">Description</h6>
                            <div class="p-3  mb-2 ">
                                <p class="text-secondary text-justify fs-6 text-start mb-0 text-break fw-light w-100">Hey there! I'm Faith Syvell, a caring nurse ready to offer you the best private care experience. With a warm heart and gentle touch, I provide personalized support just for you. Let's journey together towards better health and happiness, where your comfort and well-being are my top priorities.</p> <!-- put the description variable here -->
                            </div>
                            <h6 class="text-dark mb-0">Address</h6>
                            <div class="p-3  mb-2 ">
                                <p class="text-secondary text-justify fs-6 text-start mb-0 text-break fw-light w-100">Phase 3, Fatima Subdivision, Abuno, Iligan City, Philippines
                            </div>
                            <h6 class="text-dark">Service(s)</h6>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col border border-1">
                <div class="row p-5 " id="editInfo">
                    <div class="row">
                        <div class="col">
                            <h4 class="mb-4">Edit Info</h4>
                        </div>
                        <div class="col">
                            <h4 class="mb-4 d-flex justify-content-end text-danger">
                                <button type="button" class="btn btn-outline-danger">Delete Profile</button>
                            </h4>
                        </div>


                    </div>
                    <form action="" method="POST">
                        <div class="input-group-sm m-0">
                            <div class="input-group input-group-md mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Firstname</span>
                                <input type="text" name="firstname" placeholder="<?php echo $firstname; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Lastname</span>
                                <input type="text" name="lastname" placeholder="<?php echo $lastname; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-md mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Email</span>
                                <input type="text" name="lastname" placeholder="<?php echo $email; ?>" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-md mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm"> Old Password</span>
                                <input type="text" name="lastname" placeholder="Old Password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-md mb-4">
                                <span class="input-group-text" id="inputGroup-sizing-sm"> New Password</span>
                                <input type="text" name="lastname" placeholder="New Password" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary ">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr width="100%" style="margin: 0;">
                <div class="row p-3 bg-light">
                    <h4 class="mt-3">Wanna provide your own services?</h4>
                    <form action="#" method="post">




                        <div class="container mt-3 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="locationSwitch">
                                <label class="form-check-label" for="locationSwitch">Enable Location</label>
                            </div>
                        </div>


                        <script>
                            const locationSwitch = document.getElementById('locationSwitch');

                            // Check if geolocation is supported
                            if ("geolocation" in navigator) {
                                // Set the switch to be checked by default
                                locationSwitch.checked = true;
                            }

                            locationSwitch.addEventListener('change', function() {
                                if (this.checked) {
                                    // Enable location
                                    getLocation();
                                } else {
                                    // Disable location
                                    // Handle disabling location functionality here
                                    console.log('Location disabled');
                                }
                            });

                            function getLocation() {
                                // Check if geolocation is supported
                                if ("geolocation" in navigator) {
                                    // Get current position
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        console.log("Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude);
                                    });
                                } else {
                                    console.log("Geolocation is not supported by this browser.");
                                }
                            }
                        </script>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Complete Address">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Services</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Service(s) you offer">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Tell us about yourself"></textarea>
                        </div>
                        <div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>