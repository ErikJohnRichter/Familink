<?php 

    require("common.php"); 
     
    $submitted_username = ''; 
     
    if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                id, 
                username, 
                password, 
                salt, 
                email 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        $query_params = array( 
            ':username' => $_GET['username'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again.");
            
            /*die("Failed to run query: " . $ex->getMessage()); */
        } 
         
        $login_ok = false; 
         
        $row = $stmt->fetch(); 
        if($row) 
        { 
            $check_password = hash('sha256', $_GET['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                $login_ok = true; 
            } 
        } 
         
        if($login_ok) 
        { 
            unset($row['salt']); 
            unset($row['password']); 
             
            $_SESSION['user'] = $row;
            $_SESSION['userid'] = $row['id'];
        
             
            header("Location: familink-secure.php"); 
            die("Redirecting to: familink-secure.php"); 
        } 
        else 
        { 
            echo'<div class="text-center">
            <h3>bummer! that didn\'t work...try again.<h3>
            </div>'; 
            
            $submitted_username = htmlentities($_GET['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 