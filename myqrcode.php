<?php
include ('header.php');
$client_id = $client->population_id;
?>

<div class="container mb-5 bg-white pt-3 pb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="h5 mb-3">My QR Code</div>
            <div class="mt-5 d-flex flex-column justify-content-center align-items-center">
                <div id="qrcode"></div>
                <div class="mt-3"><?= $client_id; ?></div>
            </div>
        </div>
    </div>
</div>

<script src="includes/qrcode/qrcode.js"></script>
<script>

    const qrcode = new QRCode(document.getElementById('qrcode'), {
        height: 200,
        width: 200
    });

    qrcode.makeCode('<?= $client_id; ?>');

    $('#mnuQRCode')
        .addClass(' active')
        .attr('aria-current', 'page')
        .attr('href', '#');

</script>

<?php include ('footer.php'); ?>
