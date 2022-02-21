<?php require ('login-check.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php
            require ('constants.php');
            echo PROJECT_NAME . ' - CLIENT';
        ?>
    </title>

    <link rel="stylesheet" href="includes/bootstrap-5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/css/styles.css" />
    <link rel="stylesheet" href="includes/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="includes/sweetalert2/sweetalert2.min.css" />

    <script src="includes/jquery/jquery-3.6.0.min.js"></script>
    <script src="includes/qrcode/html5-qrcode.min.js"></script>

    <style>
        a {
            text-decoration: none;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-body shadow-sm">
        <div class="container py-2">
            <div class="navbar-brand mb-0 h1">
                <div class="d-flex align-items-center">
                    <div class="brand ms-2">
                        <span><?= PROJECT_NAME; ?></span>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" id="mnuHome" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="mnuHistory" href="loghistory.php">Log History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="mnuQRCode" href="myqrcode.php">My QR Code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a></li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>