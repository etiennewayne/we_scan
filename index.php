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
            echo PROJECT_NAME . ' - User Login';
        ?>
    </title>

    <link rel="stylesheet" href="includes/bootstrap-5.0.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="includes/css/styles.css" />
    <link rel="stylesheet" href="includes/fontawesome/css/all.min.css" />

    <style>
        a {
            text-decoration: none;
        }
        .login-container {
            margin-top: 60px;
        }
        .login-container .login-field {
            width: 420px;
        }
        .inputIcon {
            position: relative;
        }
        .inputIcon input {
            padding-left: 40px;
        }
        .inputIcon i {
            position: absolute;
            top: 18px;
            left: 15px;
            color: #5c5c5c;
        }
    </style>

</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-body border-bottom">
        <div class="container">
            <div class="navbar-brand mb-0 h1">
                <div class="d-flex align-items-center">
                    <div class="brand ms-2">
                        <span><?= PROJECT_NAME; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="login-container d-flex justify-content-center align-items-center">
        <div class="login-field shadow bg-white p-5">
            <div class="text-center mb-4">
                <img src="includes/images/avatar.png" width="100" height="100" alt="">
            </div>
            <form action="verify.php" method="post">
                <input type="hidden" name="submitted" value="true">
                <div class="form-group inputIcon mb-3">
                    <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" required>
                    <i class="fa fa-user"></i>
                </div>
                <div class="form-group inputIcon mb-3">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                    <i class="fa fa-lock"></i>
                </div>
                <div class="form-group form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" onclick="myFunction()">
                    <label class="form-check-label user-select-none" for="exampleCheck1">Show Password</label>
                </div>
                <div class="d-flex align-items-center">
                    <a href="register.php" class="btn btn-success shadow-sm ms-auto">Register</a>
                    <button id="submit" class="btn btn-primary shadow-sm ms-2">Login</button>
                </div>
            </form>
            <?php
            if (isset($_GET['login']) && $_GET['login'] == 'error') : ?>
                <div class="mt-4 text-danger">
                    Incorrect username or password.
                </div>
            <?php endif; ?>
        </div>

    </div>

    <script src="includes/jquery/jquery-3.6.0.min.js"></script>
    <script src="includes/js/fetch.js"></script>
    <script>

        function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

    </script>


</body>
</html>
