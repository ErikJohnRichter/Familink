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

    if ($row['is_admin'] != 1) {

        header("Location: index.php"); 
        
        die("Redirecting to index.php"); 
    }

    $query = " 
        SELECT 
            * 
        FROM users
        WHERE 
            id = :id 
    "; 
     
    $query_params = array( 
        ':id' => $row['family_id'] 
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
     
    $rows = $stmt->fetch();

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
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="assets/FLIcon.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="assets/FLIcon.png" />

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

    <!-- Include the plugin's CSS and JS: -->
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <!--Let browser know website is optimized for mobile-->
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/jquery-ui.js"></script>
   
</head>

<body style="background-color: white;">
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>-->

    <nav class="navbar navbar-login navbar-default navbar-fixed-top mainPc" style="padding-top: 25px; background-color: #f1c40f;">
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
                        
                       
                            if ($row){
                                $_SESSION['family_id'] = $row['family_id'];
                                if ($row['is_admin'] == 1) {
                                    echo '<td> <strong>Hello, '.ucfirst(htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')).'!</strong></td>'.
                                        '<td>&nbsp;</td>'.
                                        '<td>&nbsp;</td>'.
                                        '<td><strong style="color: red;">(ADMIN)</strong></td>';
                                        
                                }
                                else {
                                    echo '<td> <strong>The '.$row['family_name'].' Family</strong></td>';
                                }
                        }
                    ?>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>

                    <form action="logout.php">
                        <td><input type="submit" class="btn btn-default btn-info" value="Logout"></td>
                    </form>

                    <?php

                    if ($row['is_admin'] == 1) {
                    echo '<td>&nbsp;</td>'.
                        '<td>&nbsp;</td>'.
                        '<td><button type="button" class="btn btn-default" style="border: none;"><a href="familink-secure.php"><i class="fa fa-home" aria-hidden="true"></i></a></td>';
                    }

                    ?>
                    
                </tr>
            </table>
        </div>
    </div>
</nav>
<nav class="navbar navbar-login navbar-default navbar-fixed-top mobile" style="padding-top: 5px; margin: -10px auto; background-color: #f1c40f;">
            <table align="center">
                <tr>
                    <td><h3 class="text-center" style="margin-bottom: -10px;">familink</h3></td>
                </tr>
            </table>
            <br>
        
        
</nav>

<div class="col-md-12 text-center" style="margin-bottom: 130px;">
<div class="col-md-12 text-center mainPc" id="familyName" style="margin-top: 5%; margin-bottom: 40px;">

    <h3 style="padding-bottom: 20px;">account settings</h3>
    <hr>
</div>

<div class="col-md-12 text-center mobile" id="familyName" style="margin-top: 10%; margin-bottom: 20px;">

    

    <h2 style="margin-top: 10%;"><br>account settings</h2>

    

</div>
<br>
<!--Change Admin Username and Password-->
<hr>
<br>
<div class="form-group" id="changeAdminCredentials">
    <form action="change-admin-credentials.php" method="post">
    <table align="center">
        <thead>
        <h4 style="margin-bottom: 15px;">admin credentials</h4>
        </thead>
        <tbody>
        <tr> 
            <td>
                <label for="changeAdminUsernameInput" style="font-size: 15px;">Username</label>
                <input class="desktopInput2" id="changeAdminUsernameInput" type="text" name="new-admin-username" placeholder="Enter New Username" value="<?php echo $row['username']; ?>"/>
            </td>
        </tr>
        <tr> 
            <td>
                <label for="changeAdminPasswordInput" style="font-size: 15px;">Password</label>
                <input class="desktopInput2" id="changeAdminPasswordInput" type="password" name="new-admin-password" placeholder="Enter New Password" value=""/>
            </td>
        </tr>
        <tr>
            <td><br><button id="changeAdmin" type="submit" class="btn btn-default btn-file btn-green" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
        </tr>
    </tbody>
    </table>
    </form>
</div>   
<br>  
<!--Change Family Username and Password-->

<hr>
<br>
<div class="form-group" id="changeFamilyCredentials">
    <form action="change-family-credentials.php" method="post">
    <table align="center">
        <thead>
        <h4 style="margin-bottom: 15px;">family credentials</h4>
        </thead>
        <tbody>
        <tr> 
            <td>
                <label for="changeFamilyUsernameInput" style="font-size: 15px;">Username</label>
                <input class="desktopInput2" id="changeFamilyUsernameInput" type="text" name="new-family-username" placeholder="Enter New Username" value="<?php echo $rows['username']; ?>"/>
            </td>
        </tr>
        <tr> 
            <td>
                <label for="changeFamilyPasswordInput" style="font-size: 15px;">Password</label>
                <input class="desktopInput2" id="changeFamilyPasswordInput" type="password" name="new-family-password" placeholder="Enter New Password" value=""/>
            </td>
            </tr>
        <tr>
            <td><br><button id="changeFamily" type="submit" class="btn btn-default btn-file btn-green" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
        </tr>
    </tbody>
    </table>
    </form>
</div>     

<!--Change Family Name-->
<br><br>
<div class="form-group" id="changeFamilyName">
    <form action="change-family-name.php" method="post">
    <table align="center">
        <tr> 
            <td><br>
                <label for="changeFamilyNameInput" style="font-size: 15px;">Family Name</label>
                <input class="desktopInput2" id="changeFamilyNameInput" type="text" name="new-family-name" placeholder="Enter New Family Name" value="<?php echo $row['family_name']; ?>"/>
            </td>
            </tr>
        <tr>
            <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
            <td><br><button id="changeFamilyName" type="submit" class="btn btn-default btn-file btn-green" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Change</button></td>
            
        </tr>
    </table>
    </form>
</div> 
<br>    

<!--Delete Account-->

<hr>
<br>
<div class="form-group" id="deleteFamilyAccount">
    <form action="delete-account.php" method="post">
    <table align="center">
        <tr><td><h4 style="margin-bottom: 15px;">delete account</h4></td></tr>
        <tr> 
            <input type="hidden" name="family-id" value="<?php echo $rows['family_id'] ?>">
            <td><button id="deleteFamily" type="submit" class="btn btn-default btn-file btn-danger" style="margin-bottom: 4px; margin-left: 10px; width: 150px;">Delete Family</button></td>
        </tr>
    </table>
    </form>
</div>

</div>  

<script>
$(function() {
   $("#deleteFamily").click(function(){
      if (confirm("Are you sure you want to delete your familink account? This is perminant and you and your family will no longer have access to this account.")){
         $('#deleteFamilyAccount').submit();
      }
      else {
        return false;
      }
   });
});

</script>  
    <div class="clearfix"></div>
    

    <!--Documentation Modal-->
    <?php include 'documentation.php'; ?>


    <!--Page Footer-->
    <footer style="position:fixed; bottom:0; width:100%; background-color: #f1c40f;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 text-center">
            <br>
                1.0.0 | <a class="mainPc" data-toggle="modal" href="#documentation">Documentation</a>
                        <form id="mobileLogout" class="mobile" action="logout.php">
                        <a class="mobile" onclick="document.getElementById('mobileLogout').submit()" href="#">Logout</a>
                        </form>
                        <?php 
                        if ($row['is_admin'] == 1) {
                        echo '<a class="mobile" href="familink-secure.php" style="float: right;"><i class="fa fa-home" aria-hidden="true"></i></a>';
                        }
                        ?>
                        
            <br>
            <br>
       </div>
       <div class="col-lg-2"></div>
    </footer>

    <div class="clear-fix"></div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>

</body>

</html>