<?php
    require("common.php"); 

    $query = " 
            SELECT 
                * 
            FROM messages
            WHERE 
                family_id = :id
            ORDER BY timestamp desc
        "; 
         
        $query_params = array( 
            ':id' => $_SESSION['family_id'] 
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
         
        
?>

<div class="pages">
  <div data-page="blog" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">MESSAGE BOARD</h2>
      
       <div class="page_content"> 



        <div class="buttons-row">
                <a href="#tab1" class="tab-link active button">Messages</a>
                <a href="#tab2" class="tab-link button">Post a message</a>
          </div>


           <div class="tabs-animated-wrap">
                <div class="tabs">




      <div id="tab1" class="tab active" >
            <div class="blog-posts">
              <ul class="posts">
                <?php
                    $rowz = $stmt->fetchAll();
                    if ($rowz) {
                        foreach ($rowz as $y) {
                            // If load is slow delete here...
                            $query = " 
                              SELECT COUNT(timestamp) 
                              FROM familink.messages_replies 
                              WHERE family_id = :familyid
                              AND message_id = :messageid
                              AND timestamp 
                              BETWEEN DATE_SUB(NOW(), INTERVAL 24 HOUR) 
                              AND 
                              now();
                          "; 
                           
                          $query_params = array( 
                              ':familyid' => $_SESSION['family_id'],
                              ':messageid' =>$y['id']
                          ); 
                           
                          try 
                          { 
                              $result = $db->prepare($query); 
                              $result->execute($query_params); 
                              $replycount = $result->fetchColumn(0);
                          } 
                          catch(PDOException $ex) 
                          { 
                              die($ex); 
                          } 
                           // ...through here and reply count || in if below
                           echo '<li>'.
                    '<div class="post_entry" >'.

                        '<a href="message-single.php?id='.$y['id'].'">';
                        
                        if (($y['timestamp'] > date("Y-m-d H:i:s", strtotime('-26 hour'))) || $replycount > 0) {
                            echo '<div class="post_date" style="background-color:#fec763">';
                        }
                        else {
                            echo '<div class="post_date">';
                        }
                            //Is this correct? +2? Check 
                            echo '<span class="day" >'.date('j', strtotime($y['timestamp'])+ 1 * 3600).'</span>'.
                            '<span class="month">'.strtolower(date('M', strtotime($y['timestamp']))).'</span>'.

                        '</div>'.
                        '<div class="post_title">'.

                        '<h2>'.$y['title'].'<span style="font-size: 18px; font-style: italic">&nbsp;&nbsp;- '.$y['added_by_first'].' '.$y['added_by_last'].'</span></h2>'.
                        '</div></a>'.
                    '</div>'.
                '</li> ';
                        }
                        
                    }
                ?>
                
              </ul>

              
            <div class="clear"></div>  
            <div id="loadMore"><img src="images/load_posts.png" alt="" title="" style="max-width: 60px;"/></div> 
            <div id="showLess"><img src="images/load_posts_disabled.png" alt="" title="" style="max-width: 60px;"/></div>
            </div>
            <!--<hr>-->

        </div>
        <div id="tab2" class="tab">



            <div id="messageForm" style="margin-top: 5px;">
                <form onsubmit="return validateMessageForm()" name="postMessageForm" id="postMessageForm" action="post-message.php" method="post">
                <table align="center" style="margin: 0 auto;">
                    
                    <thead><br><br>
                    <td><h5 style="margin-bottom: 20px;">compose message</h5></td>
                    </thead>

                    <tbody>
                    
                    <tr>
                        <td text-align="center">
                            <br>
                            <label for="messageTitle" style="display: block;">Title</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " rows="2" class="form-control desktopInput2 email validateMessage" id="messageTitle" name="message-title" /></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <br>
                            <label for="messageBody" style="display: block;">Message</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " class="form-control desktopInput2 email validateMessage" rows="10" id="messageBody" name="message-body" /></textarea>
                        </td>
                    </tr>
                    </tbody>
                    
                    
                </table>


                <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                        <br>
                    <td><h5 style="margin-bottom: 20px;">added by</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="button form-control validateMessage email select" id="addedBySelect"  name="added-by">
                  
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
                            ':id' => $_SESSION['family_id'] 
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
                         
                        $rowz = $stmt->fetchAll();
                        echo '<option value="" selected="selected">Sent From:</option>';
                        if ($rowz) {
                            foreach ($rowz as $c) {
                            echo '<option value="'.$c['first_name'].' '.$c['last_name'].'">'.$c['first_name'].'&nbsp'.$c['last_name'].'</option>';
                            }
                            
                        }
                        else {
                            echo '<option>None added yet</option>';
                        }

                        ?>
                            </select>
                        </td>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                   
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                   
                </table>
                <table style="margin: 0 auto;">
                    <tr>
                    <td><br><button id="postMessage" type="submit" class="button" style="margin-top: 20px; width: 145px;">Post Message</button></td>

                    </tr>
                </table>
                    
                </form>

            </div> 


        </div>
    </div>
</div>


      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>