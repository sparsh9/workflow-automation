
<!DOCTYPE html>
<html>

<head>
    <title>
        Set Trigger
    </title>
    <script src=
            "https://code.jquery.com/jquery-1.12.4.min.js">
    </script>

    <style type="text/css">
        .container {
            margin: 0 auto;
            padding: 10px;

        }
        .action {
            padding: 30px;
            display: none;
            margin-top: 30px;
            width: 60%;
        }

        .condition {
            padding: 30px;
            display: none;
            margin-top: 30px;
            width: 60%;
        }

        label {
            margin-right: 20px;
        }
    </style>
</head>

<body>
<div class="container" >
    <h2>
        Choose Trigger
    </h2>
    <!--    --><?php //if($error) { ?>
    <!--        <p class="error">--><?php //echo $error; ?><!--</p>-->
    <!--    --><?php //} ?>
    <!--    --><?php //if($success) { ?>
    <!--        <p class="success">--><?php //echo $success; ?><!--</p>-->
    <!--    --><?php //} ?>

    <div class="triggers">
        <label>
            <input type="radio" name="sms"
                   value="sms_trigger"> SMS</label>
        <label>
            <input type="radio" name="call"
                   value="call_trigger"> Call</label>
        <label>
            <input type="radio" name="appointment"
                   value="appointment_trigger"> Appointment</label>
    </div>

    <div class="actions" >
        <div class="sms_trigger action">
            <p>
                <input type="checkbox" class="get_value" id="sms_sent" name="sms_sent" value="sms_sent">
                <label for="sms_sent">Sms Sent </label><br>
            </p>
            <p>
                <input type="checkbox" class="get_value" id="sms_received" name="sms_received" value="sms_received">
                <label for="sms_received"> Sms Received </label><br>
            </p>
        </div>
        <div class="call_trigger action">
            <p>
                <input type="checkbox" class="get_value" id="call_made" name="call_made" value="call_made">
                <label for="call_made"> Call Made </label><br>
            </p>
            <p>
                <input type="checkbox" class="get_value" id="call_received" name="call_received" value="call_received">
                <label for="call_received"> Received </label><br>
            </p>
        </div>
        <div class="appointment_trigger action">
            <p>
                <input type="checkbox" class="get_value" id="appointment_scheduled" name="appointment_scheduled" value="appointment_scheduled">
                <label for="appointment_scheduled"> Appointment Scheduled </label><br>
            </p>
        </div>
    </div>

    <div class="conditions" >
        <div class="sms_sent condition">
            <h3> Sms Sent </h3>
            <p>
                Sms From:<br>
                <input type="number" class="sms_sent_condition" id="sms_sent_from" name="sms_from">
                <br>
            </p>
            <p>
                Sms To:<br>
                <input type="number" class="sms_sent_condition" id="sms_sent_to" name="sms_to">
                <br>
            </p>
            <p>
                Sms Date:<br>
                <input type="date" class="sms_sent_condition" id="sms_sent_date" name="sms_date">
                <br>
            </p>
        </div>
        <div class="sms_received condition">
            <h3> Sms Received </h3>
            <p>
                Sms From:<br>
                <input type="text" class="sms_received_condition" id="sms_received_from" name="sms_from" >
                <br>
            </p>
            <p>
                Sms To:<br>
                <input type="text" class="sms_received_condition" id="sms_received_to" name="sms_to" >
                <br>
            </p>
            <p>
                Sms Date:<br>
                <input type="date" class="sms_received_condition" id="sms_received_date" name="sms_date" >
                <br>
            </p>
        </div>

        <div class="call_made condition">
            <h3> Call Made </h3>
            <p>
                Call From:<br>
                <input type="number" class="call_made_condition" id="call_made_from" name="call_from">
                <br>
            </p>
            <p>
                Call To:<br>
                <input type="number" class="call_made_condition"  id="call_made_to" name="call_to">
                <br>
            </p>
            <p>
                Call Date:<br>
                <input type="date" class="call_made_condition" id="call_made_date" name="call_date">
                <br>
            </p>
            <p>
                Call Duration:<br>
                <input type="text" class="call_made_condition" id="call_made_duration" name="call_duration">
                <br>
            </p>

        </div>
        <div class="call_received condition">
            <h3> Call Received </h3>
            <p>
                Call From:<br>
                <input type="number" class="call_received_condition" id="call_received_from" name="call_from">
                <br>
            </p>
            <p>
                Call To:<br>
                <input type="number" class="call_received_condition"  id="call_received_to"  name="call_to">
                <br>
            </p>
            <p>
                Call Date:<br>
                <input type="date" class="call_received_condition"  id="call_received_date"  name="call_date">
                <br>
            </p>
            <p>
                Call Duration:<br>
                <input type="text" class="call_received_condition"  id="call_received_duration"  name="call_duration">
                <br>
            </p>

        </div>

        <div class="appointment_scheduled condition">
            <h3>Schedule  Appointment</h3>
            <p>
                Email Address:<br>
                <input type="email" class="appointment_scheduled_condition"  id="appointment_scheduled_email"  name="email_address">
                <br>
            </p>
            <p>
                Appointment Date:<br>
                <input type="date" class="appointment_scheduled_condition" id="appointment_scheduled_date" name="appointment_date">
                <br>
            </p>
        </div>
    </div>
    <div>
        <p>
            <button onclick="submit()" type="button">
                Set Trigger
            </button>
        </p>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            var targetBox = $("." + inputValue);
            $(".action").not(targetBox).hide();
            $(targetBox).show();
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            var inputValue = $(this).attr("value");
            $("." + inputValue).toggle();
        });
    });
