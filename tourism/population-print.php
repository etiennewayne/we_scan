<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Individual QRCODE</title>

    <style>
        h1, h2, h3, h4, h5, h6 {
            padding: 0;
            margin: 0;
        }

        #content {
            height: 400px;
            width: 300px;
            margin: 0 auto;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<?php
require ('../constants.php');
require ('../dbconnect.php');
$population_id = $_GET['population_id'];
$population = $db->row('population', "population_id='" . $population_id . "'");

function getAge($dob){

    $dob = date("Y-m-d",strtotime($dob));

    $dobObject = new DateTime($dob);
    $nowObject = new DateTime();

    $diff = $dobObject->diff($nowObject);

    return $diff->y;

}
?>

<div id="content">
    <div id="qrcode"></div>
    <div style="margin-top:20px;text-align:center">
        <h4><?= strtoupper($population->lastname.', '.$population->firstname.' '.$population->suffix.' '.$population->middlename); ?></h4>

        <div><?= getAge($population->date_of_birth) . 'y, ' . $population->gender; ?></div>
        <div><?= $population->purok . ', ' . $population->barangay . ', Tangub City'; ?></div>
    </div>
</div>

<script src="../includes/qrcode/qrcode.js"></script>
<script>

    const qrcode = new QRCode(document.getElementById('qrcode'), {
        height: 300,
        width: 300
    });

    qrcode.makeCode('<?= $population_id; ?>')

</script>

</body>
</html>
