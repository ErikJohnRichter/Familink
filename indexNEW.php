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
<link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
<link rel="apple-touch-startup-image" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" href="images/apple-touch-startup-image-640x1096.png">
<title>familink</title>
<link rel="stylesheet" href="css/framework7.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/blue.css">
<link type="text/css" rel="stylesheet" href="css/swipebox.css" />
<link type="text/css" rel="stylesheet" href="css/animations.css" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
</head>
<body id="mobile_wrap">

    <div class="statusbar-overlay"></div>

    <div class="panel-overlay"></div>

    <div class="panel panel-left panel-reveal">
        <div class="cartcontainer">
            <h2>FAMILY MEMBERS</h2>
            <a href="#" class="closecart close-panel"><img src="images/icons/white/menu_close.png" alt="" title="" style="max-width: 40px;"/></a>
            
                    <form id="myform" method="POST" action="#">
            <?php

                $query = " 
                    SELECT 
                        * 
                    FROM family_member
                    WHERE 
                        family_id = :id
                    ORDER BY first_name asc
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
                 
                $rows = $stmt->fetchAll();
                if ($rows) {
                    $memberId = 0;
                    $count = 1;
                    foreach ($rows as $x) {
                    echo '<div class="item_thumb"><a href="member-details.php?id='.$x['id'].'" class="close-panel" style="font-size: 24px; color: white;">'.$x['first_name'].'&nbsp'.$x['last_name'].'</a><hr style="height: 1px; border: 0; border-top: 1px solid grey;"></div>';
                    $count++;
                    }
                    
                }
                else {
                    echo 'None added yet</option>';
                }

                ?>


                    </form>
            
        </div>
    </div>

    <div class="panel panel-right panel-reveal"> 
          <div class="user_login_info">
                <div class="user_thumb">

                <img src="images/profile.jpg" alt="" title="" />

                  <div class="user_details">

                   <p>Hey, <span><?php echo $row['family_name']; ?> Family!
                    <?php
                    if ($_SESSION['is_admin'] == 1) {
                      echo '- <span style="display:inline-block; color:red;">ADMIN</span>';

                    }
                    ?>
                   </span></p>
                  </div>  
                </div>

                  <nav class="user-nav">
                    <ul>
                        
                      
                      <li>
                        <a href="site-documentation.php" class="close-panel"><img class="smallimg" src="images/icons/blue/briefcase.png" alt="" title="" style="max-width: 50px;"/><span style="color:white;">DOCUMENTATION</span></a>
                      </li>

                      <li>
                        <form id="logout" action="logout.php">
                        <a href="#" onclick="document.getElementById('logout').submit()"><img class="smallimg" src="images/icons/blue/logout.png" alt="" title="" style="max-width: 50px;"/><span style="color:white;">LOGOUT</span></a>
                        </form>
                      </li>

                      <?php 
                        if ($_SESSION['is_admin'] == 1) {
                      echo '<li><a href="edit-account.php" class="close-panel"><img class="smallimg" src="images/icons/blue/settings.png" alt="" title="" / style="max-width: 50px;"><span style="color:white;">EDIT ACCOUNT</span></a></li>';
                      }
                      ?>
                    </ul>
                  </nav>
          </div>
          <a href="#" class="closeprofile close-panel"><img src="images/icons/white/back.png" alt="" title="" style="max-width: 50px;"/></a>

    </div>

    <div class="views">

      <div class="view view-main">

        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content">
                    <div class="logo"><h1>familink</h1><span><?php echo strtoupper('The '.$row['family_name'].' Family'); ?></span></div>
                       <nav class="main-nav">
                        <ul>
                          <!--<li><a href="#" data-popup=".popup-login" class="open-popup"><img src="images/icons/white/user.png" alt="" title="" /><span>LOGIN</span></a></li>
                          <li><a href="features.php"><img src="images/icons/white/settings.png" alt="" title="" /><span>SETTINGS</span></a></li>-->
                          <li><a href="#" data-panel="left" class="open-panel"><img src="images/icons/white/users.png" alt="" title="" /><span>MEMBERS</span></a></li>
                          <li><a href="email-members.php"><img src="images/icons/white/contact.png" alt="" title="" /><span>SEND EMAIL</span></a></li>
                          <li><a href="help.php"><img src="images/icons/white/question.png" alt="" title="" /><span>HELP</span></a></li>
                          <li><a href="calendar.php"><img src="images/icons/white/blog.png" alt="" title="" /><span>CALENDAR</span></a></li>
                          <li><a href="forum.php"><img src="images/icons/white/form.png" alt="" title="" /><span>FORUM</span></a></li>
                          <li><a href="#" data-panel="right" class="open-panel"><img src="images/icons/white/user.png" alt="" title="" /><span>ACCOUNT</span></a></li>
                          <?php
                          if ($_SESSION['is_admin'] == 1) {
                            echo '<li><a href="admin-settings.php"><img src="images/icons/white/settings.png" alt="" title="" /><span>ADMIN</span></a></li>';
                          }
                          ?>
                          <!--<li><a href="tel:1234 5678" class="external"><img src="images/icons/white/phone.png" alt="" title="" /><span>CALL US</span></a></li>
                          <li><a href="contact.html"><img src="images/icons/white/contact.png" alt="" title="" /><span>MESSAGE</span></a></li>-->
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
                <form id="LoginForm" method="post">
                <div class="form_row">
                <div class="form_row_icon"><img src="images/icons/blue/user.png" alt="" title="" /></div>
                <input type="text" name="Username" value="" class="form_input required" placeholder="username" />
                </div>
                <div class="form_row">
                <div class="form_row_icon"><img src="images/icons/blue/lock.png" alt="" title="" /></div>
                <input type="password" name="Password" value="" class="form_input required" placeholder="password" />
                </div>
                <div class="forgot_pass"><a href="#" data-popup=".popup-forgot" class="open-popup">Forgot Password?</a></div>
                <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN IN" />
                </form>
                <div class="signup_social">
                <a href="http://www.facebook.com/" class="signup_facebook external">FACEBOOK</a>
                <a href="http://www.twitter.com/" class="signup_twitter external">TWITTER</a>                </div>
                <div class="signup_bottom">
                <p>Don't have an account?</p>
                <a href="#" data-popup=".popup-signup" class="open-popup">SIGN UP</a>                </div>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Register Popup -->
    <div class="popup popup-signup">
    <div class="content-block-login">
      <h4>REGISTER</h4>
            <div class="loginform">
            <form id="RegisterForm" method="post">
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/user.png" alt="" title="" /></div>
            <input type="text" name="Username" value="" class="form_input required" placeholder="username" />
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/contact.png" alt="" title="" /></div>
            <input type="text" name="Email" value="" class="form_input required" placeholder="email" />
            </div>
            <div class="form_row">
            <div class="form_row_icon"><img src="images/icons/blue/lock.png" alt="" title="" /></div>
            <input type="password" name="Password" value="" class="form_input required" placeholder="password" />
            </div>
            <input type="submit" name="submit" class="form_submit" id="submit" value="SIGN UP" />
            </form>
            <div class="signup_social">
            <a href="http://www.facebook.com/" class="signup_facebook external">FACEBOOK</a>
            <a href="http://www.twitter.com/" class="signup_twitter external">TWITTER</a>            </div>
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
            <input type="text" name="Email" value="" class="form_input required" placeholder="email" />
            </div>
            <input type="submit" name="submit" class="form_submit" id="submit" value="RESEND PASSWORD" />
            </form>
            <div class="signup_bottom">
            <p>Check your email and follow the instructions to reset your password.</p>
            </div>
            </div>
      <div class="close_loginpopup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    
    <!-- Social Popup -->
    <div class="popup popup-social">
    <div class="content-block">
      <h4>FOLLOW US</h4>
      <p>Social icons solution that allows you share and increase your social popularity.</p>
      <ul class="popup_categories">
      <li><a href="http://twitter.com/" class="external"><img src="images/icons/blue/twitter.png" alt="" title="" /><span>TWITTER</span></a></li>
      <li><a href="http://www.facebook.com/" class="external"><img src="images/icons/blue/facebook.png" alt="" title="" /><span>FACEBOOK</span></a></li>
      <li><a href="http://plus.google.com" class="external"><img src="images/icons/blue/gplus.png" alt="" title="" /><span>GOOGLE</span></a></li>
      <li><a href="http://www.dribbble.com/" class="external"><img src="images/icons/blue/dribbble.png" alt="" title="" /><span>DRIBBBLE</span></a></li>
      <li><a href="http://www.linkedin.com/" class="external"><img src="images/icons/blue/linkedin.png" alt="" title="" /><span>LINKEDIN</span></a></li>
      <li><a href="http://www.pinterest.com/" class="external"><img src="images/icons/blue/pinterest.png" alt="" title="" /><span>PINTEREST</span></a></li>
      </ul>
      <div class="close_popup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    
    <!-- Shop Categories Popup -->
    <div class="popup popup-shopcategories">
    <div class="content-block">
      <h4>SHOP CATEGORIES</h4>
      <ul class="popup_categories">
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/bike.png" alt="" title="" /><span>BIKES</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/car.png" alt="" title="" /><span>CARS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/rocket.png" alt="" title="" /><span>ROCKETS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/orders.png" alt="" title="" /><span>T-SHIRTS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/food.png" alt="" title="" /><span>FOOD</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/drink.png" alt="" title="" /><span>DRINKS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/photos.png" alt="" title="" /><span>PHOTOS</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/bus.png" alt="" title="" /><span>BUSES</span></a></li>
      <li><a href="shop-page2.html" class="close-popup"><img src="images/icons/blue/electronics.png" alt="" title="" /><span>ELECTRONICS</span></a></li>
      </ul>
      <div class="close_popup_button"><a href="#" class="close-popup"><img src="images/icons/white/menu_close.png" alt="" title="" /></a></div>
    </div>
    </div>
    

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/framework7.js"></script>
<script type="text/javascript" src="js/my-app.js"></script>
<script type="text/javascript" src="js/jquery.swipebox.js"></script>
<script type="text/javascript" src="js/email.js"></script>
  </body>
</html>