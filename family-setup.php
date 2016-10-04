<?php
    require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: index.php"); 
         
        
        die("Redirecting to index.php"); 
    } 

    $query = " 
            SELECT 
                * 
            FROM users 
        "; 
    $link = mysql_connect($host, $username, $password);
    mysql_select_db($dbname);
    $sql = "SELECT * FROM users WHERE id='".$_SESSION['userid']."' ";
    $result = mysql_query("$sql");

    try 
    { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
       die($ex); 
    } 
         
    $rows = $stmt->fetchAll();
    

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
    <link rel="stylesheet" type="text/css" href="css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="assets/FLIcon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/FLIcon.png" />

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/typed.js" type="text/javascript"></script>
    <script src="js/slidingLabels.js"></script>

</head>

<body>
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

    <nav class="navbar navbar-login navbar-default navbar-fixed-top mainPc" style="padding-top: 25px;">
    <div class="container">
        <div class="two" style="margin-top: -12px;">
            <table>
                <tr>
                    <td><h3>familink</h3></td>
                </tr>
            </table>
            <br>
        </div>
        
        <div class="form-group one" style="padding-top: 16px;">
            <table>
                <tr class="nav">
                    <?php
                    
                    $query = " 
                        SELECT 
                            * 
                        FROM users 
                        WHERE 
                            id = :id 
                    "; 
                     
                    $query_params = array( 
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
                     
                    $row = $stmt->fetch(); 
                    
                    ?>
                    
                    <td> <strong>Hello <?php echo ucfirst(htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')); ?></strong></td>
                    <?php

                    if ($row){
                        if ($row['is_admin'] == 1) {
                            echo '<td>&nbsp;</td>'.
                                '<td>&nbsp;</td>'.
                                '<td><strong style="color: red;">(Administrator)</strong></td>';
                        }
                    }
                    
                    ?>
                    
                </tr>
            </table>
        </div>
    </div>
</nav>

<nav class="navbar navbar-login navbar-default navbar-fixed-top mobile" style="padding-top: 5px; margin: -10px auto; background-color: white;">
            <table align="center">
                <tr>
                    <td><h3 class="text-center" style="margin-bottom: -10px;">familink</h3></td>
                </tr>
            </table>
            <br>
        
        
</nav>

<div class="wrap col-md-12 text-center mainPc">
        

    
    <div id="typed-strings">
        <h2>create your family!</h2>
    </div>
    <span id="typed" style="white-space:pre; margin: 0 auto;"></span>

        
</div>

<div class="col-md-12 text-center mobile">
    
    <h3 style="margin-top: 60px; line-height: 50px; font-size: 35px;">create your family!</h3>
        
</div>

<div class="col-md-12 text-center mainPc">
        
    <p style="font-size: 20px;">Let's start by getting some things set up for your family account.</p>
    <br>
    <p style="font-size: 20px;">In the boxes below, please type<br>
        your extended family name (this will be<br>
        your family account name) and then select<br>
        a shared family username and password.<br>
        Unlike the admin login you just created,<br>
        this username and password will be used<br>
        by all your family members so<br>
        they have access to the site.</p>
    <br>
        
</div>

<div class="col-md-12 text-center mobile" style="margin: 10px; 10px; margin-top: -30px; margin-bottom: -30px;">
        
    <p style="font-size: 20px; margin: 20px; 10px;">Let's start by getting some things set up for your family account.</p>

    <p style="font-size: 20px; margin: 20px; 10px;">In the boxes below, please type your extended family name and then select a shared family username and password. Unlike the admin login you just created, this username and password will be used by all your family members so they have access to the site.</p>
    <br>
        
</div>

<div class="col-md-12 text-center mainPc" style="margin-top: 20px; margin-bottom: 100px;">

    <div id="setupBox" class="form-group">
        <form action="register-family.php" id="contactform1" method="post">
        <table align="center">
            <tr> 
                <td text-align="center" class="slider family-creation" style="position: relative;"><label for="familyName">Family&nbsp;Last&nbsp;Name</label><input class="desktopInput" id="familyName" type="text" name="family-name" value="" / style="margin-bottom: 15px;"></td>
            </tr>
            <tr> 
                <td text-align="center" class="slider family-creation" style="position: relative;"><label for="familyUsername">Shared&nbsp;Username</label><input class="desktopInput" id="familyUsername" type="text" name="family-username" value="" / style="margin-bottom: 15px;"></td>
            </tr>
            <tr>
                <td text-align="center" class="slider family-creation" style="position: relative;"><label for="familyPassword">Shared&nbsp;Password</label><input class="desktopInput" id="familyPassword" type="password" name="family-password" value="" style="margin-bottom: 35px;"/></td> 
            </tr>
            <tr>
                <td><input id="desktopInputButton2" type="submit" class="btn btn-default btn-file btn-green" value="Create Family!" /></td>
                
            </tr>
        </table>
        </form>
    </div>     

</div>

<div class="col-md-12 text-center mobile" style="margin-top: 0px; margin-bottom: 100px;">

    <div id="setupBox" class="form-group">
        <form action="register-family.php" id="contactform1" method="post">
        <table align="center">
            <tr> 
                <td text-align="center" class="" style="position: relative;"><input class="desktopInput" id="familyName" type="text" name="family-name" placeholder="Family Last Name" value="" style="margin-bottom: 15px;"/></td>
            </tr>
            <tr> 
                <td text-align="center" class="family-creation" style="position: relative;"><input class="desktopInput" id="familyUsername" type="text" name="family-username" placeholder="Shared Username" value="" style="margin-bottom: 15px;"/></td>
            </tr>
            <tr>
                <td text-align="center" class="family-creation" style="position: relative;"><input class="desktopInput" id="familyPassword" type="password" name="family-password" placeholder="Shared Password" value="" style="margin-bottom: 35px;"/></td> 
            </tr>
            <tr>
                <td><input id="desktopInputButton2" type="submit" class="btn btn-default btn-file btn-green" value="Create Family!" /></td>
                
            </tr>
        </table>
        </form>
        <br>
                <br class="mobile">
                <br class="mobile">
                <br class="mobile">
    </div>     

</div>

    <!--Documentation Modal-->
    <?php include 'documentation.php'; ?>


    <!--Page Footer-->
    <footer style="z-index: 99; position:fixed; bottom:0; width:100%; background-color:white;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 text-center">
            <br>
                1.0.0 | <a data-toggle="modal" href="#documentation">Documentation</a>
            <br>
            <br>
       </div>
       <div class="col-lg-2"></div>
    </footer>

    <div class="clear-fix"></div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>

</body>

</html>