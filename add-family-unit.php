<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            INSERT INTO family_unit ( 
                unit_name, 
                family_id
            ) VALUES ( 
                :unitname, 
                :familyid
            ) 
        "; 
         
        $query_params = array( 
            ':unitname' => $_POST['unit-name'].' Family', 
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