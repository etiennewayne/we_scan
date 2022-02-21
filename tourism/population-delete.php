<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('../dbconnect.php');

$population_id = $db->addqoute($_POST['population_id']);
$delete = $db->delete('population', "population_id=$population_id");
if ($delete) {
    $result = array(
        'status' => 'Success',
        'message' => "Individual's information has been deleted.",
    );
} else {
    $result = array(
        'status' => 'Failed',
        'message' => "Failed to delete individual's information."
    );

}

echo json_encode($result);
