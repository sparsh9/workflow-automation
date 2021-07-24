<?php

include 'db_connection.php';
$sent_from = '';
$sent_to = '';
$date = date('Y-m-d') ;
$error = '';
$success = '';

if(isset($_POST['sms'])){
    $sent_from = $_POST['sent_from'];
    $sent_to = $_POST['sent_to'];

    if(!$sent_from || !$sent_to){
        $error = 'Required <br />';
    }
    if(!$error){
        $sql = "insert into received_sms (sent_from, sent_to, date) values (?, ?, ?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $sent_from, $sent_to, $date);
        if($stmt->execute()){
            $success = 'Sms received successfully';
            $sent_from = '';
            $sent_to = '';
            $date = date('Y-m-d');
        }else{
            $error .= 'Error while receiving sms. Try again. <br />';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trigger</title>
    <style>
        .container {
            margin: 0 auto;
            padding: 10px;
        }
        .error {
            width: 100%;
            color: red;
        }
        .success {
            width: 100%;
            color: green;
        }
    </style>
</head>
<body>
<div class="container">
    <h4>Receive a SMS</h4>
    <?php if($error) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <?php if($success) { ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>
    <form name="form1" method = "post">
        <p>
            Send from:<br>
            <input type="number" placeholder='Send From' name="sent_from" value="<?php echo $sent_from; ?>" required >
        </p>
        <p>
            Send To:<br>
            <input type="number" placeholder='Send To' name="sent_to" value="<?php echo $sent_to; ?>" required >
        </p>
        <p>
            <input type="submit" value="Receive Sms" name='sms'>
        </p>
    </form>
    <br/>
    <h3><a href="../crm_activity.php">Return to Create CRM Activity</a></h3>
</div>
</body>
</html>

