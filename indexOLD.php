<?php
    require("common.php");

    if ($_SESSION['user'] != NULL){
        header("Location: familink-secure.php"); 
        die("Redirecting to: familink-secure.php"); 
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

    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <!--Let browser know website is optimized for mobile-->
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/typed.js" type="text/javascript"></script>
    <script src="js/slidingLabels.js"></script>
    <script type="text/javascript" src="js/my-app.js"></script>

</head>

<body>
    <div id="page-loader"></div>

    <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>-->
    
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

        <div class="form-group one">
        <table>
            <br>
            <tr>
                <td>&nbsp&nbsp&nbsp&nbsp<button type="button" id="signUpButton" class="btn btn-default btn-file" data-toggle="modal" data-target="#signUpDesktop">Create a Family</button></td>
                <td>&nbsp&nbsp&nbsp&nbsp<button type="button" id="whatIsThisButton" class="btn btn-default btn-file" data-toggle="modal" data-target="#whySignUp">What Is This?</button></td>
            </tr>
        </table>
        </div>
            
            
    </div>
         
     
    </div>
    </nav>

    <div class="wrap col-md-12 text-center mainPc">
        

    
    <div id="typed-strings">
        <h2>family, linked!</h2>
        <h2>familink</h2>
    </div>
    <span id="typed" style="white-space:pre; margin: 0 auto;"></span>

        
</div>

<div class="col-md-12 text-center mainPc">

    <div id="loginBox" class="form-group">
        <form action="login.php" id="contactform" method="post">
        <table align="center">
            <tr> 
                <td text-align="center" class="slider login-home" style="position: relative;"><label for="loginUsernameInput">Username</label><input class="desktopInput" id="loginUsernameInput" type="text" name="username" value="" style="margin-bottom: 15px;"/></td>
            </tr>
            <tr>
                <td text-align="center" class="slider login-home" style="position: relative;"><label for="loginPasswordInput">Password</label><input class="desktopInput" id="loginPasswordInput" type="password" name="password" value="" style="margin-bottom: 35px;"/></td> 
            </tr>
            <tr>
                <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                <td><input id="desktopInputButton2" type="submit" class="btn btn-default btn-file btn-green" value="Login" /></td>
                
            </tr>
        </table>
        </form>
    </div>     

</div>

<div class="col-md-12 text-center mobile">

    <h3 class="login" style="margin-bottom: 20px;">familink</h3>
    <div class="form-group">
        <form action="login.php" method="post">
        <table align="center">
            <tr>
                <td text-align="center"><input class="desktopInput" id="loginUsernameInput" type="text" name="username" placeholder=" Username" value="" / style="margin-bottom: 15px;"></td>
            </tr>
            <tr>
                <td><input class="desktopInput" id="loginPasswordInput" type="password" placeholder=" Password" name="password" value="" style="margin-bottom: 15px;"/></td> 
            </tr>
            <tr>
                <td><input id="desktopInputButton2" type="submit" class="btn btn-default btn-file btn-green" value="Login" /></td>
                
            </tr>
            
        </table>
        </form>
        <!--<br><br>
        <button type="button" id="signUpButton" class="btn btn-default btn-file" data-toggle="modal" data-target="#signUpDesktop" style="width: 180px;">Create a Family</button>-->
    </div>     

</div>
    
    
    <div class="clearfix"></div>

    <!--Why Sign Up Modal-->
    <div class="modal fade modal-center" id="whySignUp" role="dialog">
        <div class="modal-content" style="background-color: #efefef;" >
            <div class="container">
                <div class="modal-body">
                    <div class="col-md-8">
                        <div class="text-center">
                            <h3>what is this?</h3>
                            <br><br>
                        </div>

                        <p style="font-family: sans-serif;"><strong>Family, linked! This is Familink!</strong><p>

                        <p style="font-family: sans-serif;">A family is the heart of any person's social group. And as much as we would like to,
                            keeping in touch and organizing events with all of our family members can be difficult.
                            People move. Contact points change. Calendars rarley sync. How to we make sure that heart keeps beating?<p>

                        <p style="font-family: sans-serif;">Enter Familink. With this app you can:<p>

                        <ul>
                            <strong>Reference</strong>
                            <li>Get family member contact info, such as phone numbers, email addresses, and/or physical addresses.</li>
                            <li>Remember family members' birthdays, anniversaries, and other important notes.</li>
                            <li>Edit contact info on-the-fly, giving everyone else in the family instant access to those changes.</li>
                            <br>
                            <strong>Connect</strong>
                            <li>Send email to your whole extended family, individual family units, or individual family members.</li>
                            <li>COMING SOON - Post open forum notes for everyone to see.</li>
                            <li>COMING SOON - Receive email notifications when important dates happen.</li>
                            <br>
                            <strong>Organize</strong>
                            <li>COMING SOON - Family parties or outings? Put 'em on the calendar!</li>
                            <li>COMING SOON - Export contact info and calendar events to your phone/computer.</li>
                            <br>
                            <strong>Archive</strong>
                            <li>COMING SOON - Family stories, recipes, thoughts, or memories? Let this app be an archive for those important things!</li>
                            <li>COMING SOON - With Dropbox integration, quickly access photos from past family events.</li>
                            <br>
                            <strong>Secure</strong>
                            <li>Only family members will ever have access to your family's data.</li>
                        </ul>
                        <br>
                        <p style="font-family: sans-serif;"><strong>A little more detail...</strong><p>
                        <p style="font-family: sans-serif;">One of the beautiful things about familink is you never have to worry about keeping up with everyone's current contact info! It is
                                always here! If Uncle Bob gets a new cell phone number, he can edit his details...and Mom doesn't need to change it in her phone. If Cousin
                                Julie graduates and loses her school email, she can change that to her new work address...so the next time Grandma sends an email inviting
                                people to dinner next Friday, Judy will definitely be showing up! Even though a detail may change for one member, everyone
                                else in the family instantly has access to that change all from a central location.</p>
                            <p style="font-family: sans-serif;">Extending from this, through familink, users are able to leverage their family members' current emails with the Family Unit feature!
                                When sending emails from familink, Julie no longer needs to remember to type every cousin's email address, some of which may be outdated, 
                                when sending the invite to the cousins' baseball game next month. She can simply select "Cousins" and send! With Family Units, users
                                can send emails to the Whole Family, individual Family Units, or individual members...knowing every email will get sent to the right people
                                at valid addresses, and, more importantly, received by them!</p>
                            <p style="font-family: sans-serif;">Familink. Keeping families linked!</p>
                            <br>
                        <p style="font-family: sans-serif;"><strong>So get me this thing!</strong><p>
                        <p style="font-family: sans-serif;">To sign up your family for an account, simply click "Create a Family" and follow the steps! It's free! 
                            After doing so, you will create a private administrator account that will be used to create, monitor, and organize your family-share
                            account and credentials. This keeps things easy for the whole family to better use this app.<p>
                        <p style="font-family: sans-serif;">If your family already has an account, contact your administrator for the common username and password
                            your whole family shares.<p>
                        <br>

                        <div class="text-center">
                            
                            <button type="button" class="btn btn-lg btn-default btn-success" data-dismiss="modal">Cool!</button>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Sign Up Modal-->

    <div class="modal fade modal-center" id="signUpDesktop" role="dialog" style="width: 340px; margin: 10% auto; ">
        <div class="modal-content" style="background-color: #efefef;" >
            <div class="container">
                

                    <div style="padding: 10px 40px 40px 40px;">
                 
                    <h3>sign up!</h3>
                    <br>
                    <p>Let's start by creating<br>your family admin login</p>
                    <br>
                    <form action="register.php" method="post"> 
                        Username:<br /> 
                        <input id="desktopSignUpInput" type="text" name="username" value="" /> 
                        <br /><br /> 
                        E-Mail:<br /> 
                        <input id="desktopSignUpInput" type="text" name="email" value="" /> 
                        <br /><br /> 
                        Password:<br /> 
                        <input id="desktopSignUpInput" type="password" name="password" value="" /> 
                        <br /><br /> 
                        <input type="checkbox" name="agree" value=""> I agree to <a href="terms.php">Familink's terms</a><br>
                        <br />
                        <input type="submit" class="btn btn-lg btn-default btn-success" value="Register" /> 
                    </form>
                    <br>
                    <br>
                    <button type="button" class="btn btn-default btn-warning" data-dismiss="modal">Not Today</button>
                    <br>  
                </div>
            </div>
        </div>
    </div>

    <!--Mobile Access Content-->
    <!--<div class="mobile text-center">
        <h5 style="margin: 10px;">Sorry, this app is not available in a mobile setting</h5>
        <h5 style="margin: 10px;">Please visit from a desktop or laptop</h5>
    </div>-->

    <!--Documentation Modal-->
    <?php include 'documentation.php'; ?>

    <!--Page Footer-->
    <footer style="position:fixed; bottom:0; width:100%; background-color:white;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 text-center">
            <br>
                
                        <span class="mobile"><a data-toggle="modal" href="#documentation">What Is This?</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a data-toggle="modal" href="#signUpDesktop">Create a Family</a></span>
                        <span class="copyright mainPc">Made with <i class="fa fa-heart" style="color:red;"></i> in Milwaukee&nbsp&nbsp|&nbsp&nbsp&copy <a href="http://codingerik.com" target="_blank">CodingErik</a> 2016</span>
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