<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        if ($_POST['anniversary-month'] != null) {
            $anniversary = $_POST['anniversary-month'].' '.$_POST['anniversary-day'];
        }

        if ($_POST['birth-month'] != null) {
            $birthday = $_POST['birth-month'].' '.$_POST['birth-day'];
        }
            
        $query = " 
            INSERT INTO family_member ( 
                first_name,
                last_name,
                dob,
                dob_month,
                dob_day,
                home_phone,
                mobile_phone,
                email,
                is_subscribed,
                address1,
                address2,
                city,
                state,
                zip,
                family_unit_1,
                family_unit_2,
                family_unit_3, 
                family_id,
                photo,
                anniversary,
                notes,
                anniversary_month,
                anniversary_day,
                dob_year,
                anniversary_year
                
            ) VALUES ( 
                :firstname,
                :lastname,
                :dob,
                :dobmonth,
                :dobday,
                :homephone,
                :mobilephone,
                :email,
                :issubscribed,
                :address1,
                :address2,
                :city,
                :state,
                :zip,
                :familyunit1,
                :familyunit2,
                :familyunit3,
                :familyid,
                :photo,
                :anniversary,
                :notes,
                :anniversarymonth,
                :anniversaryday,
                :dobyear,
                :anniversaryyear
               
            ) 
        "; 
         
        $query_params = array( 
            ':firstname' => $_POST['first-name'],
            ':lastname' => $_POST['last-name'],
            ':dob' => $birthday,
            ':dobmonth' => $_POST['birth-month'],
            ':dobday' => $_POST['birth-day'],
            ':homephone' => $_POST['home-phone'],
            ':mobilephone' => $_POST['mobile-phone'],
            ':email' => $_POST['email'],
            ':issubscribed' => 1,
            ':address1' => $_POST['address1'],
            ':address2' => $_POST['address2'],
            ':city' => $_POST['city'],
            ':state' => $_POST['state'],
            ':zip' => $_POST['zip'],
            ':familyunit1' => $_POST['family-unit-1'],
            ':familyunit2' => $_POST['family-unit-2'],
            ':familyunit3' => $_POST['family-unit-3'],
            ':familyid' => $_POST['family-id'],
            ':photo' => $_POST['photo'],
            ':anniversary' => $anniversary,
            ':notes' => $_POST['notes'],
            ':anniversarymonth' => $_POST['anniversary-month'],
            ':anniversaryday' => $_POST['anniversary-day'],
            ':dobyear' => $_POST['dob-year'],
            ':anniversaryyear' => $_POST['anniversary-year']
            
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