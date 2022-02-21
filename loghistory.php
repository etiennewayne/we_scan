<?php
include ('header.php');
$client_id = $db->addqoute($client->population_id);
?>

<div class="container mb-5 bg-white py-3">
    <div class="row">
        <div class="col-md-12">
             <div class="h5 mb-3">Log History</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

            <ul class="nav  nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Establishments</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#transpo" type="button" role="tab" aria-controls="profile" aria-selected="false">Transportation</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact People</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="p-4">
                        <table class="table table-bordered mb-3" id="d1">
                            <thead>
                            <tr>
                                <th>Establishment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $logsEst = $db->result('establishment_logs', "population_id=$client_id ORDER BY date_in DESC"); ?>
                            <?php if (sizeof($logsEst) > 0) : ?>
                                <?php foreach ($logsEst as $row) : ?>
                                    <?php $establishment = $db->row('establishments', "establishment_id=".$db->addqoute($row->establishment_id)); ?>
                                    <tr>
                                        <td>
                                            <div><?= $establishment->name . ', ' . $establishment->address; ?></div>
                                            <div>
                                                Login: <?= $row->date_in; ?><br/>Logout <?= $row->date_out; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td>No logs found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="transpo" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="p-4">
                        <table class="table table-bordered mb-3" id="d2">
                            <thead>
                            <tr>
                                <th>Transportation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $logsTrans = $db->result('transportation_logs', "population_id=$client_id ORDER BY date_in DESC"); ?>
                            <?php if (sizeof($logsTrans) > 0) : ?>
                                <?php foreach ($logsTrans as $row) : ?>
                                    <?php $transportation = $db->row('transportation', "transportation_id=".$db->addqoute($row->transportation_id)); ?>
                                    <tr>
                                        <td>
                                            <div><?= $transportation->vehicle . ', with Plate No.:' . $transportation->plate_no; ?></div>
                                            <div>Driver Name: <?= $transportation->name_of_driver; ?></div>
                                            <div>
                                                Login: <?= $row->date_in; ?><br/> Logout: <?= $row->date_out; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td>No logs found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="p-4">
                        <table class="table table-bordered mb-3" id="d3">
                            <thead>
                            <tr>
                                <th>People Contact</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $logsEncounter = $db->result('encounter_logs', "population_id=$client_id ORDER BY date_contact DESC"); ?>
                            <?php if (sizeof($logsEncounter) > 0) : ?>
                                <?php foreach ($logsEncounter as $row) : ?>
                                    <?php $population = $db->row('population', "population_id=".$db->addqoute($row->contact_id)); ?>
                                    <tr>
                                        <td>
                                            <div class="info">
                                                <div><?= strtoupper($population->firstname . ' ' . $population->middlename . ' ' . $population->lastname); ?></div>
                                                <div><small><?= $row->population_id; ?></small></div>
                                            </div>
                                            <div>Contact Date and Time: <?= $row->date_contact; ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td>No logs found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="includes/datatable/datatables.min.js"></script>
<script>

    $('#mnuHistory')
        .addClass(' active')
        .attr('aria-current', 'page')
        .attr('href', '#');

    $('#d1').dataTable({
        responsive: true,
        autoWidth: false
    });

    $('#d2').dataTable({
        responsive: true,
        autoWidth: false
    });

    $('#d3').dataTable({
        responsive: true,
        autoWidth: false
    });

</script>

<?php include ('footer.php'); ?>
