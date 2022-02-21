<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('token-generator.php');
require ('../dbconnect.php');

$name_of_driver          = $db->addqoute($_POST['name_of_driver']);
$address_of_driver       = $db->addqoute($_POST['address_of_driver']);
$vehicle                 = $db->addqoute($_POST['vehicle']);
$plate_no                = $db->addqoute($_POST['plate_no']);
$transportation_id       = $db->addqoute('TRANSPO'.date('YmdHis'));

$exist = $db->is_exist('transportation', "plate_no=$plate_no");
if ($exist) {
    $result = array(
        'status' => 'Exist',
        'message' => 'Transportation is already used.'
    );
} else {

    $data = array(
        'transportation_id' => $transportation_id,
        'name_of_driver' => $name_of_driver,
        'address_of_driver' => $address_of_driver,
        'vehicle' => $vehicle,
        'plate_no' => $plate_no
    );

    $insert = $db->insert('transportation', $data);

    if ($insert) {
        $result = array(
            'status' => 'Success',
            'message' => 'Transportation has been successfully saved.'
        );
    } else {
        $result = array(
            'status' => 'Failed',
            'message' => 'Failed to save transportation.'
        );
    }


}

echo json_encode($result);
