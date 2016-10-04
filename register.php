<?php 

    require("common.php"); 
     
    if(!empty($_POST)) 
    { 
        if(empty($_POST['username'])) 
        { 
            die("Please enter a username."); 
        } 
         
        if(empty($_POST['password'])) 
        { 
            die("Please enter a password."); 
        }

        /*if(!isset($_POST['agree'])) 
        {
            die("Please check that you agree to Familinks's Terms."); 
        }*/
         
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
       
        $query_params = array( 
            ':username' => $_POST['username'] 
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
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
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
            die("This email address is already registered"); 
        } 
         
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email,
                is_admin
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email,
                :is_admin
            ) 
        "; 
         
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        $password = hash('sha256', $_POST['password'] . $salt); 
         
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
        
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'],
            ':is_admin' => 1
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

        /*$userName = $_POST['username'];

        $query = " 
            CREATE TABLE `data_generator`.`configurations-".$userName."` (
                id INT NOT NULL AUTO_INCREMENT,
                config LONGTEXT NOT NULL,
                name VARCHAR(45) NOT NULL,
                PRIMARY KEY (id)
        )"; 

        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Sorry, there was an error. Please try again.");
        } */
         
        /*header("Location: index.php"); 
         
        die("Redirecting to index.php"); */

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
            ':username' => $_POST['username'] 
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
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
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
        
             
            header("Location: family-setup.php"); 
            die("Redirecting to: family-setup.php"); 
        } 
        else 
        { 
            echo'<div class="text-center">
            <h3>bummer! that didn\'t work...try again.<h3>
            </div>'; 
            
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
     
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Familink</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

</head>
<body>
<br>
<br>
<br>

<div class="container">
<div class="form-group text-center">
<h4>Register</h4> 
<br>
<br> 
<form action="register.php" method="post"> 
    Username:<br /> 
    <input type="text" name="username" value="" /> 
    <br /><br /> 
    E-Mail:<br /> 
    <input type="text" name="email" value="" /> 
    <br /><br /> 
    Password:<br /> 
    <input type="password" name="password" value="" /> 
    <br /><br /> 
    <input type="checkbox" name="agree" value=""> I agree to <a href="terms.php">Familink's Terms</a><br>
                    <br />
    <input type="submit" class="btn btn-default btn-file" style="border: 1px solid lightgrey;" value="Register" /> 
</form>


</div>
</div>
</body>
</html>