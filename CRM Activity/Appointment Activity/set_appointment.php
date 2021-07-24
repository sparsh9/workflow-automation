<?php

include 'db_connection.php';

$date = date('Y-m-d') ;
$email_address = '';
$error = '';
$success = '';

if(isset($_POST['set_appointment'])){
    $date = $_POST['date'];
    $email_address = $_POST['email_address'];

    if(!$date || !$email_address){
        $error = 'Required <br />';
    }
    if(!$error){
        $sql = "insert into set_appointment (date, email_address) values (?, ?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss',  $date, $email_address);
        if($stmt->execute()){
            $success = 'Appointment set successfully';
            $date =  date('Y-m-d');
            $email_address = '';
        }else{
            $error .= 'Error while setting appointment. Try again. <br />';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Trigger</title>
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
    <h4>Set appointment</h4>
    <?php if($error) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <?php if($success) { ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>
    <form name="form1" method = "post">
        <p>
            Date:<br>
            <input type="date" placeholder='Date' name="date" value="<?php echo $date; ?>" required >
        </p>
        <p>
            Email Address:<br>
            <input type="email" placeholder='Email Address' name="email_address" value="<?php echo $email_address; ?>" required >
        </p>

        <p>
            <input type="submit" value="Set Appointment" name='set_appointment'>
        </p>
    </form>
    <br/>
    <h3><a href="../crm_activity.php">Return to Create CRM Activity</a></h3>
</div>
</body>
</html>

