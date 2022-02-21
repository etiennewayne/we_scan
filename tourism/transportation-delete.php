<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('../dbconnect.php');

$transportation_id = $db->addqoute($_POST['transportation_id']);
$delete = $db->delete('transportation', "transportation_id=$transportation_id");
if ($delete) {
    $result = array(
        'status' => 'Success',
        'message' => 'transportation has been deleted.',
    );
} else {
    $result = array(
        'status' => 'Failed',
        'message' => 'Failed to delete transportation.'
    );

}

echo json_encode($result);
