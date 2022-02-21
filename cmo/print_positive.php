<?php
    include('header.php');
    include('tracing-engine.php');

    $list_active_cases = $db->result('vw_positive_incidences',"status IS NULL AND date_tested_positive BETWEEN '" . $_POST['from'] . "' AND '" . $_POST['to'] . "'");

    //print_r($list_active_cases);

    $trees = array();

    foreach($list_active_cases as $i => $case) {

        $e = $TracingEngine->tree_trace(
            array(
                'population_id' => $case->population_id, 
                'date_positive' => $case->date_tested_positive
            )
        );

        array_push($trees,$e);

    }


    $jstrees = json_encode($trees);

?>


<link rel="stylesheet" href="../includes/treant-js-master/Treant.css"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"> </script> 
<script src="../includes/treant-js-master/Treant.js"></script>

<style>

    .chart {
        overflow: visible;
    }

    .nodeExample1 {
        height: auto;
        width:300px;
        border: solid black 1px;
        border-radius: 10px;
        padding: 10px;
        font-color: black;
        vertical-align: middle;
    }
    .nodeExample1>p {
        margin-bottom: 0px;
        margin-top:0px;
    }
    .node-name {
        font-weight: bold;
    }
</style>

<div class="container-fluid">

    <h4 class="text-center">Consolidated Contact Tracing Tree View</h4>
    <p class="text-center mb-3"><strong>Showing from <?php echo $_POST['from']; ?> to <?php echo $_POST['to']; ?><strong></p>

    <?php foreach($trees as $t => $tree): ?>

        <div class="chart" id="OrganiseChart<?php echo $t; ?>" style="height: auto; width:100vw;margin-left: -120px !important;"></div>
        <hr>
    <?php endforeach; ?>

</div>

<script>

    const jstrees = <?php echo $jstrees; ?>;
    var treesok = 0;

    $(document).ready(() => {

        for(i=0; i<jstrees.length; i++) {

            var config2 = {
                chart: {
                    container: "#OrganiseChart" + i,
                    rootOrientation:  'WEST', // NORTH || EAST || WEST || SOUTH
                    // levelSeparation: 30,
                    siblingSeparation:   5,
                    subTeeSeparation:    6,
                    //scrollbar: "fancy",                
                    connectors: {
                        type: 'step'
                    },
                    node: {
                        HTMLclass: 'nodeExample1'
                    },
                },
                nodeStructure: jstrees[i]
            };

            new Treant(config2,() => {
                treesok++;
            })

        }

        let inter = setInterval(() => {
            
            if(treesok === jstrees.length) {
                window.print();
                window.onafterprint = (evt) => {
                    window.history.back();
                }
                clearInterval(inter)
            }

        }, 1000);

        
        

    });

</script>