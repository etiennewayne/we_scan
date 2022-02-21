<?php
include ('header.php');
$establishment_id = $_GET['establishment_id'];
$establishment = $db->row('establishments', "establishment_id='" . $establishment_id . "'");
?>

<div class="container bg-white p-5">

    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title">
            <span class="h4 text-secondary">Edit Establishment</span>
        </div>
        <a href="establishments.php" class="btn btn-primary">Back</a>
    </div>
    <div class="mt-3">
        <div class="form-floating mb-3">
            <input type="text" name="name" class="form-control" id="name" value="<?= $establishment->name; ?>" />
            <label for="floatingInput">Establishment Name <span class="text-danger">*</span></label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" name="address" class="form-control" id="address" value="<?= $establishment->address; ?>" />
            <label for="floatingInput">Address <span class="text-danger">*</span></label>
        </div>
        <div class="form-floating mb-4">
            <input type="text" name="business_permit_no" class="form-control" id="business_permit_no"  value="<?= $establishment->business_permit_no; ?>" />
            <label for="floatingInput">Business Permit Number <span class="text-danger">*</span></label>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button class="btn btn-primary shadow-sm float-md-end" id="submit">Update Information</button>
            </div>
        </div>
    </div>

</div>

<script src="../includes/js/fetch.js"></script>
<script>

    $(function () {

        $('#submit').click(function() {

            let establishment_id = '<?= $establishment_id; ?>';
            let name = $('#name').val();
            let address = $('#address').val();
            let business_permit_no = $('#business_permit_no').val();

            if (name.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid establishment name.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#name').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (address.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid address.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#address').focus();
                        }, 300);
                    }
                });
                return;
            }

            if (business_permit_no.trim().length < 1) {
                Swal.fire({
                    title: 'Invalid',
                    html: 'Please specify a valid business permit number.'
                }).then((result) => {
                    if (result.isConfirmed) {
                        setTimeout(function(){
                            $('#building_permit_no').focus();
                        }, 300);
                    }
                });
                return;
            }

            const makeUpdate = updateData('establishments-edit-update.php', {
                establishment_id, name, address, business_permit_no, submitted: true
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
                        location.href = `establishments.php`;
                    }
                });
            }
        });

    });

</script>

<?php include ('footer.php'); ?>
