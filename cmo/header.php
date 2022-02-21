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
            require ('../constants.php');
            echo PROJECT_NAME . ' - CMO PAGE';
        ?>
    </title>

    <link rel="stylesheet" href="../includes/bootstrap-5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../includes/css/styles.css" />
    <link rel="stylesheet" href="../includes/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="../includes/sweetalert2/sweetalert2.min.css" />
    <link rel="stylesheet" href="../includes/datatable/datatables.min.css" />
    <link rel="stylesheet" href="../includes/jquery/jquery-ui.css" />

    <noscript>
        <h1>Enable Javascript</h1>
        <a href="index.php">Re-Try</a>
    </noscript>

    <script src="../includes/jquery/jquery-3.6.0.min.js"></script>
    <script src="../includes/js/fetch.js"></script>
    <script src="../includes/sweetalert2/sweetalert2.min.js"></script>

    <style>
        .dropdown:hover .dropdown-menu{
             display: block;
         }
        .dropdown-menu{
            margin-top: 0;
        }
    </style>

</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-body shadow-sm">
        <div class="container py-1">
            <div class="navbar-brand mb-0 h1">
                <div class="d-flex align-items-center">
                    <img src="../includes/images/logo.png" class="rounded-circle" width="50" height="50" alt="">
                    <div class="brand ms-3">
                        <span><?= PROJECT_NAME; ?></span>
                        <div class="h6 font-weight-normal">CMO</div>
                    </div>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo (substr_count($_SERVER['REQUEST_URI'],'home.php') > 0? 'active':''); ?>" id="mnuHome" href="home.php">COVID-19 Cases</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link <?php echo (substr_count($_SERVER['REQUEST_URI'],'archiving.php') > 0? 'active':''); ?>" id="mnuLink1" href="archiving.php">Data Archiving Management</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link <?php echo (substr_count($_SERVER['REQUEST_URI'],'density.php') > 0? 'active':''); ?>" id="mnuLink2" href="density.php">Density Map</a>
                    </li>
                    <li class="nav-item dropdown">

                        <img
                            src="../includes/images/avatar.png"
                            class="nav-link dropdown-toggle"
                            id="navbarDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            height="42" width="42"
                        />
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><span class="dropdown-item-text text-secondary"><?= $cmo->account_name; ?></span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="account-setting.php">Account Setting</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>