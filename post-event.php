<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        $addedBy = $_POST['added-by'];
        $addedFirstLast = explode(" ", $addedBy, 2);
        $addedlastname = htmlentities($addedFirstLast[1], ENT_QUOTES);
        $query = " 
            SELECT 
                * 
            FROM family_member
            WHERE 
                first_name = :addedfirstname AND
                last_name = :addedlastname AND
                family_id = :id
        "; 
         
        $query_params = array( 
            ':addedfirstname' => $addedFirstLast[0],
            ':addedlastname' => $addedlastname,
            ':id' => $_SESSION['family_id'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die($ex); 
        } 
         
        $rowz = $stmt->fetchAll();
        if ($rowz) {
            foreach ($rowz as $y) {
                $addedFirst = $y['first_name'];
                $addedLast = $y['last_name'];
            }
            
        }

        
        $eventmonth = date('F', strtotime($_POST['datepicker']));
        $eventday = date('d', strtotime($_POST['datepicker']));
        $eventyear = date('Y', strtotime($_POST['datepicker']));

        $eventmonthnumber = date('m', strtotime($_POST['datepicker']));

        $time = $_POST['event-time'];
        $timeBreak = explode(" ", $time);
        
        $timestamp = date('Y-m-d G:i:s', mktime(0, 0, 0, $eventmonthnumber, $eventday, $eventyear));
        $query = " 
            INSERT INTO custom_events ( 
                event_name,
                event_description,
                family_id,
                timestamp,
                message_id,
                event_date_month,
                event_date_day,
                event_date_year,
                event_time_start,
                am_pm,
                added_by_first,
                added_by_last,
                for_family_unit,
                event_location
                
            ) VALUES ( 
                :eventname,
                :eventdescription,
                :familyid,
                :timestamp,
                :messageid,
                :eventmonth,
                :eventday,
                :eventyear,
                :eventtime,
                :ampm,
                :addedbyfirst,
                :addedbylast,
                :familyunit,
                :eventlocation
                
            ) 
        "; 
         
        $query_params = array( 
            ':eventname' => $_POST['event-title'],
            ':eventdescription' => nl2br(htmlspecialchars($_POST['event-body'], ENT_QUOTES)),
            ':familyid' => $_SESSION['family_id'],
            ':timestamp' => $timestamp,
            ':messageid' => 0,
            ':eventmonth' => $eventmonth,
            ':eventday' => $eventday,
            ':eventyear' => $eventyear,
            ':eventtime' => $timeBreak[0],
            ':ampm' => $timeBreak[1],
            ':addedbyfirst' => $addedFirst,
            ':addedbylast' => $addedLast,
            ':familyunit' => $_POST['event-for'],
            ':eventlocation' => $_POST['event-location']
            
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die($ex);
        } 


    } 


    $recipientList = $_POST['event-for'];
    $subject = $_POST['event-title'];
    $body = $_POST['event-body'];

    $emailList = array();
    if(isset($_POST['submitted'])) 
    { 
        //PARSE RECIPIENT LIST AND GET EMAILS

        if (strpos($recipientList, 'Whole Family') !== false) {
            $query = " 
                SELECT 
                    * 
                FROM family_member
                WHERE 
                    family_id = :id
            "; 
             
            $query_params = array( 
                ':id' => $_SESSION['family_id'] 
            ); 
             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            { 
                die($ex); 
            } 
             
            $rows = $stmt->fetchAll();
            if ($rows) {
                foreach ($rows as $x) {
                    if ($x['is_subscribed'] == 1) {
                        array_push($emailList, $x['email']);
                    }
                }
                
            }
        }
        else {
            $parsedEmailList = explode(" ", $recipientList);
            
                

                if (strpos($recipientList, 'Family') !== false) {
                    $query = " 
                        SELECT 
                            * 
                        FROM family_member
                        WHERE 
                            family_unit_1 = :unitname OR
                            family_unit_2 = :unitname OR
                            family_unit_3 = :unitname AND
                            family_id = :id
                    "; 
                     
                    $query_params = array( 
                        ':unitname' => $recipientList,
                        ':id' => $_SESSION['family_id'] 
                    ); 
                     
                    try 
                    { 
                        $stmt = $db->prepare($query); 
                        $result = $stmt->execute($query_params); 
                    } 
                    catch(PDOException $ex) 
                    { 
                        die($ex); 
                    } 
                     
                    $rows = $stmt->fetchAll();
                    if ($rows) {
                        foreach ($rows as $x) {
                            $query = " 
                                SELECT 
                                    * 
                                FROM family_member
                                WHERE 
                                    first_name = :firstname AND
                                    last_name = :lastname AND
                                    family_id = :id
                            "; 
                             
                            $query_params = array( 
                                ':firstname' => $x['first_name'],
                                ':lastname' => $x['last_name'],
                                ':id' => $_SESSION['family_id'] 
                            ); 
                             
                            try 
                            { 
                                $stmt = $db->prepare($query); 
                                $result = $stmt->execute($query_params); 
                            } 
                            catch(PDOException $ex) 
                            { 
                                die($ex); 
                            } 
                             
                            $rows = $stmt->fetchAll();
                            if ($rows) {
                                foreach ($rows as $x) {
                                    if ($x['is_subscribed'] == 1) {
                                        array_push($emailList, $x['email']);
                                    }
                                }
                                
                            }
                        }
                        
                    }
                }
                else {
                    $firstLast = explode(" ", $recipientList);

                    $query = " 
                        SELECT 
                            * 
                        FROM family_member
                        WHERE 
                            first_name = :firstname AND
                            last_name = :lastname AND
                            family_id = :id
                    "; 
                     
                    $query_params = array( 
                        ':firstname' => $firstLast[0],
                        ':lastname' => $firstLast[1],
                        ':id' => $_SESSION['family_id'] 
                    ); 
                     
                    try 
                    { 
                        $stmt = $db->prepare($query); 
                        $result = $stmt->execute($query_params); 
                    } 
                    catch(PDOException $ex) 
                    { 
                        die($ex); 
                    } 
                     
                    $rows = $stmt->fetchAll();
                    if ($rows) {
                        foreach ($rows as $x) {
                            if ($x['is_subscribed'] == 1) {
                                array_push($emailList, $x['email']);
                            }
                        }
                        
                    }
                }
        }

        $sentFrom = $_POST['added-by'];
        $sentFirstLast = explode(" ", $sentFrom, 2);
        $sentlastname = htmlentities($sentFirstLast[1], ENT_QUOTES);
        $query = " 
            SELECT 
                * 
            FROM family_member
            WHERE 
                first_name = :sentfirstname AND
                last_name = :sentlastname AND
                family_id = :id
        "; 
         
        $query_params = array( 
            ':sentfirstname' => $sentFirstLast[0],
            ':sentlastname' => $sentlastname,
            ':id' => $_SESSION['family_id'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die($ex); 
        } 
         
        $rowz = $stmt->fetchAll();
        if ($rowz) {
            foreach ($rowz as $y) {
                $replyTo = $y['email'];
                $senderFirst = $y['first_name'];
                $senderLast = $y['last_name'];
            }
            
        }
        
        $emailTo = '';
        
        foreach($emailList as $key=>$email) {

            if ($email != null) {
                $add = '';
                $add = $email.',';
                $emailTo = $emailTo.$add;
            }
        }
        $emailTo = substr($emailTo, 0, -1);

    //POPULATE EMAIL COMPONENTS AND SEND EMAIL

            $email = 'familink@codingerik.com';
            //$replyTo = '';
            //$emailTo = '';
            $subject = $_POST['event-title'];
            $sendCopy = trim($_POST['sendCopy']);
            $preBody = nl2br(htmlspecialchars($_POST['event-body'], ENT_QUOTES));
            $body = '<html>'.$senderFirst.' '.$senderLast.' just created a new event for the '.$recipientList.' in Familink!<br><br><strong>'.$_POST['event-title'].'</strong><br><br></html>';
            $body .= nl2br(htmlspecialchars($_POST['event-body'], ENT_QUOTES));
            $body .='<html><br><br>-----<br>To view this event, comment on it, or RSVP, log in to your family\'s <a href="http://familink.codingerik.com">Familink</a> account and click \'Events\'.<br><br>-----<br>This email was sent using <a href="http://familink.codingerik.com">Familink</a><br><br><small>To unsubscribe from these emails, please click the link above, edit your details, and uncheck "Subscribe"</small></html>';
            $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            //$headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo;
            $headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo . "\r\n" . 'Cc: ' . $replyTo . "\r\n";


            //echo '<br><br>Email Sent';
            //echo '<br><a href="familink-secure.php">Return to Familink</a>';

    } 
     
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>familink</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="" />

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>


    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <!--Let browser know website is optimized for mobile-->
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/typed.js" type="text/javascript"></script>
    <script src="js/slidingLabels.js"></script>
    

</head>

<body>
    <div id="page-loader"></div>

    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>-->
    
    


<div class="col-md-12 text-center" style="margin-top: 10%; margin-bottom: 130px;">

<?php 

if (mail($emailTo, $subject, $body, $headers)) {

            $emailSent = true;
            echo '<h3>event created and email sent!</h3>'.
                    '<span style="font-size: 20px;">To: '.str_replace(",", "<br>", $emailTo).'</span><br><br>'.
                    '<form action="familink-secure.php">'.
                        '<input type="submit" class="btn btn-default btn-green" style="width:130px;height:40px;font-size:20px;" value="Awesome!">'.
                    '</form>';
            }
            else {
                $emailSent = false;
                echo '<h3 style="line-height: 50px;">whoops...there was a server error!</h3>'.
                    '<br><h4 style="font-family: sans-serif;">Your event was created, but the email did not send.</h4><br><br><br>'.
                    '<form action="familink-secure.php">'.
                        '<input type="submit" class="btn btn-default btn-green" style="width:130px;height:40px;font-size:20px;" value="Ok, Thanks">'.
                    '</form>';
            }
            


?>
</div>
    

    

    <div class="clear-fix"></div>

    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    
    

</body>

</html>