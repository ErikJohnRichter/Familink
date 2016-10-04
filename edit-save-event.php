<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $year = date("Y");
        $time = $_POST['event-time'];
        $timeBreak = explode(" ", $time);
        $month = $_POST['event-month'];
        $monthBreak = explode(" ", $month);
        
        $timestamp = date('Y-m-d G:i:s', mktime(0, 0, 0, $monthBreak[1], $_POST['event-day'], $year));
        $query = " 
            UPDATE custom_events

            SET 
                event_name=:eventname,
                event_description=:eventdescription,
                timestamp=:timestamp,
                event_date_month=:eventmonth,
                event_date_day=:eventday,
                event_time_start=:eventtime,
                am_pm=:ampm,
                event_location=:location
                
            
            WHERE

            id=:eventid AND
            family_id=:familyid 
        "; 
         
        $query_params = array( 
            ':eventname' => $_POST['event-title'],
            ':eventdescription' => nl2br(htmlspecialchars($_POST['event-description'], ENT_QUOTES)),
            ':timestamp' => $timestamp,
            ':eventmonth' => $monthBreak[0],
            ':eventday' => $_POST['event-day'],
            ':eventtime' => $timeBreak[0],
            ':ampm' => $timeBreak[1],
            ':location' => $_POST['event-location'],
            ':eventid' => $_POST['event-id'],
            ':familyid' => $_SESSION['family_id']

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

         
        header("Location: familink-secure.php"); 
         
        die("Redirecting to familink-secure.php");

    } 
     
?> 