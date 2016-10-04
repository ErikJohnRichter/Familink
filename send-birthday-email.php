<?php 

    require("common.php"); 

    //Logic to determine if today is a birthday

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


            $thisMonth = date("F");
            $today = date('d');

            $query = " 
                SELECT 
                    * 
                FROM family_member
                WHERE 
                    family_id = :id AND
                    dob_month = :thismonth AND
                    dob_day = :today
            "; 
             
            $query_params = array( 
                ':id' => $z['family_id'],
                ':thismonth' => $thisMonth,
                ':today' => $today
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

                    if ($x['dob_year'] != null) {
                          $birthmonth = date('m', strtotime($x['dob_month']));
                          $birthday = ($x['dob_year']).'-'.$birthmonth.'-'.$x['dob_day'];
                          $date1 = date("Y-m-d", strtotime($birthday));
                          $date2 = date("Y-m-d");

                          $datetime1 = date_create($date1);
                          $datetime2 = date_create($date2);
                          $interval = date_diff($datetime1, $datetime2);
                          $howOld = $interval->format('%y');
                    }

                    if ($x['email'] != null) {
                        $emailPerson = 'to <a href="mailto:'.$x['email'].'?body=<br><br><br>Sent from Familink" class="external">'.$x['email'].'</a>';
                    }
                    else {
                        $emailPerson = null;
                    }

                    if ($x['mobile_phone'] != null) {
                        $phone = 'at <a href="tel:'.$x['mobile_phone'].'" class="external">'.$x['mobile_phone'].'</a>';
                        $text = ', <a href="sms:'.$x['mobile_phone'].'" class="external">text</a>, or';
                    }
                    else {
                        $phone = null;
                        $text = null;
                    }
                                        

                    //Compose Birthday Email

                    $recipientList = $_POST['send-email-to'];
                    $subject = $_POST['subject'];
                    $body = $_POST['body'];

                    $emailList = array();
                        //PARSE RECIPIENT LIST AND GET EMAILS
                        
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
                    $replyTo = $x['email'];
                    $subject = 'Today is '.$x['first_name'].'\'s Birthday!';
                    $sendCopy = trim($_POST['sendCopy']);
                    $body = '<html>Yay! Today is '.$x['first_name'].' '.$x['last_name'].'\'s '.$howOld.' Birthday!';
                    $body .= '<br><br>Remember to give a call '.$phone.''.$text.' send an email '.$emailPerson.' (or simply reply to this one).<br><br>...you could send cake also. Everybody loves cake!<br><br>Have a great day!';
                    $body .='<br><br><br>-----<br>This is an automated email sent by <a href="http://familink.codingerik.com">Familink</a>. Replies go to the birthday member.<br><br><small>To unsubscribe from these emails, please click the link above, edit your details, and uncheck "Subscribe"</small></html>';
                    $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $replyTo;

                    mail($emailTo, $subject, $body, $headers);

                    //echo $emailTo;
                    //echo $subject;
                    //echo $body;
                }
            }
        }
    }
     
?> 