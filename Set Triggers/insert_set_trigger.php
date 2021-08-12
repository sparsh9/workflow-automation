<?php

include 'db_connection.php';

$trigger ='';
$action = [];
$sms_sent_from = '';
$sms_sent_to = '';
$sms_sent_date ='';

$sms_received_from = '';
$sms_received_to = '';
$sms_received_date ='';

$call_made_from = '';
$call_made_to = '';
$call_made_date =  '';
$call_made_duration = '';

$call_received_from = '';
$call_received_to = '';
$call_received_date =  '';
$call_received_duration = '';

$appointment_scheduled_email= '';
$appointment_scheduled_date= '';


$trigger = $_POST['trigger'] ;
$action = $_POST['action'];

$sms_sent_from = $_POST['sms_sent_from'];
$sms_sent_to = $_POST['sms_sent_to'];
$sms_sent_date = $_POST['sms_sent_date'];

$sms_received_from = $_POST['sms_received_from'];
$sms_received_to = $_POST['sms_received_to'];
$sms_received_date = $_POST['sms_received_date'];

$call_made_from = $_POST['call_made_from'];
$call_made_to = $_POST['call_made_to'];
$call_made_date =  $_POST['call_made_date'];
$call_made_duration = $_POST['call_made_duration'];

$call_received_from = $_POST['call_received_from'];
$call_received_to = $_POST['call_received_to'];
$call_received_date =  $_POST['call_received_date'];
$call_received_duration = $_POST['call_received_duration'];

$appointment_scheduled_email= $_POST['appointment_scheduled_email'];
$appointment_scheduled_date= $_POST['appointment_scheduled_date'];

if(isset($_POST['trigger'])){
    if($trigger == 'sms_trigger') {
        if ($action[0] == 'sms_sent' && !$action[1]) {
//            echo($action[0]);
//            echo($action[1]);
            $sql = "INSERT INTO `sms_trigger`(`sms_trigger`, `sms_action`, `sms_from`, `sms_to`, `sms_date`) 
VALUES ('$trigger', '$action[0]', '$sms_sent_from', '$sms_sent_to', '$sms_sent_date') ";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);
        }

        else if ($action[0] == 'sms_received' && !$action[1]) {

            $sql = "INSERT INTO `sms_trigger`(`sms_trigger`, `sms_action`, `sms_from`, `sms_to`, `sms_date`) 
VALUES ('$trigger', '$action[0]', '$sms_received_from', '$sms_received_to', '$sms_received_date') ";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);
        }

        else if ($action[0] == 'sms_sent' && $action[1] == 'sms_received' || $action[1] == 'sms_sent' && $action[0] == 'sms_received' ) {

            $sql = "INSERT INTO sms_trigger(sms_trigger, sms_action, sms_from, sms_to, sms_date) 
VALUES ('$trigger', 'sms_received', '$sms_received_from', '$sms_received_to', '$sms_received_date'),
       ('$trigger', 'sms_sent', '$sms_sent_from', '$sms_sent_to', '$sms_sent_date') ";


            if ($conn->multi_query($sql) === TRUE) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);


        }

    }

    if($trigger == 'call_trigger') {
        if ($action[0] == 'call_made' && !$action[1] ) {

            $sql = "INSERT INTO `call_trigger`(`call_trigger`, `call_action`, `call_from`, `call_to`, `call_date`, `call_duration`) 
VALUES ('$trigger', '$action[0]', '$call_made_from', '$call_made_to', '$call_made_date', '$call_made_duration') ";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);
        }

        else if ($action[0] == 'call_received' && !$action[1]) {

            $sql = "INSERT INTO `call_trigger`(`call_trigger`, `call_action`, `call_from`, `call_to`, `call_date`, `call_duration`) 
VALUES ('$trigger', '$action[0]', '$call_received_from', '$call_received_to', '$call_received_date', '$call_received_duration') ";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);
        }

        else if ($action[0] == 'call_made' && $action[1] == 'call_received' || $action[1] == 'call_made' && $action[0] == 'call_received' ) {

            $sql = "INSERT INTO `call_trigger`(`call_trigger`, `call_action`, `call_from`, `call_to`, `call_date`, `call_duration`) 
VALUES ('$trigger', '$action[0]', '$call_made_from', '$call_made_to', '$call_made_date', '$call_made_duration') ";


            $sql .= "INSERT INTO `call_trigger`(`call_trigger`, `call_action`, `call_from`, `call_to`, `call_date`, `call_duration`) 
VALUES ('$trigger', '$action[0]', '$call_received_from', '$call_received_to', '$call_received_date', '$call_received_duration') ";

            if ($conn->mysqli_multi_query($sql) === TRUE) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);


        }

    }

    if($trigger == 'appointment_trigger') {
        if ($action[0] == 'appointment_scheduled') {

            $sql = "INSERT INTO `appointment_trigger`(`appointment_trigger`, `appointment_action`, `appointment_scheduled_email`, `appointment_scheduled_date`) 
VALUES ('$trigger', '$action[0]', '$appointment_scheduled_email', '$appointment_scheduled_date') ";

            if (mysqli_query($conn, $sql)) {
                echo json_encode(array("statusCode"=>200));
            }
            else {
                echo json_encode(array("statusCode"=>201));
                echo(mysqli_error());
            }
            mysqli_close($conn);
        }
    }




}

?>

