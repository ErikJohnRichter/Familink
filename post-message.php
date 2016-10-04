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

        $query = " 
            INSERT INTO messages ( 
                title,
                message,
                family_id,
                added_by_first,
                added_by_last
                
            ) VALUES ( 
                :title,
                :message,
                :familyid,
                :addedbyfirst,
                :addedbylast
                
            ) 
        "; 
         
        $query_params = array( 
            ':title' => $_POST['message-title'],
            ':message' => nl2br(htmlspecialchars($_POST['message-body'], ENT_QUOTES)),
            ':familyid' => $_SESSION['family_id'],
            ':addedbyfirst' => $addedFirst,
            ':addedbylast' => $addedLast
            
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


//



        $emailList = array();
        

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
        $subject = $senderFirst.' '.$senderLast.' just posted a new message in Familink!';
        $sendCopy = trim($_POST['sendCopy']);
        $body = '<html><br>This is a notification that '.$senderFirst.' '.$senderLast.' just posted a new message in your family\'s Familink forum!<br><br>Message Subject: <strong>'.$_POST['message-title'].'</strong><br><br>To view this message, visit <a href="http://familink.codingerik.com">Familink</a> and click on Forum.<br></html>';
        $body .='<html><br><br>-----<br>This email was sent using <a href="http://familink.codingerik.com">Familink</a><br><br><small>To unsubscribe from these emails, please click the link above, edit your details, and uncheck "Subscribe"</small></html>';
        $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo;
        $headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo . "\r\n" . 'Cc: ' . $replyTo . "\r\n";

        mail($emailTo, $subject, $body, $headers);
        
        /*echo $emailTo;
        echo '<br>';
        echo $subject;
        echo '<br>';
        echo $body;
        echo '<br>';
        echo $replyTo;*/



//       
        header("Location: familink-secure.php"); 
         
        die("Redirecting to familink-secure.php");

    } 
     
?> 