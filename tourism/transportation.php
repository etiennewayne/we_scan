<?php
include ('header.php');

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
?>

<div class="container bg-white p-5">

    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title text-secondary d-flex align-items-center">
            <i class="fa fa-bus-alt fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">Transportation</span>
                <div>Current registered transportation in Tangub City.</div>
            </div>
        </div>
        <?php if (isset($_GET['search']) && !empty($_GET['search'])) : ?>
            <a href="transportation.php" class="btn btn-primary shadow-sm">Show All</a>
        <?php endif; ?>
        <a href="transportation-add.php" class="btn btn-primary">Add Transportation</a>
    </div>
    <form action="transportation.php" method="get" class="form-group inputIcon my-3">
        <input type="text" class="form-control" name="search" placeholder="Search transportation.." required>
        <i class="fa fa-search" style="top:10px"></i>
    </form>

    <div class="data">
        <?php
        if ( isset($_GET['search']) && !empty($_GET['search']) ) {
            $search = ucfirst($_GET['search']);
            $where = "plate_no LIKE '%$search%' OR name_of_driver LIKE '%$search%' OR address_of_driver LIKE '%$search%'";
            $queryString = "WHERE $where";
        } else {
            $where = '';
            $queryString = "";
        }

        $no_of_records_per_page = 20;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_rows = sizeof($db->result('transportation', $where));
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $result = $db->query("SELECT * FROM transportation $queryString LIMIT $offset, $no_of_records_per_page");
        if (sizeof($result) > 0) :
            foreach ($result as $row) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="qrcode" id="<?= $row->transportation_id; ?>"></div>
                            <div class="card-text ms-4">
                                <div class="h5" style="margin-bottom: 0px"><?= $row->vehicle; ?></div>
                                Driver: <?= $row->name_of_driver; ?><br />
                                Plate No.: <?= $row->plate_no; ?><br />
                                <?= $row->address_of_driver; ?>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="transportation-edit.php?transportation_id=<?= $row->transportation_id; ?>">Edit</a>&nbsp;&nbsp;
                            <a href="transportation-print.php?transportation_id=<?= $row->transportation_id; ?>" target="_blank">Print</a>&nbsp;&nbsp;
                            <a id="logs" href="#" data-id="<?= $row->transportation_id; ?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Logs&nbsp;</a>
                            <a href="#" class="deleteTransportation" data-id="<?= $row->transportation_id; ?>">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="p-2 text-center text-secondary">No transportation found.</div>
        <?php endif; ?>
    </div>
    <?php if (sizeof($result) > 20) : ?>
        <div class="row">
            <div class="col-sm-12">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
                    <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                    <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>

</div>

<form action="transportation-logs.php" method="post" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generate Daily Log Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="transportation_id" id="id">
                <div class="mb-3">
                    <label for="date" class="form-label">Date Range</label>
                    <input readonly type="text" class="form-control bg-white" id="date" name="date" value="<?= date('m-d-Y') . ' - ' . date('m-d-Y'); ?>" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Generate</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script src="../includes/qrcode/qrcode.js"></script>
<script src="../includes/js/fetch.js"></script>
<script>

    $(function () {

        $('#date').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });

        $('#logs').click(function(){
            let id = $(this).attr('data-id');
            $('#id').val(id);
        });

        $('#mnuTransportation')
            .addClass(' active')
            .attr('aria-current', 'page')
            .attr('href', '#');

        $('.qrcode').each(function (index) {
            let id = $(`.qrcode:eq(${index})`).attr('id');
            let qrcode = new QRCode(document.getElementById(id), {
                height: 75,
                width: 75
            });
            qrcode.makeCode(id);
        });

        $('.deleteTransportation').on('click', function() {
            let transportation_id = $(this).attr('data-id');
            Swal.fire({
                title: 'Delete Transportation',
                html: `Do you really want to delete this selected transportation?`,
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: `Delete`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    const makeDelete = fetchData('transportation-delete.php', {
                        transportation_id, submitted: true
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
                                location.href = `transportation.php`;
                            }
                        });
                    }

                }
            });
        });

    });

</script>

<?php include ('footer.php'); ?>
