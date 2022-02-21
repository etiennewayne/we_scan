<?php 

include ('header.php');

$archived_establishment_logs = $db->result('archived_establishment_logs','','date_in DESC');
$archived_transportation_logs = $db->result('archived_transportation_logs','','date_in DESC');
$archived_encounter_logs = $db->result('archived_encounter_logs','','date_contact DESC');

$establishment_logs = $db->result('establishment_logs','','date_in DESC');
$transportation_logs = $db->result('transportation_logs','','date_in DESC');
$encounter_logs = $db->result('encounter_logs','','date_contact DESC');

if(count($archived_establishment_logs) > 0 && $archived_establishment_logs != null) {
    $latest_archived_establishment = date_create_from_format('Y-m-d h:i:s', $archived_establishment_logs[0]->date_in); 
    $oldest_archived_establishment = date_create_from_format('Y-m-d h:i:s', $archived_establishment_logs[count($archived_establishment_logs) - 1]->date_in); 
} else {
    $latest_archived_establishment = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_archived_establishment = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

if(count($archived_transportation_logs) > 0 && $archived_transportation_logs != null) {
    $latest_archived_transportation = date_create_from_format('Y-m-d h:i:s', $archived_transportation_logs[0]->date_in); 
    $oldest_archived_transportation = date_create_from_format('Y-m-d h:i:s', $archived_transportation_logs[count($archived_transportation_logs) - 1]->date_in); 
} else {
    $latest_archived_transportation = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_archived_transportation = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

if(count($archived_encounter_logs) > 0 && $archived_encounter_logs != null) {
    $latest_archived_encounter = date_create_from_format('Y-m-d h:i:s', $archived_encounter_logs[0]->date_contact); 
    $oldest_archived_encounter = date_create_from_format('Y-m-d h:i:s', $archived_encounter_logs[count($archived_encounter_logs) - 1]->date_contact); 
} else {
    $latest_archived_encounter = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_archived_encounter = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

if(count($establishment_logs) > 0 && $establishment_logs != null) {
    $latest_establishment = date_create_from_format('Y-m-d h:i:s', $establishment_logs[0]->date_in); 
    $oldest_establishment = date_create_from_format('Y-m-d h:i:s', $establishment_logs[count($establishment_logs) - 1]->date_in); 
} else {
    $latest_establishment = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_establishment = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

if(count($transportation_logs) > 0 && $transportation_logs != null) {
    $latest_transportation = date_create_from_format('Y-m-d h:i:s', $transportation_logs[0]->date_in); 
    $oldest_transportation = date_create_from_format('Y-m-d h:i:s', $transportation_logs[count($transportation_logs) - 1]->date_in); 
} else {
    $latest_transportation = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_transportation = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

if(count($encounter_logs) > 0 && $encounter_logs != null) {
    $latest_encounter = date_create_from_format('Y-m-d h:i:s', $encounter_logs[0]->date_contact); 
    $oldest_encounter = date_create_from_format('Y-m-d h:i:s', $encounter_logs[count($encounter_logs) - 1]->date_contact); 
} else {
    $latest_encounter = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
    $oldest_encounter = date_create_from_format('Y-m-d h:i:s','0000-00-00 00:00:00');
}

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="container bg-white pl-5 pr-5 pt-4 pb-5">
    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title text-secondary d-flex align-items-center">
            <i class="fa fa-archive fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">Visitation Logs Archiving Management</span>
                <div>Management of Visit Logs</div>
            </div> 
        </div>

        <div class="btn-group float-right" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary mr-2" data-bs-toggle="modal" data-bs-target="#new-case-modal"><i class="fa fa-box"></i><b> ARCHIVE</b></button>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#restore-modal"><i class="fa fa-share"></i><b> RESTORE</b></button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 mb-3 text-primary">
            <strong><b>LEGEND:</b>
                <span class="ml-3 mr-3"><i class="fa fa-user"></i> <i>In Person Scans</i></span>
                <span class="mr-3"><i class="fa fa-building"></i> <i>Establishment Scans</i></span>
                <span class="mr-3"><i class="fa fa-shuttle-van"></i> <i>Transportation Scans</i></span>
            </strong>
        </div>

        <?php if (isset($_GET['status'])) : ?>
            <div class="mb-3 alert alert-success">
                <?= $_GET['status']; ?>
            </div>
        <?php endif; ?>

        <div class="col-md-4">
            <div class="card shadow border border-warning">
                <div class="card-body">
                    <h5 class="card-title"><a href="logs.php">ACTIVE VISITATION LOGS</a></h5>
                    <p class="card-text">Visitation Logs Actively Used in Tracing</p>
                    <h4 class="display-4"><?php echo count($establishment_logs) + count($transportation_logs); ?></h4>
                    <label class="mt-2">Active Log Composition:</label>
                    <?php 
                    
                    // computation
                    $total_active = count($establishment_logs) + count($transportation_logs) + count($encounter_logs);
                    
                    ?>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($establishment_logs)/$total_active) * 100 ;?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-building"></i>
                                <?php echo count($establishment_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($transportation_logs)/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-shuttle-van"></i>
                                <?php echo count($transportation_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($encounter_logs)/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-user"></i>
                                <?php echo count($encounter_logs); ?> Records
                            </span>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mt-2">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Latest Record:
                            <span class="badge bg-primary rounded-pill">
                                <?php 
                                    $e = date_format($latest_establishment>$latest_transportation? $latest_establishment:$latest_transportation,"Y-m-d h:i"); 
                                    if($e == '-0001-11-30 12:00') {
                                        echo "N/A";
                                    } else {
                                        echo $e;
                                    }
                                ?> 
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Oldest Record:
                            <span class="badge bg-primary rounded-pill">
                                <?php 
                                    $e = date_format($oldest_establishment>$oldest_transportation? $oldest_establishment:$oldest_transportation,"Y-m-d h:i"); 
                                    if($e == '-0001-11-30 12:00') {
                                        echo "N/A";
                                    } else {
                                        echo $e;
                                    }
                                ?> 
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ARCHIVED VISITATION LOGS</h5>
                    <p class="card-text">Number of visitation records archived</p>
                    <h4 class="display-4"><?php echo count($archived_establishment_logs) + count($archived_transportation_logs); ?></h4>
                    <label class="mt-2">Active Log Composition:</label>
                    <?php 
                    
                    // computation
                    $total_active = count($archived_establishment_logs) + count($archived_transportation_logs) + count($archived_encounter_logs);
                    
                    ?>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($archived_establishment_logs)/$total_active) * 100 ;?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-building"></i>
                                <?php echo count($archived_establishment_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($archived_transportation_logs)/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-shuttle-van"></i>
                                <?php echo count($archived_transportation_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':(count($archived_encounter_logs)/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-user"></i>
                                <?php echo count($archived_encounter_logs); ?> Records
                            </span>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush mt-2">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Latest Record:
                            <span class="badge bg-primary rounded-pill">
                                <?php 
                                    $e = date_format($latest_archived_establishment>$latest_archived_transportation? $latest_archived_establishment:$latest_archived_transportation,"Y-m-d h:i"); 
                                    if($e == '-0001-11-30 12:00') {
                                        echo "N/A";
                                    } else {
                                        echo $e;
                                    }
                                ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Oldest Record:
                            <span class="badge bg-primary rounded-pill">
                                <?php 
                                    $e = date_format($oldest_archived_establishment>$oldest_archived_transportation? $oldest_archived_establishment:$oldest_archived_transportation,"Y-m-d h:i"); 
                                    if($e == '-0001-11-30 12:00') {
                                        echo "N/A";
                                    } else {
                                        echo $e;
                                    }
                                ?> 
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="col-md-4">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        OVERALL VISITATION LOGS
                    </h5>
                    <p class="card-text">Transportation & Establishment Logs</p>
                    <h4 class="display-4"><?php echo count($archived_establishment_logs) + count($establishment_logs) + count($archived_transportation_logs) + count($transportation_logs); ?></h4>
                    <label class="mt-2">Total Log Composition:</label>
                    <?php 
                    
                    // computation
                    $total_active = count($archived_establishment_logs) + count($establishment_logs) + count($archived_transportation_logs) + count($transportation_logs) + count($archived_encounter_logs) + count($encounter_logs);
                    
                    ?>
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':((count($archived_establishment_logs) + count($establishment_logs))/$total_active) * 100 ;?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-building"></i>
                                <?php echo count($archived_establishment_logs) + count($establishment_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':((count($archived_transportation_logs) + count($transportation_logs))/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-shuttle-van"></i>
                                <?php echo count($archived_transportation_logs) + count($transportation_logs); ?> Records
                            </span>
                        </div>
                        <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="height:30px; width: <?php echo $total_active == 0?'0':((count($archived_encounter_logs) + count($encounter_logs))/$total_active) * 100 ;?>%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                            <span>
                                <i class="fa fa-user"></i>
                                <?php echo count($archived_encounter_logs) + count($encounter_logs); ?> Records
                            </span>
                        </div>
                    </div>
                    <!-- <ul class="list-group list-group-flush mt-2">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Latest Record:
                            <span class="badge bg-primary rounded-pill"> 2021-11-01 </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Oldest Record:
                            <span class="badge bg-primary rounded-pill"> 2021-01-01 </span>
                        </li>
                    </ul> -->
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Modal New Case -->
<div class="modal fade" id="new-case-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="archive_records.php">
                <div class="modal-header">
                    <h5 class="modal-title">ARCHIVE DATA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label>Date From:</label>
                    <input class="form-control" type="text" value="From Beginning of Time" readonly/>
                    <label class="mt-2">Date To:</label>
                    <input class="form-control" type="date" name="date_to"/>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Restore Modal -->
<div class="modal fade" id="restore-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="restore_records.php">
                <div class="modal-header">
                    <h5 class="modal-title">RESTORE DATA</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
      
                    <label>Date From:</label>
                    <input class="form-control" type="text" value="Present" readonly/>
                    <label class="mt-2">Date To:</label>
                    <input class="form-control" type="date" name="date_to"/>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $(function() {
        $("#select2-option").select2({
            theme: "bootstrap"
        });

        $('.select2-option').on('select2:select', function (e) {
           // var data = e.params.data;
            console.log(e);
            $('[name="population_id"]').val(e);
        });

        var at = $('#active-table').dataTable({
            responsive: true,
            autoWidth: false,
            "columnDefs": [
                {
                    "targets": [ 0,1 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        })

        var it = $('#inactive-table').dataTable({
            responsive: true,
            autoWidth: false,
            "columnDefs": [
                {
                    "targets": [ 0,1 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        })

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            if (e.target.hash == '#home-tab') {
                at.columns.adjust().draw()
                it.columns.adjust().draw()
            }
        })

        $(document).on('click','.view-active', function() {

            let e = JSON.parse(
                $(this).attr('data-case')
            )

            $('[name="positive_id"]').val(e.positive_id)
            
            $('#update-case-modal').modal('show')

            console.log(e)
        })

        $(document).on('click','.view-inactive', function() {

            let e = JSON.parse(
                $(this).attr('data-case')
            )

            console.log(e)
        })
    })

</script>

<?php include ('footer.php'); ?>
