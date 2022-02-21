<?php

session_start();
require ('../dbconnect.php');

if (!isset($_SESSION['token'])) {
    header('location: index.php');
} else {

    $token = $_SESSION['token'];
    if ($token['isCMOLogin'] != 1) {
        header('location: index.php');
    } else {
        $token = $_SESSION['token']['token'];
        $loginToken = $db->addqoute($token);

        $results = $db->result('users', "token=$loginToken");
        if (sizeof($results) < 1) {
            header('location: index.php');
        } else {
            $cmo = $results[0];
        }
    }

}