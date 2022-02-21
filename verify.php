<?php

    require('dbconnect.php');

    $username = $db->addqoute($_POST['username']);
    $password = $db->addqoute($_POST['password']);

    $results = $db->result('population', "username=$username AND password=$password and remarks='Verified'");
    if (sizeof($results) > 0) {
        session_start();
        $client = $results[0];
        $token = $client->population_id;
        $_SESSION['token'] = array(
            'token' => $token,
            'isClientLogin' => 1
        );
        header('location: home.php');
    } else {
        header('location: index.php?login=error');
    }
