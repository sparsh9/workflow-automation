<?php
require('db_connection.php');
$error   = '';
$success = '';
$result_array = array();
$sql    = " select email_id, subject, body, date, action_performed from email_alert ";
$result = $conn->query($sql);
/*if there are results from database push to result array */
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($result_array, $row);
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

        table {
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<div class="container">
    <h4>Email Trigger</h4>
    <?php if($error) { ?>

        <p class="error"><?php echo $error; ?></p>

    <?php } ?>

    <?php if($success) { ?>

        <p class="success"><?php echo $success; ?></p>

    <?php } ?>

    <table width="90%" >
        <tr>
            <th>#</th>
            <th>Email Id</th>
            <th>Subject</th>
            <th>Body</th>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php for($i=0; $i<count($result_array); $i++){ ?>

            <tr>
                <td><?php echo $i+1 ?></td>
                <td><?php echo $result_array[$i]['email_id'] ?></td>
                <td><?php echo $result_array[$i]['subject'] ?></td>
                <td><?php echo $result_array[$i]['body'] ?></td>
                <td><?php echo $result_array[$i]['date'] ?></td>
                <td><?php echo $result_array[$i]['action_performed'] ?></td>
            </tr>

        <?php } ?>

    </table>
    <br/>
    <h3><a href="../index.php">Return to Create CRM Activity</a></h3>

</div>
</body>
</html>