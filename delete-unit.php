<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            DELETE FROM family_unit 
            WHERE 
                unit_name = :unitname AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':unitname' => $_POST['unit-name'], 
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