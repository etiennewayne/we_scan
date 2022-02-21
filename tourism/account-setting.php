<?php
include ('header.php');
?>

<div class="container bg-white shadow p-4 mb-5">
    <div class="row">
        <div class="col-sm-12">
            <div class="headings d-md-flex justify-content-between align-items-center">
                <div class="title">
                    <div class="h5">Account Setting</div>
                </div>
            </div>
            <table class="table border mt-3">
                <tr>
                    <td width="210" class="text-secondary">Full Name</td>
                    <td><?= $admin->account_name; ?></td>
                </tr>
                <tr>
                    <td class="text-secondary">User Name</td>
                    <td><?= $admin->username; ?></td>
                </tr>
                <tr>
                    <td class="text-secondary">User Type</td>
                    <td><?= $admin->user_type; ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-id="<?= $admin->user_id; ?>" data-bs-target="#editNameModal">Edit Name</button>
                        <button class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-id="<?= $admin->user_id; ?>" data-bs-target="#editUserNameModal">Change Username</button>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-id="<?= $admin->user_id; ?>" data-bs-target="#editPasswordModal">Change Password</button>
                    </td>
                </tr>
            </table>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id" value="<?= $admin->user_id; ?>">
                <div class="p-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="fullname" placeholder="Fullname" value="<?= $admin->account_name; ?>">
                        <label for="floatingInput">Fullname <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateName">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editUserNameModal" tabindex="-1" aria-labelledby="editUserNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserNameModalLabel">Change User Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username" value="<?= $admin->username; ?>">
                        <label for="floatingInput">Username <span class="text-danger">*</span></label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateUserName">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" placeholder="New Password">
                        <label for="floatingInput">New Password <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password">
                        <label for="floatingInput">Confirm Password <span class="text-danger">*</span></label>
                    </div>
                    <div class="form-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="exampleCheck3" onclick="myFunction()">
                        <label class="form-check-label user-select-none" for="exampleCheck3">Show Password</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="updateUPassword">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="../includes/js/fetch.js"></script>
<script>

    $(function () {

        $('#updateName').on('click', function() {
            let user_id = $('#user_id').val();
            let fullname = $('#fullname').val();
            let editKey = 'fullname';

            if (fullname.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid name.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#fullname').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('update.php', {
                user_id, account_name: fullname, editKey, submitted: true
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
                        location.href = `account-setting.php`;
                    }
                });
            }

        });

        $('#updateUserName').on('click', function() {
            let user_id = $('#user_id').val();
            let username = $('#username').val();
            let editKey = 'username';

            if (username.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid username.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#username').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('update.php', {
                user_id, username, editKey, submitted: true
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
                        location.href = `account-setting.php`;
                    }
                });
            }

        });

        $('#updateUPassword').on('click', function() {
            let user_id = $('#user_id').val();
            let new_password = $('#password').val();
            let confirm_password = $('#confirm_password').val();

            if (new_password.trim().length < 6) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a new password with at least 6-characters.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#password').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (confirm_password.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please confirm new password.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#confirm_password').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (new_password !== confirm_password) {
                Swal.fire({
                    title: 'Invalid Value',
                    html: 'Password mismatched. Try again.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#confirm_password').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('update.php', {
                user_id, password: new_password, editKey: 'password', submitted: true
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
                        location.href = `account-setting.php`;
                    }
                });
            }

        });

    });

    function myFunction() {
        let x = document.getElementById("password");
        let y = document.getElementById("confirm_password");
        if (x.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }

</script>

<?php include ('footer.php'); ?>
