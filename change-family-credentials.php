<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
       
        $query_params = array( 
            ':username' => $_POST['new-family-username'] 
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
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die("This username is already in use"); 
        } 

        $query = " 
            UPDATE users

            SET 
                username = :newusername,
                password = :password,
                salt = :salt
            
            WHERE

            id=:familyid 
        "; 

        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        $password = hash('sha256', $_POST['new-family-password'] . $salt); 
         
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
        $query_params = array( 
            ':newusername' => $_POST['new-family-username'],
            ':password' => $password, 
            ':salt' => $salt, 
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

        die("Redirecting to: familink-secure.php");
    } 
     
?> 