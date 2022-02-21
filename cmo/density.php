<?php
include ('header.php');
$incidents = $db->result('vw_positive_incidences', "status IS NULL");
?>

<div id="map"></div>

<script>

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: new google.maps.LatLng(8.096879, 123.706058),
            zoom: 12,
            mapTypeId: 'roadmap'
        });

        <?php foreach ($incidents as $row) : ?>

        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(`<?= $row->latitude; ?>`, `<?= $row->longitude; ?>`),
            animation:  google.maps.Animation.DROP,
            title: `<?= $row->firstname . ' ' . $row->middlename . ' ' . $row->lastname; ?>`,
            icon: {
                url: `<?= BASE_URL . 'includes/images/virus.png' ?>`,
                scaledSize: new google.maps.Size(25, 25)
            }
        });

        <?php endforeach; ?>
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAh4Ax62zxLlnyquWb1QUDvG5zdxphwtfg&callback=initMap"></script>

<?php include ('footer.php'); ?>
