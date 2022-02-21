<?php

include ('header.php');
$establishment_logs = $db->result('establishment_logs','','date_in DESC');
$transportation_logs = $db->result('transportation_logs','','date_in DESC');
$encounter_logs = $db->result('encounter_logs','','date_contact DESC');
?>

<div class="container bg-white pl-5 pr-5 pt-4 pb-5">
    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title text-secondary d-flex align-items-center">
            <i class="fa fa-book fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">ACTIVE VISITATION LOGS</span>
            </div>
        </div>
        <a href="archiving.php" class="btn btn-primary">Back to Archiving</a>
    </div>

    <div class="row my-3">
        <div class="col-md-12">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Population</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="establishment-tab" data-bs-toggle="tab" data-bs-target="#establishment" type="button" role="tab" aria-controls="establishment" aria-selected="false">Establishment</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="transportation-tab" data-bs-toggle="tab" data-bs-target="#transportation" type="button" role="tab" aria-controls="transportation" aria-selected="false">Transportation</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="data1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Direct Contact</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (sizeof($encounter_logs) > 0) : ?>
                                        <?php foreach($encounter_logs as $row) : ?>
                                        <?php
                                            $p1 = $db->row('population', "population_id='" . $row->population_id . "'");
                                            $p2 = $db->row('population', "population_id='" . $row->contact_id . "'");
                                         ?>
                                        <tr>
                                            <td>
                                                <b><?= $p1->firstname . ' ' . $p1->middlename . ' ' . $p1->lastname;  ?></b><br/>
                                                <?= $p1->purok . ', ' . $p1->barangay;  ?><br/>
                                                <?= $p1->primary_mobile_no;  ?><br/>
                                            </td>
                                            <td>
                                                <b><?= $p2->firstname . ' ' . $p2->middlename . ' ' . $p2->lastname;  ?></b><br/>
                                                <?= $p2->purok . ', ' . $p2->barangay;  ?><br/>
                                                <?= $p2->primary_mobile_no;  ?><br/>
                                            </td>
                                            <td><?= $row->date_contact; ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr>
                                        <td colspan="3">No data to show.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="establishment" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="data2">
                                <thead>
                                <tr>
                                    <th>Estabishment</th>
                                    <th>Visitors</th>
                                    <th>Date In</th>
                                    <th>Date Out</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (sizeof($establishment_logs) > 0) : ?>
                                    <?php foreach($establishment_logs as $row) : ?>
                                        <?php
                                        $p1 = $db->row('population', "population_id='" . $row->population_id . "'");
                                        $e1 = $db->row('establishments', "establishment_id='" . $row->establishment_id . "'");
                                        ?>
                                        <tr>
                                            <td>
                                                <b><?= $e1->name;  ?></b><br/>
                                                <?= $e1->address;  ?>
                                            </td>
                                            <td>
                                                <b><?= $p1->firstname . ' ' . $p1->middlename . ' ' . $p1->lastname;  ?></b><br/>
                                                <?= $p1->purok . ', ' . $p1->barangay;  ?><br/>
                                                <?= $p1->primary_mobile_no;  ?><br/>
                                            </td>
                                            <td><?= $row->date_in; ?></td>
                                            <td><?= $row->date_out; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3">No data to show.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="transportation" role="tabpanel" aria-labelledby="contact-tab">

                    <div class="p-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" id="data3">
                                <thead>
                                <tr>
                                    <th>Transportation</th>
                                    <th>Passenger</th>
                                    <th>Onboard</th>
                                    <th>Offboard</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (sizeof($transportation_logs) > 0) : ?>
                                    <?php foreach($transportation_logs as $row) : ?>
                                        <?php
                                        $p1 = $db->row('population', "population_id='" . $row->population_id . "'");
                                        $t1 = $db->row('transportation', "transportation_id='" . $row->transportation_id . "'");
                                        ?>
                                        <tr>
                                            <td>
                                                <b><?= $t1->vehicle . ' Plate No. ' . $t1->plate_no;  ?></b><br/>
                                                <?= $t1->name_of_driver;  ?><br/>
                                                <?= $t1->address_of_driver;  ?>
                                            </td>
                                            <td>
                                                <b><?= $p1->firstname . ' ' . $p1->middlename . ' ' . $p1->lastname;  ?></b><br/>
                                                <?= $p1->purok . ', ' . $p1->barangay;  ?><br/>
                                                <?= $p1->primary_mobile_no;  ?><br/>
                                            </td>
                                            <td><?= $row->date_in; ?></td>
                                            <td><?= $row->date_out; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3">No data to show.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>

<script>

    $(function() {

        $('#data1').dataTable();
        $('#data2').dataTable();
        $('#data3').dataTable();

    });

</script>

<?php include ('footer.php'); ?>
