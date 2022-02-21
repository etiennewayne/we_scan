<?php 

include('header.php');
require('tracing-engine.php');

$res = $TracingEngine->trace($_GET);


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

?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div class="container bg-white pl-5 pt-4">
    <div class="page-heading d-flex align-items-center justify-content-between">
        <div class="page-heading-title text-secondary d-flex align-items-center">
            <i class="fa fa-code-branch fa-3x text-secondary"></i>
            <div class="page-heading-title-content ms-3">
                <span class="h4">CONTACT TRACING FOR CASE # <?php echo $_GET['positive_id']; ?></span>
                <div>Summary of Automated Contact Tracing..</div>
            </div>
        </div>
        <form action="print_tracing.php" method="POST">
            <input type="hidden" name="res" value='<?php echo json_encode($res); ?>'/>
            <input type="hidden" name="positive_pop_id" value='<?php echo json_encode($_GET['population_id']); ?>'/>
            <input type="hidden" name="positive_date" value='<?php echo json_encode($_GET['date_positive']); ?>'/>
            <button type="submit" class="btn btn-primary float-right mr-2">
                <i class="fa fa-print"></i>
                PRINT
            </button>
        </form>
        
        <!-- <form action="print_tracing.php" method="POST">
            <input type="hidden" name="res" value='<?php echo json_encode($res); ?>'/>
            <input type="hidden" name="positive_pop_id" value='<?php echo json_encode($_GET['population_id']); ?>'/>

        </form> -->
        <!-- <div class="btn-group" role="group" aria-label="Basic example">

            <button type="button" class="btn btn-primary float-right">
                <i class="fa fa-code-branch"></i>
                PRINT TREE
            </button>
        </div> -->

    </div>
    <div class="row mt-3">
        <div class="col-md-12">


            <div class="accordion accordion-flush">
                <?php foreach($res['close_contacts'] as $degree => $contacts): ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed  bg-dark text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-<?php echo $degree; ?>" aria-expanded="<?php echo ($degree == 'first_degree'?'true':'false'); ?>" aria-controls="flush-<?php echo $degree; ?>">
                                <i class="fa fa-bars"></i>&nbsp;&nbsp;
                                <b><?php echo $degree_titles[$degree]; ?> Tracing Results </b>&nbsp;&nbsp;
                                <span class="badge bg-danger"><?php echo count($contacts); ?></span>
                            </button>
                        </h2>
                        <div id="flush-<?php echo $degree; ?>" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#flush-headingOne">
                            <div class="accordion-body pl-0 pr-0 pb-0">
                                <div class="container">
                                    <div class="row">
                                        <?php if(count($contacts) < 1): ?>
                                            <div class="col-12 text-center">
                                                <strong><i>- No Records -</i></strong>
                                            </div>
                                        <?php else: ?>
                                            <div class="col-12 mb-2">
                                            
                                                <h1 class="display-6">Contacts</h1>
                                                <hr>
                                            </div>
                                            <?php //print_r($contacts); ?>
                                            <?php foreach($contacts as $i => $population): ?>
                                                <?php $record = $db->result('population',"population_id=" . $db->addqoute($population->population_id))[0]; ?>
                                                <div class="col-6">
                                                    <div class="card text-dark bg-light rounded shadow-sm mb-4" style="border: 1px solid; ">
                                                        <div class="card-body">

                                                        <button class="btn btn-sm btn-warning float-right btn-send-sms" data-degree="<?php echo $degree; ?>" data-contacts='<?php echo json_encode($record); ?>'>
                                                            Send SMS Notification
                                                            <i class="fa fa-paper-plane"></i>
                                                        </button>

                                                            <h5 class="card-title"><?php echo $record->lastname . ", " . $record->firstname . " " . $record->middlename;?></h5>
                                                            <h6 class="card-subtitle mb-2 text-muted"><?php echo $population->population_id; ?></h6>
                                                            <p class="card-text">
                                                                Primary Mobile No: <b><?php echo $record->primary_mobile_no; ?></b><br/>
                                                                Secondary Mobile No: <b><?php echo $record->secondary_mobile_no; ?></b><br/>
                                                                Address: <b><?php echo $record->barangay .", " . $record->purok; ?></b><br/>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                            <div class="col-12 mb-2 mt-5">
                                                <h1 class="display-6">Establishments Visited</h1>
                                            </div>
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Establishment ID</th>
                                                            <th>Name</th>
                                                            <th>Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($res['establishments'][$degree_trans_estab[$degree]]) < 1): ?>
                                                            <tr>
                                                                <td class="text-center" colspan=3><i>- no records -</i></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php foreach($res['establishments'][$degree_trans_estab[$degree]] as $link => $establishment): ?>
                                                            <?php $record = $db->result('establishments',"establishment_id=" . $db->addqoute($establishment->establishment_id))[0]; ?>
                                                            <tr>
                                                                <td><?php echo $record->establishment_id; ?></td>
                                                                <td><?php echo $record->name; ?></td>
                                                                <td><?php echo $record->address; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 mb-2 mt-5">
                                                <h1 class="display-6">Transportation Ridden</h1>
                                            </div>
                                            <div class="col-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Transportation ID</th>
                                                            <th>Vehicle</th>
                                                            <th>Plate No</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(count($res['transportation'][$degree_trans_estab[$degree]]) < 1): ?>
                                                            <tr>
                                                                <td class="text-center" colspan=3><i>- no records -</i></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php foreach($res['transportation'][$degree_trans_estab[$degree]] as $link => $transportation): ?>
                                                            <?php $record = $db->result('transportation',"transportation_id=" . $db->addqoute($transportation->transportation_id))[0]; ?>
                                                            <tr>
                                                                <td><?php echo $record->transportation_id; ?></td>
                                                                <td><?php echo $record->vehicle; ?></td>
                                                                <td><?php echo $record->plate_no; ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
                                        <!-- <hr>
        <div class="col-md-12">
            <pre>
                <?php echo print_r($res); ?>
            </pre>
        </div> -->
    </div>
</div>

<script>

    $(function(){

        var messages = {
            first_degree: 'Close contact generation (Level1) - This is to alert that you had been in contact with a confirmed COVID-19 positive person. You need an antigen test whether you are asymptomatic or symptomatic. This is a quick reminder from Contact Monitoring Office(CMO) to stay at home to avoid infecting others and to get tested as required.',
            second_degree: 'Close contact generation(Level2) - This is to alert that you had been in contact with the first degree of closed contact, and that if you have symptoms of COVID-19, an antigen test is required. This is a quick reminder from Contact Monitoring Office(CMO) to stay at home to avoid infecting others and to get tested.',
            third_degree: 'Close contact generation (Level3) -  This is to alert that you had been in contact with the second degree of closed contact, and if you have symptoms of COVID-19, an antibody test is required. This is a quick reminder from Contact Monitoring Office (CMO) to stay at home to avoid infecting others and to get tested.'
        };

        $('.btn-send-sms').on('click', function() {
            let contact = JSON.parse($(this).attr('data-contacts'))
            let degree = $(this).attr('data-degree')
            console.log(contact);
            //alert("Send Sms to " + JSON.stringify(contacts))

            const sendSMS = fetchData(
                'http://122.55.183.249/rbiis/listahan/sendSMS',
                {
                    contact_no: contact.primary_mobile_no, 
                    message: messages[degree]
                }
            );

            if (sendSMS.status === 'Sent') {
                alert("Message Sent!");
            }
        })

    })

</script>

<?php include ('footer.php'); ?>