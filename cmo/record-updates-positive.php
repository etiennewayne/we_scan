<?php 

require('../constants.php');
require('../dbconnect.php');

$attrs = array('status', 'details', 'positive_id');

foreach($attrs as $i => $attr) {
    if(!isset($_POST[$attr])) {
        header('location: home.php');
        die();
    }
}

$db->update('positive_incidences',array(
    'status' => $db->addqoute($_POST['status']),
    'details' => $db->addqoute($_POST['details'])
),"positive_id = " . $_POST['positive_id']);

header('location: home.php');