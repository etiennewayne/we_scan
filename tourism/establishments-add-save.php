<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('token-generator.php');
require ('../dbconnect.php');

$name                   = $db->addqoute($_POST['name']);
$address                = $db->addqoute($_POST['address']);
$business_permit_no     = $db->addqoute($_POST['business_permit_no']);
$establishment_id       = $db->addqoute('ESTBMNT'.date('YmdHis'));

$exist = $db->is_exist('establishments', "name=$name AND business_permit_no=$business_permit_no");
if ($exist) {
    $result = array(
        'status' => 'Exist',
        'message' => 'Establishment is already used.'
    );
} else {

        $data = array(
            'establishment_id' => $establishment_id,
            'name' => $name,
            'address' => $address,
            'business_permit_no' => $business_permit_no
        );

        $insert = $db->insert('establishments', $data);

        if ($insert) {
            $result = array(
                'status' => 'Success',
                'message' => 'Establishment has been successfully saved.'
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Failed to save establishment.'
            );
        }


}

echo json_encode($result);
