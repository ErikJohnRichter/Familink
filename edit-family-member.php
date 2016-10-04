<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        $query = " 
            UPDATE family_member

            SET 
                first_name=:firstname,
                last_name=:lastname,
                dob=:dob,
                home_phone=:homephone,
                mobile_phone=:mobilephone,
                email=:email,
                address1=:address1,
                address2=:address2,
                city=:city,
                state=:state,
                zip=:zip,
                family_unit_1=:familyunit1,
                family_unit_2=:familyunit2,
                family_unit_3=:familyunit3, 
                photo=:photo
            
            WHERE

            id=:memberid AND
            family_id=:familyid 
        "; 
         
        $query_params = array( 
            ':firstname' => $_POST['first-name'],
            ':lastname' => $_POST['last-name'],
            ':dob' => $_POST['dob'],
            ':homephone' => $_POST['home-phone'],
            ':mobilephone' => $_POST['mobile-phone'],
            ':email' => $_POST['email'],
            ':address1' => $_POST['address1'],
            ':address2' => $_POST['address2'],
            ':city' => $_POST['city'],
            ':state' => $_POST['state'],
            ':zip' => $_POST['zip'],
            ':familyunit1' => $_POST['family-unit-1'],
            ':familyunit2' => $_POST['family-unit-2'],
            ':familyunit3' => $_POST['family-unit-3'],
            ':photo' => $_POST['photo'],
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