</script>

<script type="text/javascript">
    function submit(){
        $.ajax({
            url:"insert_set_trigger.php",
            method:"POST",
            data:{
                trigger: trigger,
                action: action,

                sms_sent_from: sms_sent_from,
                sms_sent_to: sms_sent_to,
                sms_sent_date: sms_sent_date,

                 sms_received_from: sms_received_from,
                 sms_received_to: sms_received_to,
                 sms_received_date: sms_received_date,

                 call_made_from: call_made_from,
                 call_made_to: call_made_to,
                 call_made_date: call_made_date,
                 call_made_duration: call_made_duration,

                 call_received_from: call_received_from,
                 call_received_to: call_received_to,
                 call_received_date: call_received_date,
                 call_received_duration: call_received_duration,

                 appointment_scheduled_email: appointment_scheduled_email,
                 appointment_scheduled_date: appointment_scheduled_date
            },
            success:function(data){
                $('#result').html(data);
            }
        });
        // $.ajax({
        //     url: "insert_set_trigger.php",
        //     method: "POST",
        //     data: {},
        //     success: function(data) {
        //         $('#result').html(data);
        //     }
        // });
        //
        // $.ajax({
        //     url: "insert_set_trigger.php",
        //     method: "POST",
        //     data:{
        //
        //     },
        //     success:function(data){
        //         $('#result').html(data);
        //     }
        // });
    }

    var trigger;
    var action = [];

    var sms_sent_from;
    var sms_sent_to;
    var sms_sent_date;

    var sms_received_from;
    var sms_received_to;
    var sms_received_date;

    var call_made_from;
    var call_made_to;
    var call_made_date;
    var call_made_duration;

    var call_received_from;
    var call_received_to;
    var call_received_date;
    var call_received_duration;

    var appointment_scheduled_email;
    var appointment_scheduled_date;

    $('input[type="radio"]').click(function(){
        trigger = $(this).val();
    });

    $('input[type="checkbox"]').click(function() {
        action = [];
        $('.get_value').each(function () {
            if ($(this).is(":checked")) {
                console.log($(this).val());
                console.log(action);
                action.push($(this).val());
            }
        });
    });

    $('button[type="button"]').click(function(){
        sms_sent_from = $('#sms_sent_from').val();
        sms_sent_to = $('#sms_sent_to').val();
        sms_sent_date = $('#sms_sent_date').val();

        sms_received_from = $('#sms_received_from').val();
        sms_received_to = $('#sms_received_to').val();
        sms_received_date = $('#sms_received_date').val();

        call_made_from = $('#call_made_from').val();
        call_made_to = $('#call_made_to').val();
        call_made_date = $('#call_made_date').val();
        call_made_duration = $('#call_made_duration').val();

        call_received_from = $('#call_received_from').val();
        call_received_to = $('#call_received_to').val();
        call_received_date = $('#call_received_date').val();
        call_received_duration = $('#call_received_duration').val();

        appointment_scheduled_email = $('#appointment_scheduled_email').val();
        appointment_scheduled_date = $('#appointment_scheduled_date').val();
    });
    ;


</script>
</body>

</html>

