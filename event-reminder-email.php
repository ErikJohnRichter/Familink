<?php 

    require("common.php"); 

    $query = " 
        SELECT 
            * 
        FROM users
        WHERE 
            is_admin = :isadmin
    "; 
     
    $query_params = array( 
        ':isadmin' => 0
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
    
    $row = $stmt->fetchAll();
    if ($row) {
        foreach ($row as $z) {

            $date = date("Y-m-d");
            //$datetime = date_create($date);

            $query = " 
                SELECT 
                    * 
                FROM custom_events
                WHERE 
                    family_id = :id AND
                    timestamp LIKE :today
            "; 
             
            $query_params = array( 
                ':id' => $z['family_id'],
                ':today' => $date.'%'
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

                    $emailList = array();
                        
                    if ($x['for_family_unit'] == "Whole Family") {
                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id
                        "; 
                         
                        $query_params = array( 
                            ':id' => $z['family_id'] 
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
                                if ($y['is_subscribed'] == 1) {
                                    array_push($emailList, $y['email']);
                                }
                            }
                        }
                    }
                    else {
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
                            ':unitname' => $x['for_family_unit'],
                            ':id' => $z['family_id'] 
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
                            foreach ($rows as $w) {
                                $lastname = htmlentities($x['last_name'], ENT_QUOTES);
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
                                    ':firstname' => $w['first_name'],
                                    ':lastname' => $w['last_name'],
                                    ':id' => $z['family_id'] 
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
                                    foreach ($rows as $v) {
                                        if ($v['is_subscribed'] == 1) {
                                            array_push($emailList, $v['email']);
                                        }
                                    }
                                }
                            }
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
                        ':firstname' => $x['added_by_first'],
                        ':lastname' => $x['added_by_last'],
                        ':id' => $z['family_id'] 
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

                    $sender = $stmt->fetchAll();
                    if ($rows) {
                        foreach ($sender as $u) {
                            $replyTo = $u['email'];
                        }
                    }

                    //$emailTo = 'erik.j.richter@gmail.com';

                    //POPULATE EMAIL COMPONENTS AND SEND EMAIL

                    $email = 'familink@codingerik.com';
                    //$replyTo = 'familink@codingerik.com';
                    $subject = $x['event_name'].' Reminder';
                    $sendCopy = trim($_POST['sendCopy']);
                    $body = '<html>This is a reminder from Familink that you have an event today!<br><br>';
                    $body .= 'What - '.$x['event_name'].'<br>';
                    $body .= 'Where - '.$x['event_location'].'<br>';
                    $body .= 'When - '.$x['event_time_start'].''.$x['am_pm'].'<br>';
                    $body .= 'Organizer - '.$x['added_by_first'].' '.$x['added_by_last'].'<br><br>';
                    $body .= 'To RSVP, or for more details, visit your family\'s <a href="http://familink.codingerik.com">Familink</a> page. All replies to this email will go to the event organizer.<br><br>';
                    $body .= 'Hope to see you there!<br>';
                    $body .='<br><br>-----<br>This is an automated email sent by <a href="http://familink.codingerik.com">Familink</a>. <br><br><small>To unsubscribe from these emails, please click the link above, edit your details, and uncheck "Subscribe"</small></html>';
                    $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo;

                    mail($emailTo, $subject, $body, $headers);

                    /*echo 'Email to: '.$emailTo;
                    echo '<br><br>';
                    echo 'Subject: '.$subject;
                    echo '<br><br>';
                    echo 'Body: '.$body;
                    echo '<br><br>';
                    echo 'Reply to: '.$replyTo;
                    echo '<br>----------------------<br><br>';*/
                }
            }
        }
    }
     
?> 