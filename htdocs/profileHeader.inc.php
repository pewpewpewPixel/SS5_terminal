<header>
    <nav class="navbar navbar-expand-lg  bg-primary navbar-dark sticky-top btn-hover-bg-primary shadow">
        <div class="container-fluid">
            <div class="col">
                <a class="navbar-brand fs-2" href="index.php">
                    In<b>Reach</b>
                    <img src="img/logo.png" alt="InReach Logo" width="45" height="45" class="d-inline-block align-text-top fs-2">
                </a>
            </div>
            <div class="col d-flex justify-content-end align-items-center">
                <?php
                if (isset($_SESSION["loggedInUserId"])) {
                    $userId = $_SESSION["loggedInUserId"];
                } else {
                    echo "<script>window.location.href='index.php';</script>";
                    exit();
                }
                $userId = $_SESSION["loggedInUserId"];
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user WHERE userId = $userId"));

                $firstname = $user["firstname"];
                $profilePicture = $user["profilePicture"];

                ?>
                <div class="row">
                    <div class="col-auto p-0">
                        <a href="profile.php">
                        <img class="rounded-circle shadow img-fluid" src="<?php echo $profilePicture; ?>" width="40" height="40"></a>
                    </div>

                    <div class="col-auto">
                        <div class="nav-item dropdown btn ">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo "Hello, &nbsp" . $firstname . "&nbsp"; ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="editProfile.php">Settings</a></li>
                                <li><a class="dropdown-item" href="logout.inc.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
</header>