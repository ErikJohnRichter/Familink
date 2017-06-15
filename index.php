<?php
    require("common.php");

    if ($_SESSION['user'] != NULL){
        header("Location: familink-secure.php"); 
        die("Redirecting to: familink-secure.php"); 
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="shortcut icon" href="images/apple-touch-icon7.png">
<link rel="apple-touch-icon" href="images/apple-touch-icon7.png" />
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
<link href="images/apple-touch-startup-image-640x1096.png" media="(device-width: 375px) and (device-height: 667px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<title>Familink</title>
<link rel="stylesheet" href="css/framework7.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/blue.css">
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<link type="text/css" rel="stylesheet" href="css/animations.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900|Josefin+Sans:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Didact+Gothic|News+Cycle:400,700" rel="stylesheet">

</head>
<body id="mobile_wrap">
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>

    
    <div class="views">

      <div class="view view-main">
          <div class="pages">
            <div data-page="index" class="page homepage">

            <div class="page-content">
              <div class="logo logo-home index-logo" style="margin-top: 1%;"><img src="images/apple-touch-icon6.png" style="width: 25%;"/></div>
                  
                    <div class="logo logo-home" style="margin-top: 2px;"><h1>familink</h1><span>FAMILY LINKED!</span></div>
                       <nav class="main-nav main-nav-home" style="margin-top: 11em;">
                        <ul>
                          <li><a href="#" data-popup=".popup-login" class="open-popup"><img src="images/icons/blue/user.png" alt="" title="" /><span>LOGIN</span></a></li>
                          <li><a href="#" data-popup=".popup-signup" class="open-popup"><img src="images/icons/blue/electronics.png" alt="" title="" /><span>SIGN UP</span></a></li>
                          <li><a href="index-help.php"><img src="images/icons/blue/question.png" alt="" title="" /><span>HELP</span></a></li>
                          
                        </ul>
                      </nav> 
                    </div>
                </div> 
                </div>     
      </div>
    </div>
    
    <!-- Login Popup -->
    <div class="popup popup-login">
    <div class="content-block-login">
      <h4>LOGIN</h4>
            <div class="loginform">
                <form action="login.php" id="LoginForm" method="post">
                <div class="form_row">
                <div class="form_row_icon"><img src="images/icons/blue/user.png" alt="" title="" /></div>
                <input style="font-size: 16px;" type="text" name="username" value="<?php echo $_COOKIE['familink-username']; ?>" class="form_input required" placeholder="username" />
                </div>
                <div class="form_row">
                <div class="form_row_icon"><img src="images/icons/blue/lock.png" alt="" title="" /></div>
                <input style="font-size: 16px;" type="password" name="password" value="<?php echo $_COOKIE['familink-password']; ?>" class="form_input required" placeholder="password" />
                <br><br>
                </div>
                <div class="forgot_pass"><span style="float:left;"><input style="font-size: 16px;" type="checkbox" name="remember" value=""<?php if ($_COOKIE['familink-remember']) { echo "checked"; } ?>/>&nbsp;Save Login</span><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
                <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN IN" />

                </form>
                <div class="signup_bottom">
                <p>Don't have an account?</p>
                <a href="#" data-popup=".popup-signup" class="open-popup">CREATE A FAMILY</a>                </div>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Register Popup -->
    <div class="popup popup-signup">
    <div class="content-block-login">
      <h4>CREATE A FAMILY</h4>
      <div class="signup_bottom">
            <p>If your family already has a Familink account, please contact your Familink Admin for your login credentials.</p><br>
            </div>
            <div class="loginform">
            <form action="register.php" id="RegisterForm" method="post">
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/user.png" alt="" title="" /></div>
            <input style="font-size: 16px;" type="text" name="username" value="" class="form_input required" placeholder="username" />
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/contact.png" alt="" title="" /></div>
            <input style="font-size: 16px;" type="text" name="email" value="" class="form_input required" placeholder="email" />
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/lock.png" alt="" title="" /></div>
            <input style="font-size: 16px;" type="password" name="password" value="" class="form_input required" placeholder="password" />
            </div>
            <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN UP" />
            </form>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Login Popup -->
    <div class="popup popup-forgot">
    <div class="content-block-login">
      <h4>FORGOT PASSWORD</h4>
            <div class="loginform">
            <form id="ForgotForm" method="post">
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/contact.png" alt="" title="" /></div>
            <input style="font-size: 16px;" type="text" name="Email" value="" class="form_input required" placeholder="email" />
            </div>
            <input type="submit" name="submit" class="form_submit" id="submit" value="RESEND PASSWORD" />
            </form>
            <div class="signup_bottom">
            <p>For Familink Admin credentials, check your email and follow the instructions to reset your password. Otherwise, contact your family's Familink Admin to get your family's shared credentials.</p>
            </div>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/framework7.js"></script>
<script type="text/javascript" src="js/my-app-1.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script type="text/javascript" src="js/email.js"></script>
  </body>
</html>