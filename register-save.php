<?php

if (!isset($_POST['submitted'])) {
    die('Error in accessing this file.');
}

require ('tourism/token-generator.php');
require ('dbconnect.php');

$lastname                       = $db->addqoute($_POST['lastname']);
$firstname                      = $db->addqoute($_POST['firstname']);
$middlename                     = $db->addqoute($_POST['middlename']);
$suffix                         = $db->addqoute($_POST['suffix']);
$sex                            = $db->addqoute($_POST['sex']);
$date_of_birth                  = $db->addqoute($_POST['date_of_birth']);
$email_address                  = $db->addqoute($_POST['email_address']);
$primary_mobile_no              = $db->addqoute($_POST['primary_mobile_no']);
$secondary_mobile_no            = $db->addqoute($_POST['secondary_mobile_no']);
$purok                          = $db->addqoute($_POST['purok']);
$barangay                       = $db->addqoute($_POST['barangay']);
$username                       = $db->addqoute($_POST['username']);
$password                       = $db->addqoute($_POST['password']);
$latitude                       = $_POST['latitude'];
$longitude                      = $_POST['longitude'];
$population_id                  = $db->addqoute('INDVDLS'.date('YmdHis'));

$exist = $db->is_exist('population', "lastname=$lastname AND firstname=$firstname AND middlename=$middlename AND gender=$sex");
if ($exist) {
    $result = array(
        'status' => 'Exist',
        'message' => 'Individual is already exist.'
    );
} else {

    $whereEmail = "email_address='joker'";
    if (strlen($_POST['email_address']) > 0) {
        $whereEmail = "email_address=$email_address";
    }

    $emailExist = $db->is_exist('population', $whereEmail);
    if ($emailExist) {
        $result = array(
            'status' => 'Exist',
            'message' => 'Email address is already in used.'
        );
    } else {

        $primaryExist = $db->is_exist('population', "primary_mobile_no=$primary_mobile_no");
        if ($primaryExist) {
            $result = array(
                'status' => 'Exist',
                'message' => 'Primary mobile number is already in used.'
            );
        } else {

            $data = array(
                'population_id' => $population_id,
                'lastname' => $lastname,
                'firstname' => $firstname,
                'middlename' => $middlename,
                'suffix' => $suffix,
                'gender' => $sex,
                'date_of_birth' => $date_of_birth,
                'email_address' => $email_address,
                'primary_mobile_no' => $primary_mobile_no,
                'secondary_mobile_no' => $secondary_mobile_no,
                'purok' => $purok,
                'barangay' => $barangay,
                'username' => $username,
                'password' => $password,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'remarks' => $db->addqoute('Unverified')
            );

            $insert = $db->insert('population', $data);

            if ($insert) {
                $result = array(
                    'status' => 'Success',
                    'message' => "Registration has been successfully submitted. However, your registration is not official until the tourism office verifies that your registration information is true. Please visit the city tourism office for a verification of your information."
                );
            } else {
                $result = array(
                    'status' => 'Failed',
                    'message' => "Failed to save individual's information."
                );
            }

        }

    }

}

echo json_encode($result);
