<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

if (!isset($_POST['submitted'])) {
    die('Error using this file.');
}

require('../dbconnect.php');

$user_id = $_POST['user_id'];
$data = array();

foreach ($_POST as $key => $value) {
    if ($key != 'submitted' && $key != 'user_id' && $key != 'editKey') {
        $data[$key] = $db->addqoute($value);
    }
}

if ($_POST['editKey'] === 'username') {

    $users = $db->result('users', "username='" . $_POST['username'] . "'");
    if (sizeof($users) > 0) {
        $result = array(
            'status' => 'Exist',
            'message' => "Failed to update account because the specified username is already in used."
        );
    } else {

        $update = $db->update('users', $data, "user_id=$user_id");

        if ($db->affected_rows >= 0) {
            $result = array(
                'status' => 'Success',
                'message' => 'Account updated.'
            );
        } else {
            $result = array(
                'status' => 'Failed',
                'message' => "Failed to update account."
            );
        }
    }
} else {
    $update = $db->update('users', $data, "user_id=$user_id");

    if ($db->affected_rows >= 0) {
        $result = array(
            'status' => 'Success',
            'message' => 'Account updated.'
        );
    } else {
        $result = array(
            'status' => 'Failed',
            'message' => "Failed to update account."
        );
    }
}

echo json_encode($result);
