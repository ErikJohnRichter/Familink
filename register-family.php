<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        if(empty($_POST['family-username'])) 
        { 
            die("Please enter a username."); 
        } 
         
        if(empty($_POST['family-password'])) 
        { 
            die("Please enter a password."); 
        }
         
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :familyusername 
        "; 
       
        $query_params = array( 
            ':familyusername' => $_POST['family-username'] 
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
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                is_admin,
                family_name
            ) VALUES ( 
                :familyusername, 
                :familypassword, 
                :familysalt, 
                :is_admin,
                :family_name
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        $password = hash('sha256', $_POST['family-password'] . $salt); 
         
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
        
        $query_params = array( 
            ':familyusername' => $_POST['family-username'], 
            ':familypassword' => $password, 
            ':familysalt' => $salt, 
            ':is_admin' => 0,
            ':family_name' => $_POST['family-name']
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
            SELECT 
                id 
            FROM users 
            WHERE 
                family_name = :familyname
            AND
                username = :familyusername
        "; 
       
        $query_params = array( 
            ':familyname' => $_POST['family-name'],
            ':familyusername' => $_POST['family-username'] 
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
        
        if($row){

            $query = " 
                UPDATE users
                SET 
                    family_id = :familyid
                WHERE
                    username = :familyusername
            "; 
             
            
            $query_params = array( 
                ':familyid' => $row['id'],
                ':familyusername' => $_POST['family-username']
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
                UPDATE users
                SET 
                    family_name = :familyname,
                    family_id = :familyid
                WHERE
                    id = :id
            "; 
             
            
            $query_params = array( 
                ':familyid' => $row['id'],
                ':familyname' => $_POST['family-name'],
                ':id' => $_SESSION['userid']
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
            INSERT INTO messages ( 
                title,
                message,
                family_id,
                added_by_first,
                added_by_last
                
            ) VALUES ( 
                :title,
                :message,
                :familyid,
                :addedbyfirst,
                :addedbylast
                
            ) 
        "; 
         
        $query_params = array( 
            ':title' => 'Welcome to your family\'s open forum!',
            ':message' => 'Use this forum to help organize family events or just say "Hi!" Post open messages to everyone in your family and reply to messages other members have posted.',
            ':familyid' => $row['id'],
            ':addedbyfirst' => 'Familink',
            ':addedbylast' => ' '
            
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

        }

         
        header("Location: familink-secure.php"); 
         
        die("Redirecting to familink-secure.php");

    } 
     
?> 