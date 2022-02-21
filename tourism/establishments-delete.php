<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('../dbconnect.php');

$establishment_id = $db->addqoute($_POST['establishment_id']);
$delete = $db->delete('establishments', "establishment_id=$establishment_id");
if ($delete) {
    $result = array(
        'status' => 'Success',
        'message' => 'Establishment has been deleted.',
    );
} else {
    $result = array(
        'status' => 'Failed',
        'message' => 'Failed to delete establishment.'
    );

}

echo json_encode($result);
