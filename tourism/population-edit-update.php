<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('../dbconnect.php');

$data = array();
foreach ($_POST as $key => $value) {
    if ($key != 'submitted' && $key != 'editKey') {
        $data[$key] = $db->addqoute($value);
    }
}

$population_id = $db->addqoute($_POST['population_id']);
$editKey       = $_POST['editKey'];
$error         = false;

$people = $db->result('population', "population_id!=$population_id");

if ($editKey == 'fullname') {

    $exist = false;
    foreach ($people as $i) {
        if (strtolower($i->lastname) == strtolower($_POST['lastname']) &&
            strtolower($i->firstname) == strtolower($_POST['firstname']) &&
            strtolower($i->middlename) == strtolower($_POST['middlename']) &&
            strtolower($i->suffix) == strtolower($_POST['suffix'])) {
            $exist = true;
            break;
        }
    }

    if ($exist) {
        $result = array(
            'status' => 'Exist',
            'message' => 'Full name is already exist.'
        );
        $error = true;
    }

} else if ($editKey == 'contactDetails') {

    $exist1 = false;
    $exist2 = false;
    foreach ($people as $i) {
        if (strlen($_POST['email_address']) > 0) {
            if ($i->email_address == $_POST['email_address']) {
                $exist1 = true;
                break;
            }
        }

        if ($i->primary_mobile_no == $_POST['primary_mobile_no']) {
            $exist2 = true;
            break;
        }
    }

    if ($exist1) {
        $result = array(
            'status' => 'Exist',
            'message' => 'Email address is already used.'
        );
        $error = true;
    }

    if ($exist2) {
        $result = array(
            'status' => 'Exist',
            'message' => 'Primary mobile number is already used.'
        );
        $error = true;
    }

}  else if ($editKey == 'username') {

    $exist = false;
    foreach ($people as $i) {
        if ($i->username == $_POST['username']) {
            $exist = true;
            break;
        }
    }

    if ($exist) {
        $result = array(
            'status' => 'Exist',
            'message' => 'Username is already used.'
        );
        $error = true;
    }

}

if (!$error) {
    $update = $db->update('population', $data, "population_id=$population_id");
    if ($db->affected_rows >= 0) {
        $result = array('status' => 'Success', 'message' => 'Successfully updated.',);
    } else {
        $result = array('status' => 'Failed', 'message' => "Failed to update.");
    }
}

echo json_encode($result);



