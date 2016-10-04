<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            DELETE FROM family_member 
            WHERE 
                id = :memberid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
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