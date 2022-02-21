<?php
include ('header.php');
$client_id = $client->population_id;
?>

<div class="container mb-5 bg-white py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center p-2" id="results">Scan QR Code</div>
            <div class="d-flex justify-content-center align-items-center flex-column">
                <div id="qr-reader" style="width: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<script src="includes/js/fetch.js"></script>
<script src="includes/alertify/alertify.min.js"></script>
<script>

        var scanned = false;

        alertify.set('notifier', 'position', 'top-right');

        $('#mnuHome')
            .addClass(' active')
            .attr('aria-current', 'page')
            .attr('href', '#');

        function onScanSuccess(decodedText, decodedResult) {
            if (!scanned) {
                scanned = true;
                sendlog(decodedText);
            }
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
                $('#results').removeClass('bg-danger').addClass('bg-info');
                $('#results').html(makeInsert.message);
            } else {
                $('#results').removeClass('bg-info').addClass('bg-danger');
                $('#results').html(`Unrecognized QR Code.`)
            }

            setTimeout(() => {
                $('#results').removeClass('bg-info').removeClass('bg-danger').html('');
                $('#results').html('Scan QR Code');
                scanned = false;
            }, 3000);

        }

</script>

<?php include ('footer.php'); ?>
