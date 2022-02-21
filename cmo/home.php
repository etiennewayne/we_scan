<?php
include ('header.php');
$list_active_cases = $db->result('vw_positive_incidences',"status IS NULL");
$list_inactive_cases = $db->result('vw_positive_incidences',"status IS NOT NULL");
$list_population = $db->result('population');
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="container bg-white pl-5 pt-4 pb-4">
    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title text-secondary d-flex align-items-center">
            <i class="fa fa-chart-area fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">COVID-19 CASES</span>
                <div>Overview of System Recorded COVID-19 Cases..</div>
            </div>
        </div>
        <button type="button" class="btn btn-large btn-primary float-right" data-bs-toggle="modal" data-bs-target="#new-case-modal">
            <i class="fa fa-plus"></i>
            <b>NEW CASE</b>
        </button>
    </div>
    <div class="row my-3">
        <div class="col-md-12">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                        <b>ACTIVE CASES <span class="badge rounded-pill bg-primary"><?php echo count($list_active_cases); ?></span></b>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                        <b>INACTIVE CASES <span class="badge rounded-pill bg-danger"><?php echo count($list_inactive_cases); ?></span></b>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                
                <div class="mt-3 mb-3 tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    
                    <table id="active-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Positive ID</th>
                                <th>Population ID</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
                                <th>Barangay</th>
                                <th>Primary Mobile #</th>
                                <th>Secondary Mobile #</th>
                                <th>Date Tested Positive</th>
                                <th>Tracing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list_active_cases as $i => $case): ?>
                                <tr class="view-active" data-case='<?php echo json_encode($case); ?>'>
                                    <td><?php echo $case->positive_id; ?></td>
                                    <td><?php echo $case->population_id; ?></td>
                                    <td><?php echo $case->firstname; ?></td>
                                    <td><?php echo $case->middlename; ?></td>
                                    <td><?php echo $case->lastname; ?></td>
                                    <td><?php echo $case->barangay; ?></td>
                                    <td><?php echo $case->primary_mobile_no; ?></td>
                                    <td><?php echo $case->secondary_mobile_no; ?></td>
                                    <td><?php echo $case->date_tested_positive; ?></td>
                                    <td><a href="<?php echo BASE_URL . "/cmo/page-tracing.php?population_id=" . $case->population_id . "&date_positive=" . $case->date_tested_positive . "&positive_id=" . $case->positive_id; ?>" class="btn btn-sm btn-primary text-white">GO <i class="fa fa-code-branch"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <div class="card mt-5">
                        <div class="card-body">
                        <h3 class="fs-4 mb-3 text-secondary">Generate Tree Report</h3>
                        <form action="print_positive.php" method="POST">
                            <div class="input-group">
                                <span class="input-group-text">Date From:</span>
                                <input type="date" name="from" class="form-control" id="from">
                                <span class="input-group-text">Date To:</span>
                                <input type="date" name="to" class="form-control" id="to">
                            </div>

                            <button class="btn btn-primary float-right mt-3" id="generate">
                                GENERATE AND PRINT <i class="fa fa-print"></i>
                            </button>
                        </form>

                        </div>
                    </div>

                </div>
                <div class="mt-3 mb-3 tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table id="inactive-table" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Positive ID</th>
                                <th>Population ID</th>
                                <th>Status</th>
                                <th>Details</th>
                                <th>Firstname</th>
                                <th>Middlename</th>
                                <th>Lastname</th>
                                <th>Barangay</th>
                                <th>Primary Mobile #</th>
                                <th>Secondary Mobile #</th>
                                <th>Date Tested Positive</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list_inactive_cases as $i => $case): ?>
                                <tr class="view-inactive" data-case='<?php echo json_encode($case); ?>'>
                                    <td><?php echo $case->positive_id; ?></td>
                                    <td><?php echo $case->population_id; ?></td>
                                    <td><?php echo $case->status; ?></td>
                                    <td><?php echo $case->details; ?></td>
                                    <td><?php echo $case->firstname; ?></td>
                                    <td><?php echo $case->middlename; ?></td>
                                    <td><?php echo $case->lastname; ?></td>
                                    <td><?php echo $case->barangay; ?></td>
                                    <td><?php echo $case->primary_mobile_no; ?></td>
                                    <td><?php echo $case->secondary_mobile_no; ?></td>
                                    <td><?php echo $case->date_tested_positive; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal New Case -->
<div class="modal fade" id="new-case-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="<?php echo BASE_URL . "/cmo/record-new-positive.php"; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">RECORD NEW CASE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label"><b>Population:</b></label><br/>
                        <select id="select2-option" class="form-control" name='population_id'>
                            <?php foreach($list_population as $i => $population): ?>
                                <option value="<?php echo $population->population_id; ?>"><?php echo $population->firstname . " " . $population->middlename . ", " . $population->lastname; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><b>Date Found Positive:</b></label>
                        <input type="date" class="form-control" name='date_tested_positive'>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Case -->
<div class="modal fade" id="update-case-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <form method="post" action="<?php echo BASE_URL . "/cmo/record-updates-positive.php"; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">UPDATE CASE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="positive_id">
                    <div class="mb-3">
                        <label class="form-label"><b>Set Status:</b></label><br/>
                        <select class="form-control select2-option" name='status'>
                            <option value="deceased">Deceased</option>
                            <option value="recovered">Recovered</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><b>Details:</b></label>
                        <textarea name="details" class="form-control"></textarea>
                    </div>
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

        $('#generate').click(function (){
            let from = $('#from').val();
            let to = $('#to').val();

            if (from.length < 1 && to.length < 1) {
                Swal.fire('Invalid', 'Please specify date from and to.');
                return false;
            }

            return true;

        });

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
