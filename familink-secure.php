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
        $_SESSION['family_id'] = $row['family_id'];
        $_SESSION['is_admin'] = $row['is_admin'];
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
<!-- iPhone 6 -->
<link href="images/apple-touch-startup-image-640x1096.png" media="(device-width: 375px) and (device-height: 667px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
<title>Familink</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="css/framework7.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                    echo '<div class="item_thumb">None added yet</div>';
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

                      
                      <li>
                        <a href="#" class="close-panel"><img class="smallimg" src="images/icons/white/back.png" alt="" title="" style="max-width: 50px;"/><span style="color:white;">CLOSE PROFILE</span></a>
                      </li>
                      <?php 
                        if ($_SESSION['is_admin'] == 1) {
                      echo '<li><a href="edit-account.php" class="close-panel"><img class="smallimg" src="images/icons/blue/settings.png" alt="" title="" / style="max-width: 50px;"><span style="color:white;">EDIT ACCOUNT</span></a></li>';
                      }
                      ?>
                    </ul>
                  </nav>
                  <span style="float: right; padding-right: 8%;"><br><br><br><br><br><br><a href="mailto:helloworld@codingerik.com" class="external" style="color: white;">Report a bug</a><br><br></span>
          </div>

    </div>

    <div class="views">

      <div class="view view-main">

        <div class="pages">

          <div data-page="index" class="page homepage">
            <div class="page-content">
              <div class="container"></div>
                    <div class="logo" style="transform: translateZ(0); padding-top: 5px;"><h1>familink</h1><span><?php echo strtoupper('The '.$row['family_name'].' Family'); ?></span></div>
                       <nav class="main-nav">
                        <ul>
                          <li><a href="#" data-panel="left" class="open-panel"><img src="images/icons/white/users.png" alt="" title="" /><span>MEMBERS</span></a></li>
                          <li><a href="email-members.php"><img src="images/icons/white/contact.png" alt="" title="" /><span>SEND EMAIL</span></a></li>
                          <li><a href="events.php"><img src="images/icons/white/blog.png" alt="" title="" /><span>EVENTS</span></a></li>
                          
                          <li><a href="forum.php"><img src="images/icons/white/form.png" alt="" title="" /><span>FORUM</span>
                            <?php

                            $query = " 
                              SELECT COUNT(timestamp) 
                              FROM familink.messages 
                              WHERE family_id = :familyid
                              AND timestamp 
                              BETWEEN DATE_SUB(NOW(), INTERVAL 24 HOUR) 
                              AND 
                              now();
                          "; 
                           
                          $query_params = array( 
                              ':familyid' => $_SESSION['family_id'] 
                          ); 
                           
                          try 
                          { 
                              $result = $db->prepare($query); 
                              $result->execute($query_params); 
                              $count1 = $result->fetchColumn(0);
                          } 
                          catch(PDOException $ex) 
                          { 
                              die($ex); 
                          } 

                          $query = " 
                              SELECT COUNT(timestamp) 
                              FROM familink.messages_replies 
                              WHERE family_id = :familyid
                              AND timestamp 
                              BETWEEN DATE_SUB(NOW(), INTERVAL 24 HOUR) 
                              AND 
                              now();
                          "; 
                           
                          $query_params = array( 
                              ':familyid' => $_SESSION['family_id'] 
                          ); 
                           
                          try 
                          { 
                              $result = $db->prepare($query); 
                              $result->execute($query_params); 
                              $count2 = $result->fetchColumn(0);
                          } 
                          catch(PDOException $ex) 
                          { 
                              die($ex); 
                          } 
                           
                          $count = $count1+$count2;
                          
                            if ($count > 0) {
                                echo '<div class="cartitems"><span style="font-size: 14px; padding-top:1px">'.$count.'</span></div>';
                            }
                          
                          ?>

                          </a></li>
                          <li><a href="help.php"><img src="images/icons/white/question.png" alt="" title="" /><span>HELP</span></a></li>
                          
                          <li><a href="#" data-panel="right" class="open-panel"><img src="images/icons/white/user.png" alt="" title="" /><span>ACCOUNT</span></a></li>
                          <?php
                          if ($_SESSION['is_admin'] == 1) {
                            echo '<li><a href="admin-settings.php"><img src="images/icons/white/settings.png" alt="" title="" /><span>ADD/DELETE</span>';
                            if (!$rows) {
                                echo '<div class="cartitems"><i class="material-icons" style="padding-top:3px;">group_add</i></div>';
                            }
                            echo '</a></li>';
                          }
                          ?>
                        </ul>
                      </nav> 
                    </div>
                    
          </div>
        </div>
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