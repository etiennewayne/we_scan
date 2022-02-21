<?php

if (!isset($_POST['submitted'])) {
    die('Error using this file.');
}

require('../dbconnect.php');

$establishment_id           = $db->addqoute($_POST['establishment_id']);
$name                       = $db->addqoute($_POST['name']);
$address                    = $db->addqoute($_POST['address']);
$business_permit_no         = $db->addqoute($_POST['business_permit_no']);

$establishments = $db->result('establishments', "establishment_id!=$establishment_id");

$exist = false;
foreach ($establishments as $i) {
    if (strtolower($i->name) == strtolower($_POST['name']) && $i->business_permit_no == $_POST['address']) {
        $exist = true;
        break;
    }
}

if ($exist) {
    $result = array(
        'status' => 'Exist',
        'message' => 'Establishment is already used.'
    );
} else {

    $data = array(
        'name' => $name,
        'address' => $address,
        'business_permit_no' => $business_permit_no,
    );

    $update = $db->update('establishments', $data, "establishment_id=$establishment_id");

    if ($db->affected_rows >= 0) {
        $result = array(
            'status' => 'Success',
            'message' => 'Establishment has been updated.',
        );
    } else {
        $result = array(
            'status' => 'Failed',
            'message' => "Failed to update establishment."
        );
    }


}

echo json_encode($result);
