<?php

    require_once('../dbconnect.php');

    class TracingEngine {

        private $is_initial = true;

        private function is_params_complete($post,$list_attributes) {
            foreach($list_attributes as $i => $attribute) {
                if(!isset($post[$attribute])) {
                    return false;
                }
            }
            return true;
        }

        private function trace_visited_areas($population_id, $range_from, $range_to, $log_table, $log_column) {
            global $db;

            try {
                $result = $db->query("SELECT " . $log_column . ", date_in, date_out FROM " . $log_table . " WHERE population_id = '" . $population_id . "' AND (date_in BETWEEN '" . $range_from . "' AND '" . $range_to . "')");
            } 
            catch(Exception $e) {
                echo "VA";
            }

            return $result;
        }

        private function trace_users_in_area($area_id, $range_from, $range_to, $log_table, $log_id, $except = array()) {
            global $db;

            $except_statement = "";

            foreach($except as $ei => $e) {
            
                $except_statement = $except_statement . " AND population_id != '" . $e->population_id . "'";
            }

            try {
                $query = "SELECT population_id, date_in, date_out FROM " . $log_table . " WHERE " . $log_id . " = '" . $area_id . "' AND (date_in BETWEEN '" . $range_from . "' AND '" . $range_to . "') ";

                if(count($except) > 0) {
                    $query = $query . $except_statement;
                }

                $tmpresult = $db->query($query);
                $result = array();

                foreach($tmpresult as $i => $user) {
                    
                    $date = strtotime($user->date_out . ' - 15 days');
                    $mdate = date('Y-m-d H:i:s', $date);

                    $user->date_in = $mdate;
                    array_push(
                        $result,
                        (object) array(
                            'population_id' => $user->population_id,
                            'date_in' => $mdate,
                            'date_out' => $user->date_out
                        )
                    );

                }
            } 
            catch(Exception $e) {
                echo "UA";
            }

            return $result;
        }

        private function trace_scanned_people($population_id, $range_from, $range_to, $except = array()) {
            global $db;

            $except_statement = "";

            if($this->is_initial === false) {

                foreach($except as $ei => $e) {
                    $except_statement = $except_statement . " AND (contact_id = '" . $population_id . "' AND population_id != '" . $e->population_id . "' OR contact_id != '" . $e->population_id . "' AND population_id = '" . $population_id . "')";
                }

            }

            $this->is_initial = false;

            try {
                $query = "SELECT population_id, contact_id, date_contact FROM encounter_logs WHERE (population_id = '".$population_id."' OR contact_id = '".$population_id."') AND (date_contact BETWEEN '" . $range_from . "' AND '" . $range_to . "')";

                if(count($except) > 0) {
                    $query = $query . $except_statement;
                }

                $tmpresult = $db->query($query);
                //print_r($tmpresult);
                $result = array();

                foreach($tmpresult as $i => $user) {
                    
                    $date = strtotime($user->date_contact . ' - 15 days');
                    $mdate = date('Y-m-d H:i:s', $date);

                    $mdate2 = explode(' ',$user->date_contact);
                    $mdate2 = $mdate2[0] . ' 23:59:59';

                    $pop_id = ($user->population_id == $population_id)?$user->contact_id :$user->population_id ;
                    $has_no_match = true;

                    foreach($result as $z => $r_entry) {
                        if($r_entry->population_id == $pop_id) {
                            $has_no_match = false;
                        }
                    }

                    if($has_no_match === true) {
                        array_push(
                            $result,
                            (object) array(
                                'population_id' => $pop_id,
                                'date_in' => $mdate,
                                'date_out' => $mdate2
                            )
                        );
                    }

                }

                
            } 
            catch(Exception $e) {
                echo "UA";
            }

            return $result;
        }

        public function trace($payload) {

            $required_post_vals = array('population_id', 'date_positive');

            $close_contacts = array(
                'first_degree' => array(),
                'second_degree' => array(),
                'third_degree' => array()
            );

            $contact_areas = array(
                'root' => array(), 
                'first_degree' => array(), 
                'second_degree' => array()
            );

            $contact_transpo = array(
                'root' => array(), 
                'first_degree' => array(), 
                'second_degree' => array()
            );

            $contact_direct = array(
                'root' => array(), 
                'first_degree' => array(), 
                'second_degree' => array()
            );

            $keys_close_contacts = array_keys($close_contacts);
            $keys_contact_areas = array_keys($contact_areas);

            $date = strtotime($payload['date_positive'] . ' - 15 days');
            $mdate = date('Y-m-d H:i:s', $date);

            $contacts = array(
                (object) array(
                    'population_id' => $payload['population_id'],
                    'date_in' => $mdate,
                    'date_out' => $payload['date_positive'] . " 23:59:59"
                )
            );
            $accum_contacts = $contacts;

            if(!$this->is_params_complete($payload,$required_post_vals)) {
                echo "incomplete params";
                return;
            }

            // iterate through each degree
            foreach($keys_close_contacts as $h => $key) {

                // iterate through each contact of degree
                foreach($contacts as $i => $user) {

                    if(count($contacts) < 1) {
                        return;
                    } 

                    $visited_areas = $this->trace_visited_areas(
                        $user->population_id, 
                        $user->date_in, 
                        $user->date_out, 
                        'establishment_logs',
                        'establishment_id'
                    );

                    foreach($visited_areas as $n => $c) {

                        $is_listed = false;

                        foreach($contact_areas[$keys_contact_areas[$h]] as $o => $a) {

                            if($a->establishment_id == $c->establishment_id) {
                                $is_listed = true;
                                break;
                            }
                        }

                        if($is_listed === false)
                        {
                            array_push($contact_areas[$keys_contact_areas[$h]], $c);
                        }
                    }

                    $ridden_transportation = $this->trace_visited_areas(
                        $user->population_id, 
                        $user->date_in, 
                        $user->date_out, 
                        'transportation_logs',
                        'transportation_id'
                    );

                    foreach($ridden_transportation as $n => $c) {

                        $is_listed = false;

                        foreach($contact_transpo[$keys_contact_areas[$h]] as $o => $a) {

                            if($a->transportation_id == $c->transportation_id) {
                                $is_listed = true;
                                break;
                            }
                        }

                        if($is_listed === false)
                        {
                            array_push($contact_transpo[$keys_contact_areas[$h]], $c);
                        }
                    }

                    foreach($visited_areas as $j => $area) {

                        $tmp = $this->trace_users_in_area(
                            $area->establishment_id, 
                            $area->date_in, 
                            $area->date_out, 
                            'establishment_logs', 
                            'establishment_id',
                            $accum_contacts 
                        );

                        foreach($tmp as $n => $c) {
                            array_push($close_contacts[$key], $c);
                            array_push($accum_contacts, $c);
                        }

                    }

                    foreach($ridden_transportation as $j => $area) {

                        $tmp = $this->trace_users_in_area(
                            $area->transportation_id, 
                            $area->date_in, 
                            $area->date_out, 
                            'transportation_logs', 
                            'transportation_id',
                            $accum_contacts 
                        );

                        foreach($tmp as $n => $c) {
                            array_push($close_contacts[$key], $c);
                            array_push($accum_contacts, $c);
                        }

                    }

                    $encounters = $this->trace_scanned_people(
                        $user->population_id,
                        $user->date_in,
                        $user->date_out,
                        $accum_contacts
                    );

                    foreach($encounters as $n => $c) {
                        array_push($close_contacts[$key], $c);
                        array_push($accum_contacts, $c);
                    }

                }

                $contacts = $close_contacts[$key]; 

                //echo "PASS for " . $key . " done with data " . json_encode($close_contacts[$key]);
            }

            // echo "CLOSE CONTACTS: <pre>";
            // print_r($close_contacts);
            // echo "</pre>";

            // echo "AREAS: <pre>";
            // print_r($contact_areas);
            // echo "</pre>";

            // echo "TRANSPO: <pre>";
            // print_r($contact_transpo);
            // echo "</pre>";
 
            return array(
                "close_contacts" => $close_contacts,
                "establishments" => $contact_areas,
                "transportation" => $contact_transpo,
            );

        }

        public function tree_trace($payload) {
            
            $required_post_vals = array('population_id', 'date_positive');

            if(!$this->is_params_complete($payload,$required_post_vals)) {
                echo "incomplete params";
                return;
            }

            $date = strtotime($payload['date_positive'] . ' - 15 days');
            $mdate = date('Y-m-d H:i:s', $date);

            $main = (object) array(
                'population_id' => $payload['population_id'],
                'date_in' => $mdate,
                'date_out' => $payload['date_positive'] . " 23:59:59",
            );

            $list_areas = array();
            $list_transpo = array();
            $list_encounter = array();

            array_push($list_encounter,$main);

            return $this->dig($main, $list_areas, $list_transpo, $list_encounter, 0, 4, 0);

        }

        private function dig($param_data, $list_areas, $list_transpo, $list_encounter, $index, $limit, $suplevel) {

            if($index === ($limit - 1)) {
                return null;
            }

            global $db;
            $list_nodes = array();
            $children_contacts = array();

            $visited_areas = $this->trace_visited_areas(
                $param_data->population_id, 
                $param_data->date_in, 
                $param_data->date_out, 
                'establishment_logs',
                'establishment_id'
            );

            $ridden_transportation = $this->trace_visited_areas(
                $param_data->population_id, 
                $param_data->date_in, 
                $param_data->date_out, 
                'transportation_logs',
                'transportation_id'
            );

            foreach($visited_areas as $i => $area) {

                $tmp = $this->trace_users_in_area(
                    $area->establishment_id, 
                    $area->date_in, 
                    $area->date_out, 
                    'establishment_logs', 
                    'establishment_id',
                    $list_encounter
                );

                foreach($tmp as $n => $c) {
                    array_push($children_contacts, $c);
                    array_push($list_encounter, $c);
                }
                
            }

            foreach($ridden_transportation as $i => $transpo) {

                $tmp = $this->trace_users_in_area(
                    $transpo->transportation_id, 
                    $transpo->date_in, 
                    $transpo->date_out, 
                    'transportation_logs', 
                    'transportation_id',
                    $list_encounter
                );

                foreach($tmp as $n => $c) {
                    array_push($children_contacts, $c);
                    array_push($list_encounter, $c);
                }
                
            }

            $encounters = $this->trace_scanned_people(
                $param_data->population_id,
                $param_data->date_in,
                $param_data->date_out,
                $list_encounter
            );

            foreach($encounters as $n => $c) {
                array_push($children_contacts, $c);
                array_push($list_encounter, $c);
            }

            array_push($list_areas, $visited_areas);
            array_push($list_transpo, $ridden_transportation);

            $visited_areas = null;
            $ridden_transportation = null;

            $origindex = $index;
            if($suplevel === $index) {
                $index++;
            }
            
            //echo $index;

            foreach($children_contacts as $r => $child) {
                
                $node = $this->dig($child, $list_areas, $list_transpo, $list_encounter, $index, $limit, $origindex);

                if($node !== null) {
                    array_push($list_nodes,$node);
                }

            }

            $details = $db->query('SELECT * FROM population WHERE population_id = "' . $param_data->population_id . '"');

            return array(
                'text' => array(
                    'name' => $details[0]->firstname . " " . $details[0]->middlename . ", " . $details[0]->lastname, 
                    'title' => $details[0]->primary_mobile_no . (empty($details[0]->secondary_mobile_no)?"":" or ") . $details[0]->secondary_mobile_no,
                    'desc' => $details[0]->barangay . " " . $details[0]->purok
                ),
                'children' => $list_nodes,
            );

        }

    }

    $TracingEngine = new TracingEngine();

