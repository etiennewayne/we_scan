<?php
include ('header.php');
$client_id = $client->population_id;
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="h5 text-center mt-3">
                <?= $_GET['message']; ?>
            </div>
            <a href="home.php" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
<script>

    alertify.set('notifier', 'position', 'top-right');

    $('#mnuHome')
        .addClass(' active')
        .attr('aria-current', 'page')
        .attr('href', '#');

    function onScanSuccess(decodedText, decodedResult) {
        sendlog(decodedText);
        html5QrcodeScanner.clear();
    }

    var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {fps: 10, qrbox: 250});
    html5QrcodeScanner.render(onScanSuccess);

    function sendlog(qrCode) {
        let qrcode = qrCode;
        let population_id = `<?= $client->population_id; ?>`;

        const makeInsert = insertData('save_log.php', {
            qrcode, population_id, submitted: true
        });

        if (makeInsert.status === 'Success') {
            alertify.message(makeInsert.message);
        } else {
            alertify.error(`${makeInsert.text} is not a registered establishment or transportation code.`)
        }

    }

</script>

<?php include ('footer.php'); ?>
