<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 

        $query = " 
            UPDATE users

            SET 
                family_name = :newfamilyname
            
            WHERE

            family_id=:familyid 
        "; 
         
        $query_params = array( 
            ':newfamilyname' => $_POST['new-family-name'],
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