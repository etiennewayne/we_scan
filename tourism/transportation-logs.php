<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid #5c5c5c;
            width: 100%
        }

        td, th {
            border: 1px solid #5c5c5c
        }
    </style>
    <title>Document</title>
</head>
<body>
<?php
require ('../dbconnect.php');

$transportation_id = $_POST['transportation_id'];
$e1 = $db->row('transportation', "transportation_id='" . $transportation_id . "'");

$date = $_POST['date'];

$d = explode(' - ', $date);

$x1 = $d[0];
$x2 = $d[1];

$n1 = explode('/', $x1);
$n2 = explode('/', $x2);

$from = $n1[2].'-'.$n1[0].'-'.$n1[1];
$to   = $n2[2].'-'.$n2[0].'-'.$n2[1];

if ($from == $to) {
    $transportation_logs = $db->result('transportation_logs',"transportation_id='" . $transportation_id . "' AND date_in LIKE '%$from%' ORDER BY date_in DESC");
} else {
    $transportation_logs = $db->result('transportation_logs',"transportation_id='" . $transportation_id . "' AND date_in BETWEEN '$from' AND '$to' ORDER BY date_in DESC");
}

?>

<div style="width: 816px">

    <div style="padding: 5px; text-align:center">
        <b><?= $e1->vehicle . ', Plate No. ' . $e1->plate_no; ?></b><br/>
        <?= $e1->name_of_driver; ?><br/>
        <?= $e1->address_of_driver; ?><br/>
        <br/>
        Logs as of <?= $from == $to ? $from:$date; ?>
    </div>
    <br>
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

</body>
</html>
