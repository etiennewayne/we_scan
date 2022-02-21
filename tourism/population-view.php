<?php
include ('header.php');
$population_id = $_GET['population_id'];
$population = $db->row('population', "population_id='" . $population_id . "'");
?>

<div class="container bg-white p-5">

    <div class="page-heading d-flex align-items-center">
        <div class="page-heading-title me-auto">
            <span class="h4 text-secondary">Individual Information</span>
        </div>
        <?php if ($population->remarks == 'Unverified'): ?>
            <button class="btn btn-primary me-2" id="verify">Verify Information</button>
        <?php endif; ?>
        <a href="population-print.php?population_id=<?= $population_id; ?>" class="btn btn-primary me-2" target="_blank">Print QR Code</a>
        <a href="#" class="btn btn-primary me-2" id="deleteInformation">Delete</a>
        <a href="loghistory.php?client_id=<?= $population_id; ?>" class="btn btn-primary me-2">Logs</a>
        <a href="population.php" class="btn btn-primary">Back</a>
    </div>
    <?php if ($population->remarks == 'Unverified'): ?>
        <div class="mt-5 text-center alert alert-danger">
            This information is <b>NOT VERIFIED</b>.
        </div>
    <?php endif; ?>
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="d-flex align-items-center justify-content-center flex-column">
                <div id="qrcode"></div>
                <div class="mt-2"><?= $population_id; ?></div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Full Name</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editFullnameModal" id="editFullname">Edit</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Last Name</span>
                            <span><b><?= $population->lastname; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>First Name</span>
                            <span><b><?= $population->firstname; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Middle Name</span>
                            <span><b><?= $population->middlename; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Suffix</span>
                            <span><b><?= $population->suffix; ?></b></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Other Information</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editOtherInfoModal" id="editOtherInfo">Edit</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Sex</span>
                            <span><b><?= $population->gender; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Date of Birth</span>
                            <span>
                                <b>
                                    <?php
                                        $nd = date_create($population->date_of_birth);
                                        echo date_format($nd, 'F d, Y');
                                    ?>
                                </b>
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Contact Details</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editContactDetailsModal" id="editContactDetails">Edit</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Email Address</span>
                            <span><b><?= $population->email_address; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Primary Mobile Number</span>
                            <span><b><?= $population->primary_mobile_no; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Secondary Mobile Number</span>
                            <span><b><?= $population->secondary_mobile_no; ?></b></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Address</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editAddressModal" data="<?= $population->barangay; ?>" id="editAddress">Edit</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Complete Address</span>
                            <span><b><?= $population->purok.', '.$population->barangay.', Tangub City'; ?></b></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Login Details</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editUsernameModal" id="editUsername">Edit Username</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Username</span>
                            <span><b><?= $population->username; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Password</span>
                            <span><b><?= $population->password; ?></b></span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="detail mb-5">
                <div class="h6 d-flex justify-content-between">
                    <span>Google Map Position</span>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#editPositionModal" id="editPosition">Edit Position</a>
                </div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <span>Latitude</span>
                            <span><b><?= $population->latitude; ?></b></span>
                        </div>
                    </li>
                    <li class="list-group-item border-top">
                        <div class="d-flex justify-content-between">
                            <span>Longitude</span>
                            <span><b><?= $population->longitude; ?></b></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Edit Full Name Modal -->
<div class="modal fade" id="editFullnameModal" tabindex="-1" aria-labelledby="editFullnameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFullnameModalLabel">Edit Full Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $population->lastname; ?>" />
                        <label for="floatingInput">Last Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $population->firstname; ?>" />
                        <label for="floatingInput">First Name <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="middlename" class="form-control" id="middlename" value="<?= $population->middlename; ?>" />
                        <label for="floatingInput">Middle Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="suffix" class="form-control" id="suffix" value="<?= $population->suffix; ?>" />
                        <label for="floatingInput">Suffix</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateFullname">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Other Info Modal -->
<div class="modal fade" id="editOtherInfoModal" tabindex="-1" aria-labelledby="editOtherInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOtherInfoModalLabel">Edit Other Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-3">
                        <select id="sex" class="form-select">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="floatingInput">Sex <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="<?= $population->date_of_birth; ?>" />
                        <label for="floatingInput">Date of Birth (yyyy-mm-dd) <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateOtherInfo">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Contact Details Modal -->
<div class="modal fade" id="editContactDetailsModal" tabindex="-1" aria-labelledby="editContactDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editContactDetailsModalLabel">Edit Contact Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-4">
                        <input type="text" name="email_address" class="form-control" id="email_address" value="<?= $population->email_address; ?>" />
                        <label for="floatingInput">Email Address (optional)</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" name="primary_mobile_no" class="form-control" id="primary_mobile_no" value="<?= $population->primary_mobile_no; ?>" />
                        <label for="floatingInput">Primary Mobile Number <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" name="secondary_mobile_no" class="form-control" id="secondary_mobile_no" value="<?= $population->secondary_mobile_no; ?>" />
                        <label for="floatingInput">Secondary Mobile Number (optional)</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateContactDetails">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddressModalLabel">Edit Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-4">
                        <input type="text" name="purok" class="form-control" id="purok" value="<?= $population->purok; ?>" />
                        <label for="floatingInput">Purok <span class="text-danger">*</span></label>
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
                        <label for="floatingInput">Barangay <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateAddress">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Username Modal -->
<div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUsernameModalLabel">Edit Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-4">
                        <input type="text" name="username" class="form-control" id="username" value="<?= $population->username; ?>" />
                        <label for="floatingInput">Username <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateUsername">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Position Modal -->
