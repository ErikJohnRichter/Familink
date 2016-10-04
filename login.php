<?php 

    require("common.php"); 
     
    $submitted_username = ''; 
     
    if(!empty($_POST)) 
    { 
        if (isset($_POST['remember'])) {
            setcookie("familink-username",$_POST['username'], time()+ (365 * 24 * 60 * 60));
            setcookie("familink-password",$_POST['password'], time()+ (365 * 24 * 60 * 60));
            setcookie("familink-remember",true, time()+ (365 * 24 * 60 * 60));
        }
        else {
            setcookie("familink-username","", time()-3600);
            setcookie("familink-password","", time()-3600);
            setcookie("familink-remember",false, time()-3600);
        }

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
        
             
            header("Location: familink-secure.php"); 
            die("Redirecting to: familink-secure.php"); 
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


    <title>familink</title>

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
<br>
<div class="container">
<div class="form-group text-center">
<h4>Login</h4> 
<br>
<br>
<form action="login.php" method="post"> 
    <!--Username:<br />-->
    <input type="text" name="username" placeholder=" Username" value="<?php echo $submitted_username; ?>" /> 
    <br /><br /> 
    
    <input type="password" placeholder=" Password" name="password" value="" /> 
    <br /><br /> 
    <input type="submit" class="btn btn-default btn-file" style="border: 1px solid lightgrey;" value="Login" />&nbsp;&nbsp;&nbsp;&nbsp; or <a href="register.php">Register</a>
</form>


</div>
</div>
</body>
</html>