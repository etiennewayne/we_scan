<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

date_default_timezone_set('Asia/Manila');

require ('dbconnect.php');

function code($qrcode) {
    $code = '';
    for($i=0; $i<7; $i++) {
        $code .= $qrcode[$i];
    }
    return $code;
}

$qrcode                  = $db->addqoute($_POST['qrcode']);
$population_id           = $db->addqoute($_POST['population_id']);
$date_time               = $db->addqoute(date('Y-m-d h:i:s'));

$today                   = date('Y-m-d');

$code = code($_POST['qrcode']);

if ($code === 'ESTBMNT') {

    $exist = $db->is_exist('establishment_logs', "population_id=$population_id AND establishment_id=$qrcode AND date_out IS NULL");
    if ($exist) {

        $insert = $db->update('establishment_logs', array(
            'date_out' => $date_time
        ), "population_id=$population_id AND date_out IS NULL");

        if ($db->affected_rows >= 0) {
            $result = array(
                'status' => 'Success',
                'message' => 'Exit successful.',
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Exit failed.',
            );
        }

    } else {

        $insert = $db->insert('establishment_logs', array(
            'establishment_id' => $qrcode,
            'population_id' => $population_id,
            'date_in' => $date_time
        ));

        if ($insert) {
            $result = array(
                'status' => 'Success',
                'message' => 'Entry successful.',
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Entry failed.',
            );
        }

    }

} elseif ($code === 'TRANSPO') {

    $exist = $db->is_exist('transportation_logs', "population_id=$population_id AND transportation_id=$qrcode AND date_out IS NULL");
    if ($exist) {

        $insert = $db->update('transportation_logs', array(
            'date_out' => $date_time
        ), "population_id=$population_id AND date_out IS NULL");

        if ($db->affected_rows >= 0) {
            $result = array(
                'status' => 'Success',
                'message' => 'Offboard successful.',
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Offboard failed.',
            );
        }

    } else {

        $insert = $db->insert('transportation_logs', array(
            'transportation_id' => $qrcode,
            'population_id' => $population_id,
            'date_in' => $date_time
        ));

        if ($insert) {
            $result = array(
                'status' => 'Success',
                'message' => 'Onboard successful.',
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Onboard failed.',
            );
        }

    }

}  elseif ($code === 'INDVDLS') {

        $insert = $db->insert('encounter_logs', array(
            'contact_id' => $qrcode,
            'population_id' => $population_id,
            'date_contact' => $date_time
        ));

        if ($insert) {
            $result = array(
                'status' => 'Success',
                'message' => 'Encounter recorded successfully.',
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => 'Encounter record failed.',
            );
        }

} else {
    $result = array(
        'status' => 'Unknown',
        'message' => 'QR Code is unknown.',
        'text' => $_POST['qrcode']
    );
}


echo json_encode($result);
