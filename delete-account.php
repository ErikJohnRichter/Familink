<?php 

    require("common.php"); 
     

        $query = " 
            DELETE
            FROM users 
            WHERE 
                family_id = :familyid 
        "; 
       
        $query_params = array( 
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

        $query = " 
            DELETE
            FROM family_unit
            WHERE 
                family_id = :familyid 
        "; 
       
        $query_params = array( 
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
         
        $query = " 
            DELETE
            FROM family_member 
            WHERE 
                family_id = :familyid 
        "; 
       
        $query_params = array( 
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

        unset($_SESSION['user']); 
     
        header("Location: index.php"); 
        
        die("Redirecting to: index.php");
     
?> 