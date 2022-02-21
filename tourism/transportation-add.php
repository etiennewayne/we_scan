<?php
include ('header.php');
?>

<div class="container bg-white p-5">

    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title">
            <span class="h4 text-secondary">Add Transportation</span>
        </div>
        <a href="transportation.php" class="btn btn-primary">Back</a>
    </div>
    <div class="mt-3">
        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control" id="name_of_driver" />
            <label for="floatingInput">Name of Driver <span class="text-danger">*</span></label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" name="address_of_driver" class="form-control" id="address_of_driver" />
            <label for="floatingInput">Address of Driver <span class="text-danger">*</span></label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" name="vehicle" class="form-control" id="vehicle" />
            <label for="floatingInput">Vehicle <span class="text-danger">*</span></label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" name="plate_no" class="form-control" id="plate_no" />
            <label for="floatingInput">Plate Number <span class="text-danger">*</span></label>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button class="btn btn-primary shadow-sm float-md-end" id="submit">Save Information</button>
            </div>
        </div>
    </div>

</div>

<script src="../includes/js/fetch.js"></script>
<script>

    $(function () {

        $('#submit').click(function() {

            let name_of_driver = $('#name_of_driver').val();
            let address_of_driver = $('#address_of_driver').val();
            let vehicle = $('#vehicle').val();
            let plate_no = $('#plate_no').val();

            if (name_of_driver.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid name of driver.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#name_of_driver').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (address_of_driver.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid address of driver.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#address_of_driver').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (vehicle.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid plate number.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#plate_no').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (plate_no.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid plate number.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#plate_no').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeInsert = insertData('transportation-add-save.php', {
                name_of_driver, address_of_driver, vehicle, plate_no, submitted: true
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
                        location.href = `transportation.php`;
                    }
                });
            }
        });

    });

</script>

<?php include ('footer.php'); ?>
