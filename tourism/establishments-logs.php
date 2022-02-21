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

    $establishment_id = $_POST['establishment_id'];
    $e1 = $db->row('establishments', "establishment_id='" . $establishment_id . "'");

    $date = $_POST['date'];

    $d = explode(' - ', $date);

    $x1 = $d[0];
    $x2 = $d[1];

    $n1 = explode('/', $x1);
    $n2 = explode('/', $x2);

    $from = $n1[2].'-'.$n1[0].'-'.$n1[1];
    $to   = $n2[2].'-'.$n2[0].'-'.$n2[1];

    if ($from == $to) {
        $establishment_logs = $db->result('establishment_logs',"establishment_id='" . $establishment_id . "' AND date_in LIKE '%$from%' ORDER BY date_in DESC");
    } else {
        $establishment_logs = $db->result('establishment_logs',"establishment_id='" . $establishment_id . "' AND date_in BETWEEN '$from' AND '$to' ORDER BY date_in DESC");
    }
?>

<div style="width: 816px">

    <div style="padding: 5px; text-align:center">
        <b><?= $e1->name; ?></b><br/>
        <?= $e1->business_permit_no; ?><br/>
        <?= $e1->address; ?><br/>
        <br/>
        Logs as of <?= $from == $to ? $from:$date; ?>
    </div>
    <br>
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

</body>
</html>
