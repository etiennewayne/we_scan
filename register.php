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
    <link rel="stylesheet" href="includes/sweetalert2/sweetalert2.min.css" />

    <script src="includes/jquery/jquery-3.6.0.min.js"></script>
    <script src="includes/sweetalert2/sweetalert2.all.js"></script>

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
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container bg-white shadow p-5">
        <div class="page-heading d-flex align-items-center justify-content-between">
            <div class="page-heading-title">
                <span class="h4 text-secondary">Register</span>
            </div>
        </div>
        <div class="mt-3">
            <div class="h6 text-secondary mb-3">Full Name</div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <input type="text" name="lastname" class="form-control" id="lastname" />
                    <label for="lastname">Last Name <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="firstname" class="form-control" id="firstname" />
                    <label for="firstname">First Name <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="middlename" class="form-control" id="middlename" />
                    <label for="middlename">Middle Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="suffix" class="form-control" id="suffix" />
                    <label for="suffix">Suffix</label>
                </div>
            </div>

            <div class="h6 text-secondary mb-3">Other Information</div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <select id="sex" class="form-select">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <label for="sex">Sex <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" />
                    <label for="date_of_birth">Date of Birth (yyyy-mm-dd) <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="h6 text-secondary mb-3">Contact Details</div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <input type="text" name="email_address" class="form-control" id="email_address" />
                    <label for="email_address">Email Address (optional)</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="primary_mobile_no" class="form-control" id="primary_mobile_no" />
                    <label for="primary_mobile_no">Primary Mobile Number <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="secondary_mobile_no" class="form-control" id="secondary_mobile_no" />
                    <label for="secondary_mobile_no">Secondary Mobile Number (optional)</label>
                </div>
            </div>

            <div class="h6 text-secondary mb-3">Address</div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <input type="text" name="purok" class="form-control" id="purok" />
                    <label for="purok">Purok <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <select id="barangay" class="form-select">
                        <option value="Silanga">Silanga</option>
                        <option value="Aquino (Marcos)">Aquino (Marcos)</option>
                        <option value="Santa Maria (Baga)">Santa Maria (Baga)</option>
                        <option value="Balatacan">Balatacan</option>
                        <option value="Baluk">Baluk</option>
                        <option value="Banglay">Banglay</option>
                        <option value="Mantic">Mantic</option>
                        <option value="Mingcanaway">Mingcanaway</option>
                        <option value="Bintana">Bintana</option>
                        <option value="Bocator">Bocator</option>
                        <option value="Bongabong">Bongabong</option>
                        <option value="Caniangan">Caniangan</option>
                        <option value="Capalaran">Capalaran</option>
                        <option value="Catagan">Catagan</option>
                        <option value="Barangay I - City Hall (Poblacion)">Barangay I - City Hall (Poblacion)</option>
                        <option value="Barangay II - Marilou Annex (Poblacion)">Barangay II - Marilou Annex (Poblacion)</option>
                        <option value="Barangay IV - St. Michael (Poblacion)">Barangay IV - St. Michael (Poblacion)</option>
                        <option value="Isidro D. Tan (Dimalooc)">Isidro D. Tan (Dimalooc)</option>
                        <option value="Garang">Garang</option>
                        <option value="Guinabot">Guinabot</option>
                        <option value="Guinalaban">Guinalaban</option>
                        <option value="Hoyohoy">Hoyohoy</option>
                        <option value="Kauswagan">Kauswagan</option>
                        <option value="Kimat">Kimat</option>
                        <option value="Labuyo">Labuyo</option>
                        <option value="Lorenzo Tan">Lorenzo Tan</option>
                        <option value="Barangay VI - Lower Polao (Poblacion)">Barangay VI - Lower Polao (Poblacion)</option>
                        <option value="Lumban">Lumban</option>
                        <option value="Maloro">Maloro</option>
                        <option value="Barangay V - Malubog (Poblacion)">Barangay V - Malubog (Poblacion)</option>
                        <option value="Manga">Manga</option>
                        <option value="Maquilao">Maquilao</option>
                        <option value="Barangay III- Market Kalubian (Pob)">Barangay III- Market Kalubian (Pob)</option>
                        <option value="Matugnao">Matugnao</option>
                        <option value="Minsubong">Minsubong</option>
                        <option value="Owayan">Owayan</option>
                        <option value="Paiton">Paiton</option>
                        <option value="Panalsalan">Panalsalan</option>
                        <option value="Pangabuan">Pangabuan</option>
                        <option value="Prenza">Prenza</option>
                        <option value="Salimpuno">Salimpuno</option>
                        <option value="San Antonio">San Antonio</option>
                        <option value="San Apolinario">San Apolinario</option>
                        <option value="San Vicente">San Vicente</option>
                        <option value="Santa Cruz">Santa Cruz</option>
                        <option value="Santo Niño">Santo Niño</option>
                        <option value="Sicot">Sicot</option>
                        <option value="Silanga">Silanga</option>
                        <option value="Silangit">Silangit</option>
                        <option value="Simasay">Simasay</option>
                        <option value="Sumirap">Sumirap</option>
                        <option value="Taguite">Taguite</option>
                        <option value="Tituron">Tituron</option>
                        <option value="Tugas">Tugas</option>
                        <option value="Barangay VII - Upper Polao (Poblacion)">Barangay VII - Upper Polao (Poblacion)</option>
                        <option value="Villaba">Villaba</option>
                    </select>
                    <label for="barangay">Barangay <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="h6 text-secondary mb-3">Login Details</div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control" id="username" autocomplete="off" />
                    <label for="username">Username <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control" id="password" />
                    <label for="password">Password <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="mb-3">
                <div class="h6 text-secondary">Google Map Position</div>
                <span class="text-secondary">Click on the Map to get the Position (Longitude, Latitude)</span>
            </div>

            <div id="map" class="mb-3"></div>
            <div class="px-1 mb-5">
                <div class="form-floating mb-3">
                    <input type="text" name="latitude" class="form-control bg-white" id="latitude" value="" readonly />
                    <label for="latitude">Latitude <span class="text-danger">*</span></label>
                </div>
                <div class="form-floating mb-4">
                    <input type="text" name="longitude" class="form-control bg-white" id="longitude" value="" readonly />
                    <label for="longitude">Longitude <span class="text-danger">*</span></label>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg shadow-sm float-md-end" id="submit">Submit Information</button>
                </div>
            </div>
        </div>

    </div>