<div class="modal fade" id="editPositionModal" tabindex="-1" aria-labelledby="editPositionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPositionModalLabel">Edit Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-4">
                        <input type="text" name="latitude" class="form-control" id="latitude" value="<?= $population->latitude; ?>" />
                        <label for="floatingInput">Latitude <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="text" name="longitude" class="form-control" id="longitude" value="<?= $population->longitude; ?>" />
                        <label for="floatingInput">Longitude <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updatePosition">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script src="../includes/qrcode/qrcode.js"></script>
<script src="../includes/jquery/jquery-ui.js"></script>
<script src="../includes/js/fetch.js"></script>
<script>

    const qrcode = new QRCode(document.getElementById('qrcode'), {
        height: 150,
        width: 150
    });

    qrcode.makeCode('<?= $population_id; ?>')

    $(function() {

        const population_id = `<?= $population_id; ?>`;

        $('#editFullname').click(function () {
            $('#lastname').val(`<?= $population->lastname; ?>`);
            $('#firstname').val(`<?= $population->firstname; ?>`);
            $('#middlename').val(`<?= $population->middlename; ?>`);
            $('#suffix').val(`<?= $population->suffix; ?>`);
        });

        $('#editContactDetails').click(function () {
            $('#email_address').val(`<?= $population->email_address; ?>`);
            $('#primary_mobile_no').val(`<?= $population->primary_mobile_no; ?>`);
            $('#secondary_mobile_no').val(`<?= $population->secondary_mobile_no; ?>`);
        });

        $('#editOtherInfo').click(function () {
            $(`select#sex`).val("<?= $population->gender; ?>").change();
            $('#date_of_birth').val(`<?= $population->date_of_birth; ?>`);
        });

        $('#editAddress').click(function () {
            let barangay = $(this).attr('data');
            $("select#barangay").val("<?= $population->barangay; ?>").change();
            $('#purok').val(`<?= $population->purok; ?>`);
        });

        $('#editUsername').click(function () {
            $('#username').val(`<?= $population->username; ?>`);
        });

        $('#editPosition').click(function () {
            $('#latitude').val(`<?= $population->latitude; ?>`);
            $('#longitude').val(`<?= $population->longitude; ?>`);
        });

        $('#updateFullname').click(function () {
            let lastname = $('#lastname').val();
            let firstname = $('#firstname').val();
            let middlename = $('#middlename').val();
            let suffix = $('#suffix').val();

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

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, lastname, firstname, middlename,
                suffix, editKey: 'fullname', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }

        });

        $('#updateOtherInfo').click(function () {
            let sex = $('#sex').val();
            let date_of_birth = $('#date_of_birth').val();
            let today = new Date();
            let comparingDate = new Date(date_of_birth);
            today.setHours(0, 0, 0, 0);
            comparingDate.setHours(0, 0, 0, 0);

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

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, gender: sex, date_of_birth, editKey: 'otherInfo', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }
        });

        $('#updateContactDetails').click(function () {
            let email_address = $('#email_address').val();
            let primary_mobile_no = $('#primary_mobile_no').val();
            let secondary_mobile_no = $('#secondary_mobile_no').val();

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

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, email_address, primary_mobile_no,
                secondary_mobile_no, editKey: 'contactDetails', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }
        });

        $('#updateAddress').click(function () {
            let purok = $('#purok').val();
            let barangay = $('#barangay').val();

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

            if (!barangay) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please select barangay.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#barangay').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, purok, barangay,
                editKey: 'address', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }

        });

        $('#updateUsername').click(function () {
            let username = $('#username').val();

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

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, username,
                editKey: 'username', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }

        });

        $('#updatePosition').click(function () {
            let latitude = $('#latitude').val();
            let longitude = $('#longitude').val();

            if (!/^\d*[.]?\d*$/.test(latitude)) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid latitude.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#latitude').val('0');
                            $('#latitude').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (!/^\d*[.]?\d*$/.test(longitude)) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid longitude.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#longitude').val('0');
                            $('#longitude').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('population-edit-update.php', {
                population_id, latitude, longitude,
                editKey: 'position', submitted: true
            });

            if (makeUpdate.status !== 'Success') {
                Swal.fire(makeUpdate.status, makeUpdate.message);
            } else {
                Swal.fire({
                    icon: 'success',
                    title: makeUpdate.status,
                    html: makeUpdate.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = `population-view.php?population_id=${population_id}`;
                    }
                });
            }

        });

        $('#deleteInformation').on('click', function() {
            Swal.fire({
                title: 'Delete Population',
                html: `Do you really want to delete this selected individual's information?`,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Delete`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const makeDelete = fetchData('population-delete.php', {
                        population_id, submitted: true
                    });

                    if (makeDelete.status !== 'Success') {
                        Swal.fire(makeDelete.status, makeDelete.message);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: makeDelete.status,
                            html: makeDelete.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = `population.php`;
                            }
                        });
                    }

                }
            });
        });

        $('#verify').on('click', function() {
            Swal.fire({
                title: 'Verify Information',
                html: `Do you verify this information?`,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Yes, Verify It!`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const makeVerified = fetchData('population-verify.php', {
                        population_id, submitted: true
                    });

                    if (makeVerified.status !== 'Success') {
                        Swal.fire(makeVerified.status, makeVerified.message);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: makeVerified.status,
                            html: makeVerified.message,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = `population-view.php?population_id=${population_id}`;
                            }
                        });
                    }

                }
            });
        });

        function validateEmail(email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

    });

</script>

<?php include ('footer.php'); ?>
