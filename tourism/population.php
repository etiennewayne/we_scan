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
            <i class="fa fa-users fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">Population</span>
                <div>Current registered population in Tangub City.</div>
            </div>
        </div>
        <?php if (isset($_GET['search']) && !empty($_GET['search'])) : ?>
            <a href="population.php" class="btn btn-primary shadow-sm">Show All</a>
        <?php endif; ?>
        <a href="population-add.php" class="btn btn-primary">Add Population</a>
    </div>
    <form action="population.php" method="get" class="form-group inputIcon my-3">
        <input type="text" class="form-control" name="search" placeholder="Search people.." required>
        <i class="fa fa-search" style="top:10px"></i>
    </form>
    <div class="data">
        <?php

        if ( isset($_GET['search']) && !empty($_GET['search']) ) {
            $search = $_GET['search'];
            $where = "lastname LIKE '%$search%' OR firstname LIKE '%$search%'";
            $queryString = "WHERE $where";
        } else {
            $where = '';
            $queryString = "";
        }

        $no_of_records_per_page = 12;
        $offset = ($pageno-1) * $no_of_records_per_page;
        $total_rows = sizeof($db->result('population', $where));
        $total_pages = ceil($total_rows / $no_of_records_per_page);

        $result = $db->query("SELECT * FROM population $queryString ORDER BY lastname ASC, firstname ASC, middlename ASC LIMIT $offset, $no_of_records_per_page");
        if (sizeof($result) > 0) :
            foreach ($result as $row) : ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex align-items-start mb-3">
                            <div class="qrcode" id="<?= $row->population_id; ?>"></div>
                            <div class="card-text ms-4">
                                <div class="h5" style="margin-bottom:0px"><?= strtoupper($row->lastname . '. ' . $row->firstname . ' ' . $row->suffix . ' ' . $row->middlename); ?></div>
                                <?= getAge($row->date_of_birth) . 'y, ' . $row->gender ?><br />
                                <?= $row->purok . ', ' . $row->barangay . ', Tangub City'; ?>
                                <div style="width:90px;text-align:center" class="<?= $row->remarks == 'Verified' ? 'mt-1 p-1 text-white bg-success':'mt-1 p-1 text-white bg-danger'; ?>"><?= $row->remarks; ?></div>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="population-view.php?population_id=<?= $row->population_id; ?>">View</a>&nbsp;&nbsp;
                            <a href="population-print.php?population_id=<?= $row->population_id; ?>" target="_blank">Print</a>&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="p-2 text-center text-secondary">No population found.</div>
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

<script src="../includes/qrcode/qrcode.js"></script>
<script>

    $(function () {

        $('#mnuPopulation')
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

    });

</script>

<?php include ('footer.php'); ?>
