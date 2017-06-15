<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        $repliedBy = $_POST['replied-by'];
        $repliedFirstLast = explode(" ", $repliedBy, 2);
        $repliedlastname = htmlentities($repliedFirstLast[1], ENT_QUOTES);
        $query = " 
            SELECT 
                * 
            FROM family_member
            WHERE 
                first_name = :repliedfirstname AND
                last_name = :repliedlastname AND
                family_id = :id
        "; 
         
        $query_params = array( 
            ':repliedfirstname' => $repliedFirstLast[0],
            ':repliedlastname' => $repliedlastname,
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
                $repliedFirst = $y['first_name'];
                $repliedLast = $y['last_name'];
            }
            
        }

        $query = " 
            INSERT INTO event_replies ( 
                event_id,
                reply,
                family_id,
                replied_by_first,
                replied_by_last
                
            ) VALUES ( 
                :event_id,
                :reply,
                :familyid,
                :repliedbyfirst,
                :repliedbylast
                
            ) 
        "; 
         
        $query_params = array( 
            ':event_id' => $_POST['event-id'],
            ':reply' => nl2br(htmlspecialchars($_POST['reply-body'], ENT_QUOTES)),
            ':familyid' => $_SESSION['family_id'],
            ':repliedbyfirst' => $repliedFirst,
            ':repliedbylast' => $repliedLast
            
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


        //Send email to event creator

        $query = " 
            SELECT 
                * 
            FROM custom_events
            WHERE 
                id = :event_id AND
                family_id = :family_id
        "; 
         
        $query_params = array( 
            ':event_id' => $_POST['event-id'],
            ':family_id' => $_SESSION['family_id'] 
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
                $eventName = $y['event_name'];
                $creatorFirst = $y['added_by_first'];
                $creatorLast = $y['added_by_last'];
            }
            
        }


        if(isset($_POST['submitted'])) 
        { 

            $sentlastname = htmlentities($creatorLast, ENT_QUOTES);
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
                ':sentfirstname' => $creatorFirst,
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
                    $creatorFirst = $y['first_name'];
                    $creatorLast = $y['last_name'];
                }
                
            }
            
            $emailTo = $y['email'];
            
        //POPULATE EMAIL COMPONENTS AND SEND EMAIL

                $email = 'familink@codingerik.com';
                //$replyTo = '';
                //$emailTo = '';
                $subject = 'A new message was posted to your '.$eventName.' event!';
                $sendCopy = trim($_POST['sendCopy']);
                $body = '<html>'.$repliedFirst.' '.$repliedLast.' just added a new message to your '.$eventName.' event in Familink!<br><br></html>';
                $body .= nl2br(htmlspecialchars($_POST['reply-body'], ENT_QUOTES));
                $body .='<html><br><br>-----<br>To view this event, other messages, and RSVPs, log in to your family\'s <a href="http://familink.codingerik.com">Familink</a> account and click \'Events\'.<br><br>-----<br>This email was sent using <a href="http://familink.codingerik.com">Familink</a><br><br><small>To unsubscribe from these emails, please click the link above, edit your details, and uncheck "Subscribe"</small></html>';
                $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                //$headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo;
                $headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo . "\r\n";

                mail($emailTo, $subject, $body, $headers);
                //echo '<br><br>Email Sent';
                //echo '<br><a href="familink-secure.php">Return to Familink</a>';

        } 

         
        header("Location: familink-secure.php"); 

        die("Redirecting to familink-secure.php");

    } 
     
?> 