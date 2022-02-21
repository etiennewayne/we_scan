<?php 

require('../dbconnect.php');

if(!isset($_POST['date_to'])) {
    echo "incomplete";
    return;
}

$_POST['date_to'] = $_POST['date_to'] . " 00:00:01";

try {

    $establishment_logs = $db->result('archived_establishment_logs','date_in >= "' . $_POST['date_to'] . '"');
    $transportation_logs = $db->result('archived_transportation_logs','date_in >= "' . $_POST['date_to'] . '"');
    $encounter_logs = $db->result('archived_encounter_logs','date_contact >= "' . $_POST['date_to'] . '"');
    
    $db->query_plain('START TRANSACTION');

    if($establishment_logs) {
        foreach($establishment_logs as $i => $logs) {
            $db->insert('establishment_logs',array(
                'log_id' => $logs->log_id,
                'establishment_id' => $db->addqoute($logs->establishment_id),
                'population_id' => $db->addqoute($logs->population_id),
                'date_in' => $db->addqoute($logs->date_in),
                'date_out' => $db->addqoute($logs->date_out)        
            ));
        }

        $db->delete('archived_establishment_logs','date_in >= "' . $_POST['date_to'] . '"');
    }

    if($transportation_logs) {
        foreach($transportation_logs as $i => $logs) {
            $db->insert('transportation_logs',array(
                'log_id' => $logs->log_id,
                'transportation_id' => $db->addqoute($logs->transportation_id),
                'population_id' => $db->addqoute($logs->population_id),
                'date_in' => $db->addqoute($logs->date_in),
                'date_out' => $db->addqoute($logs->date_out)   
            ));
        }

        $db->delete('archived_transportation_logs','date_in >= "' . $_POST['date_to'] . '"');
    }

    if($encounter_logs) {
        foreach($encounter_logs as $i => $logs) {
            $db->insert('encounter_logs',array(
                'log_id' => $logs->log_id,
                'population_id' => $db->addqoute($logs->population_id),
                'contact_id' => $db->addqoute($logs->contact_id),
                'date_contact' => $db->addqoute($logs->date_contact)   
            ));
        }

        $db->delete('archived_encounter_logs','date_contact >= "' . $_POST['date_to'] . '"');
    }

    $db->query_plain('COMMIT');

    header('location: archiving.php?status='. html_entity_decode('Restore data successful'));

}
catch(Exception $e) {

    $db->query_plain('ROLLBACK');
    echo "ERROR RESTORING DATA";
    print_r($e);

}