<script src="<?= BASE_URL; ?>includes/js/fetch.js"></script>
<script>

    var lat =0;
    var long = 0;

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(position) {
      
      lat = position.coords.latitude;
      long = position.coords.longitude;
    }

     getLocation();

    function initMap() {
       
        var map = new google.maps.Map(document.getElementById('map'), {
            //center: new google.maps.LatLng(8.096879, 123.706058),
            center: new google.maps.LatLng(lat, long),
            zoom: 12,
            mapTypeId: 'roadmap'
        });
       
        var markers = [];

        // markers = new google.maps.Marker({
        //     position: new google.maps.LatLng(lat, long),
        //     map: map
        // });
        //updated code from navigator

        google.maps.event.addListener(map, "click", function(event) {
            // get lat/lon of click
          
            var clickLat = event.latLng.lat();
            var clickLon = event.latLng.lng();

            // show in input box
            document.getElementById("latitude").value = clickLat.toFixed(5);
            document.getElementById("longitude").value = clickLon.toFixed(5);

            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(null);
                markers = [];
            }
            
        
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(clickLat, clickLon),
                map: map
            });

            markers.push(marker);

            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        });
    }

 

    $(function () {

        $('#submit').click(function() {

            let lastname = $('#lastname').val();
            let firstname = $('#firstname').val();
            let middlename = $('#middlename').val();
            let suffix = $('#suffix').val();
            let sex = $('#sex').val();
            let date_of_birth = $('#date_of_birth').val();
            let email_address = $('#email_address').val();
            let primary_mobile_no = $('#primary_mobile_no').val();
            let secondary_mobile_no = $('#secondary_mobile_no').val();
            let purok = $('#purok').val();
            let barangay = $('#barangay').val();
            let username = $('#username').val();
            let password = $('#password').val();
            let latitude = $('#latitude').val();
            let longitude = $('#longitude').val();

            let today = new Date();
            today.setHours(0, 0, 0, 0);

            let comparingDate = new Date(date_of_birth);
            comparingDate.setHours(0, 0, 0, 0);

            if (lastname.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid last name.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#lastname').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (firstname.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid first name.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#firstname').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (date_of_birth.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid date of birth.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#date_of_birth').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (comparingDate > today) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Date of birth must be today or less.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#date_of_birth').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (email_address.trim().length > 0) {
                if (!validateEmail(email_address)) {
                    Swal.fire({
                        title: 'Invalid',
                        html: 'Please specify a valid email address.'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setTimeout(function(){
                                $('#email_address').focus();
                            }, 300);
                        }
                    });
                    return;
                }
            }

            if (primary_mobile_no.trim().length < 1 || !/^(09|\+639)\d{9}$/.test(primary_mobile_no)) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid primary mobile number.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#primary_mobile_no').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (secondary_mobile_no.trim().length > 0) {
                if (!/^(09|\+639)\d{9}$/.test(secondary_mobile_no)) {
                    Swal.fire({
                        title: 'Invalid',
                        html: 'Please specify a valid secondary mobile number.',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            setTimeout(function(){
                                $('#secondary_mobile_no').focus();
                            }, 300);
                        }
                    });
                    return;
                }
            }

            if (purok.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid purok.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#purok').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (username.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid username.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#username').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (password.trim().length < 6) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid password with minimum of 6 characters.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#password').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (latitude.length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please click on the map to get latitude.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#latitude').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (longitude.length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please click on the map to get longitude.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#longitude').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeInsert = insertData('register-save.php', {
                lastname, firstname, middlename, suffix,
                sex, date_of_birth, email_address, primary_mobile_no,
                secondary_mobile_no, purok, barangay,
                username, password, latitude, longitude, submitted: true
            });

            if (makeInsert.status !== 'Success') {
                Swal.fire(makeInsert.status, makeInsert.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeInsert.status,
                    html: makeInsert.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {

                        location.href = `index.php`;
                    }
                });
            }
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

    });

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh4Ax62zxLlnyquWb1QUDvG5zdxphwtfg&callback=initMap"></script>


</body>
</html>
