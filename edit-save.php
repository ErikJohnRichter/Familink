<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        if(isset($_POST['is-subscribed'])){
            $subscribed = 1;
        }
        else{
            $subscribed = 0;
        }

        if ($_POST['anniversary-month'] != null) {
            $anniversary = $_POST['anniversary-month'].' '.$_POST['anniversary-day'];
        }

        if ($_POST['birth-month'] != null) {
            $birthday = $_POST['birth-month'].' '.$_POST['birth-day'];
        }

        $query = " 
            UPDATE family_member

            SET 
                first_name=:firstname,
                last_name=:lastname,
                dob=:dob,
                dob_month=:dobmonth,
                dob_day=:dobday,
                home_phone=:homephone,
                mobile_phone=:mobilephone,
                email=:email,
                is_subscribed=:issubscribed,
                address1=:address1,
                address2=:address2,
                city=:city,
                state=:state,
                zip=:zip,
                family_unit_1=:familyunit1,
                family_unit_2=:familyunit2,
                family_unit_3=:familyunit3, 
                photo=:photo,
                anniversary=:anniversary,
                notes=:notes,
                anniversary_month=:anniversarymonth,
                anniversary_day=:anniversaryday,
                dob_year=:dobyear,
                anniversary_year=:anniversaryyear
                
            
            WHERE

            id=:memberid AND
            family_id=:familyid 
        "; 
         
        $query_params = array( 
            ':firstname' => $_POST['first-name'],
            ':lastname' => preg_replace('/[ ](?=[^>]*(?:<|$))/', '&nbsp;', $_POST['last-name']),
            ':dob' => $birthday,
            ':dobmonth' => $_POST['birth-month'],
            ':dobday' => $_POST['birth-day'],
            ':homephone' => $_POST['home-phone'],
            ':mobilephone' => $_POST['mobile-phone'],
            ':email' => $_POST['email'],
            ':issubscribed' => $subscribed,
            ':address1' => $_POST['address1'],
            ':address2' => $_POST['address2'],
            ':city' => $_POST['city'],
            ':state' => $_POST['state'],
            ':zip' => $_POST['zip'],
            ':familyunit1' => $_POST['family-unit-1'],
            ':familyunit2' => $_POST['family-unit-2'],
            ':familyunit3' => $_POST['family-unit-3'],
            ':photo' => $_POST['photo'],
            ':anniversary' => $anniversary,
            ':notes' => $_POST['notes'],
            ':anniversarymonth' => $_POST['anniversary-month'],
            ':anniversaryday' => $_POST['anniversary-day'],
            ':dobyear' => $_POST['dob-year'],
            ':anniversaryyear' => $_POST['anniversary-year'],
            ':memberid' => $_POST['member-id'],
            ':familyid' => $_POST['family-id']

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