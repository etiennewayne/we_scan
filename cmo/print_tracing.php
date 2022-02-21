<?php
    include('header.php');
    include('tracing-engine.php');
  
    $positive = $db->query("SELECT * FROM population WHERE population_id = " . $_POST['positive_pop_id']);
    $data = json_decode($_POST['res']);

    $degree_titles = array(
        'first_degree' => "First Degree",
        'second_degree' => "Second Degree",
        'third_degree' => "Third Degree"
    );
    
    $degree_trans_estab = array(
        'first_degree' => "root",
        'second_degree' => "first_degree",
        'third_degree' => "second_degree"
    );

    $e = $TracingEngine->tree_trace(
        array(
            'population_id' => trim($_POST['positive_pop_id'],'"'), 
            'date_positive' => trim($_POST['positive_date'],'"')
        )
    );

    $nodes = json_encode($e);

?>


<link rel="stylesheet" href="../includes/treant-js-master/Treant.css"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"> </script> 
<script src="../includes/treant-js-master/Treant.js"></script>

<style>
    #OrganiseChart1 {
        overflow: visible;
        margin-left: -50px;
    }

    .nodeExample1 {
        height: auto;
        width:200px;
        border: solid black 1px;
        border-radius: 10px;
        padding: 10px;
        font-color: black;
        vertical-align: middle;
        font-size: 12px;
    }
    .nodeExample1>p {
        margin-bottom: 0px;
        margin-top:0px;
    }

    .node-name {
        font-weight: bold;
    }
</style>

<div class="container">
    <h4 class="text-center mb-5">Contact Tracing Result for <?php echo $positive[0]->firstname . " " . $positive[0]->middlename . ", " . $positive[0]->lastname . " (" . $_POST['positive_pop_id'] . ")"; ?></h4>

    <?php foreach($data->close_contacts as $degree => $contacts): ?>

        <p class="lead">
            <b>
            <?php echo $degree_titles[$degree] . " Contacts:"; ?>
            </b>
        </p>

        <strong>Persons</strong>
        <table class="table mt-3">
            <thead>
                <tr>
                    <td>Fullname</td>
                    <td>Mobile No 1</td>
                    <td>Mobile No 2</td>
                    <td>Address</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($contacts as $e => $contact): ?>
                    <?php $res = $db->query("SELECT * FROM population WHERE population_id = '". $contact->population_id ."'"); ?>
                    <tr>
                        <td><?php echo $res[0]->firstname . ' ' . $res[0]->middlename . ', ' . $res[0]->lastname; ?></td>
                        <td><?php echo $res[0]->primary_mobile_no; ?></td>
                        <td><?php echo $res[0]->secondary_mobile_no; ?></td>
                        <td><?php echo $res[0]->barangay . " " . $res[0]->purok; ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if(count($contacts) < 1): ?>
                    <tr>
                        <td colspan='4'>
                            N/A
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <strong>Establishments</strong>
        <table class="table mt-3">
            <thead>
                <tr>
                    <td>Establishment</td>
                    <td>Address</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->establishments->{$degree_trans_estab[$degree]} as $p => $estab): ?>
                    <?php $res = $db->query("SELECT * FROM establishments WHERE establishment_id = '". $estab->establishment_id ."'"); ?>
                    <tr>
                        <td><?php echo $res[0]->name; ?></td>
                        <td><?php echo $res[0]->address; ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if(count($data->establishments->{$degree_trans_estab[$degree]}) < 1): ?>
                    <tr>
                        <td colspan='4'>
                            N/A
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <strong>Transportations</strong>
        <table class="table mt-3 mb-5">
            <thead>
                <tr>
                    <td>Vehicle</td>
                    <td>Plate No</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data->transportation->{$degree_trans_estab[$degree]} as $p => $trans): ?>
                    <?php $res = $db->query("SELECT * FROM transportation WHERE transportation_id = '". $trans->transportation_id ."'"); ?>
                    <tr>
                        <td><?php echo $res[0]->vehicle; ?></td>
                        <td><?php echo $res[0]->plate_no; ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if(count($data->transportation->{$degree_trans_estab[$degree]} ) < 1): ?>
                    <tr>
                        <td colspan='4'>
                            N/A
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    <?php endforeach; ?>

    <h4 class="text-center">Contact Tracing Tree View</h4>
    <p class="text-center mb-3"><strong>(Showing 4 Levels: Positive, First Degree, Second Degree, and Third Degree)</strong></p>
    <div id="OrganiseChart1" style="height: auto; width:100%;"></div>

</div>

<script>

    $(document).ready(() => {

        var config2 = {
            chart: {
                container: "#OrganiseChart1",
                rootOrientation:  'WEST', // NORTH || EAST || WEST || SOUTH
                // levelSeparation: 30,
                siblingSeparation:   5,
                subTeeSeparation:    6,
                scrollbar: "fancy",
                
                connectors: {
                    type: 'step'
                },
                node: {
                    HTMLclass: 'nodeExample1'
                },
            },
            nodeStructure: <?php echo $nodes; ?>
        };

        var tr = new Treant(config2, () => {
            window.print();
            window.onafterprint = (evt) => {
                window.history.back();
            }
        })
        

    });

</script>