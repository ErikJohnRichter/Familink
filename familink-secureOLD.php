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
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>familink</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="" />

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
    <script>
  $( function() {
    $( "#familyUnit" ).accordion();
  } );
  </script>
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
                        '<td><button type="button" class="btn btn-default" style="border: none;"><a href="settings.php"><i class="fa fa-cogs" aria-hidden="true"></i></a></td>';
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

<div class="col-md-12 text-center mainPc" id="familyName" style="margin-top: 5%; margin-bottom: 20px;">

    <?php

    echo '<h2>The '.$row['family_name'].' Family</h2>';

    ?>

</div>

<div class="col-md-12 text-center mobile" id="familyName" style="margin-top: 10%; margin-bottom: 20px;">

    <?php

    echo '<h2 style="margin-top: 10%;"><br>The '.$row['family_name'].' Family</h2>';

    ?>

</div>

<div class="col-md-3"></div>
<div class="panel-group col-md-6" id="accordion">
    
    <?php include 'family-units.php'; ?>

    <?php include 'family-members.php'; ?>

    <?php include 'email-family.php'; ?>

    <?php include 'faqs.php'; ?>
    

</div>
<div class="col-md-3"></div>

            
<div class="modal fade" id="memberDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          //Content Will show Here
        </div>
    </div>
</div>
<script>
                $( document ).ready(function() {
                    $('#memberDetails').on('hidden.bs.modal', function () {
                          $(this).removeData('bs.modal');
                          $('.two').trigger();
                    });

                });
                </script>

<div class="clearfix"></div>
<br><br><br>

<br><br>
<div id="confirm" class="modal fade modal-center" style="width: 250px; margin: 10% auto;">
    <div class="modal-content" >
        <div class="container">
            <div class="modal-body">
                <div class="col-md-2">
                    <div class="text-center" style="margin-bottom: 25px;">
                        <h4>are you sure?</h4>
                        <br><br>
                        <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
   $("#deleteUnit").click(function(){
      if (confirm("Are you sure you want to delete this unit?")){
         $('#familyUnitForm').submit();
      }
      else {
        return false;
      }
   });
});

$(function() {
   $("#deleteMember").click(function(){
      if (confirm("Are you sure you want to delete this family member?")){
         $('#familyMemberForm').submit();
      }
      else {
        return false;
      }
   });
});


</script>

    <!--Mobile Access Content-->
    <div class="mobile text-center">
    </div>  

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
                        echo '<a class="mobile" href="settings.php" style="float: right;"><i class="fa fa-cogs" aria-hidden="true"></i></a>';
                        }
                        ?>
                        
            <br>
            <br>
       </div>
       <div class="col-lg-2"></div>
    </footer>

    <div class="clear-fix"></div>

    <!-- jQuery Version 1.11.3 -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>

</body>

</html>