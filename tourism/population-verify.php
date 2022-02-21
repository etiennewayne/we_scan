<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('../dbconnect.php');

$population_id = $db->addqoute($_POST['population_id']);
$update = $db->update('population', array('remarks'=>$db->addqoute('Verified')), "population_id=$population_id");
if ($db->affected_rows >= 0) {
    $result = array(
        'status' => 'Success',
        'message' => "Information verified successfully.",
    );
} else {
    $result = array(
        'status' => 'Failed',
        'message' => "Failed to verify information."
    );

}

echo json_encode($result);
