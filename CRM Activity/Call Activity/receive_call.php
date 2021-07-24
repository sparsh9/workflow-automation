<?php

include 'db_connection.php';
$call_from = '';
$call_to = '';
$date = date('Y-m-d') ;
$duration = '00:01:52';
$error = '';
$success = '';

if(isset($_POST['call'])){
    $call_from = $_POST['call_from'];
    $call_to = $_POST['call_to'];

    if(!$call_from || !$call_to){
        $error = 'Required <br />';
    }
    if(!$error){
        $sql = "insert into received_call (call_from, call_to, date, duration) values (?, ?, ?, ?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $call_from, $call_to, $date, $duration);
        if($stmt->execute()){
            $success = 'Call received successfully';
            $call_from = '';
            $call_to = '';
            $date = date('Y-m-d');
            $duration = '00:01:52';
        }else{
            $error .= 'Error while receiving call. Try again. <br />';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Call Trigger</title>
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
    <h4>Receive a Call</h4>
    <?php if($error) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <?php if($success) { ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>
    <form name="form1" method = "post">
        <p>
            Call from:<br>
            <input type="number" placeholder='Call From' name="call_from" value="<?php echo $call_from; ?>" required >
        </p>
        <p>
            Call To:<br>
            <input type="number" placeholder='Call To' name="call_to" value="<?php echo $call_to; ?>" required >
        </p>
        <p>
            <input type="submit" value="Receive Call" name='call'>
        </p>
    </form>
    <br/>
    <h3><a href="../crm_activity.php">Return to Create CRM Activity</a></h3>
</div>
</body>
</html>

