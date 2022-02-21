<?php

if (!isset($_POST['submitted'])) {
    die('Error using this file.');
}

require('../dbconnect.php');

$transportation_id          = $db->addqoute($_POST['transportation_id']);
$name_of_driver             = $db->addqoute($_POST['name_of_driver']);
$address_of_driver          = $db->addqoute($_POST['address_of_driver']);
$vehicle                    = $db->addqoute($_POST['vehicle']);
$plate_no                   = $db->addqoute($_POST['plate_no']);

$transportations = $db->result('transportation', "transportation_id!=$transportation_id");

$exist = false;
foreach ($transportations as $i) {
    if ($i->plate_no == $_POST['plate_no']) {
        $exist = true;
        break;
    }
}

if ($exist) {
    $result = array(
        'status' => 'Exist',
        'message' => 'Transportation is already used.'
    );
} else {

    $data = array(
        'name_of_driver' => $name_of_driver,
        'address_of_driver' => $address_of_driver,
        'vehicle' => $vehicle,
        'plate_no' => $plate_no,
    );

    $update = $db->update('transportation', $data, "transportation_id=$transportation_id");

    if ($db->affected_rows >= 0) {
        $result = array(
            'status' => 'Success',
            'message' => 'Transportation has been updated.',
        );
    } else {
        $result = array(
            'status' => 'Failed',
            'message' => "Failed to update transportation."
        );
    }


}

echo json_encode($result);
