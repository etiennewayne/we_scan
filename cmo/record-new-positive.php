<?php 

require('../constants.php');
require('../dbconnect.php');

$attrs = array('population_id', 'date_tested_positive');

foreach($attrs as $i => $attr) {
    if(!isset($_POST[$attr])) {
        header('Location: '. BASE_URL . '/cmo/home.php');
        die();
    }

    if(empty($_POST[$attr])) {
        header('Location: '. BASE_URL . '/cmo/home.php');
        die();
    }
}

$db->insert('positive_incidences',array(
    'population_id' => $db->addqoute($_POST['population_id']),
    'date_tested_positive' => $db->addqoute($_POST['date_tested_positive'])
));

header('Location: '. BASE_URL . '/cmo/home.php');