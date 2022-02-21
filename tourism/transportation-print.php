<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Transportation QRCODE</title>

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
$transportation_id = $_GET['transportation_id'];
$transportation = $db->row('transportation', "transportation_id='" . $transportation_id . "'");
?>

<div id="content">
    <div id="qrcode"></div>
    <div style="margin-top:20px;text-align:center">
        <h4><?= strtoupper($transportation->vehicle); ?></h4>
        <div>Driver: <?= $transportation->name_of_driver; ?></div>
        <div><?= $transportation->address_of_driver; ?></div>
        <div>Plate No.: <?= $transportation->plate_no; ?></div>
    </div>
</div>

<script src="../includes/qrcode/qrcode.js"></script>
<script>

    const qrcode = new QRCode(document.getElementById('qrcode'), {
        height: 300,
        width: 300
    });

    qrcode.makeCode('<?= $transportation_id; ?>')

</script>

</body>
</html>
