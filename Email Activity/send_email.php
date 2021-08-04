<?php

include 'db_connection.php';
$email_id = '';
$subject = '';
$body = '';
$date = date('Y-m-d') ;
$error = '';
$success = '';

if(isset($_POST['email'])){
    $email_id = $_POST['email_id'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    if(!$email_id || !$subject){
        $error = 'Required <br />';
    }
    if(!$error){
        $sql = "insert into send_email (email_id, subject, body, date) values (?, ?, ?, ?) ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssss', $email_id, $subject, $body, $date );
        if($stmt->execute()){
            $success = 'Email sent successfully';
            $email_id = '';
            $subject = '';
            $body = '';
            $date = date('Y-m-d');

        }else{
            $error .= 'Error while making call. Try again. <br />';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Trigger</title>
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
    <h4>Send an Email</h4>
    <?php if($error) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <?php if($success) { ?>
        <p class="success"><?php echo $success; ?></p>
    <?php } ?>
    <form name="form1" method = "post">
        <p>
            Email Id:<br>
            <input type="email" placeholder='Email Id' name="email_id" value="<?php echo $email_id; ?>" required >
        </p>
        <p>
            Subject:<br>
            <input type="text" placeholder='Subject' name="subject" value="<?php echo $subject; ?>" required >
        </p>
        <p>
            Body:<br>
            <input type="Triggertext" placeholder='Body' name="body" value="<?php echo $body; ?>" required >
        </p>
        <p>
            <input type="submit" value="Send Email" name='email'>
        </p>
    </form>
    <br/>
    <h3><a href="./email_activity.php">Return to Email Activity</a></h3>
</div>
</body>
</html>

