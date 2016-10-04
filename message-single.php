<?php
require("common.php"); 
//Include database connection here
$messageId = $_GET["id"]; 
// Run the Query
   $query = " 
            SELECT * FROM messages 
            WHERE 
                id = :messageid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':messageid' => $messageId,
            ':familyid' => $_SESSION['family_id']
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
?>

<div class="pages">
  <div data-page="blogsingle" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>

     <div id="pages_maincontent">
     
     <a href="forum.php" class="backto"><img src="images/icons/blue/back.png" alt="" title="" style="max-width: 50px;"/></a>
     
     
     <?php    
        
            if ($rows) {
                foreach ($rows as $x) {
                    echo '<h2 class="post_title_single">'.$x['title'].'</h2>';
                  }
                }
                ?>
      
        
            <div class="page_content">

              <?php    
        
            if ($rows) {
                foreach ($rows as $x) {
                    echo date("F j, Y, g:i a", strtotime($x['timestamp']) + 2 * 3600).' - by <strong>'.$x['added_by_first'].' '.$x['added_by_last'].'</strong>';
                  }
                }
                ?>
            
              
              <div class="entry" style="font-size: 18px;">
              <?php    
        
            if ($rows) {
                foreach ($rows as $x) {

              echo $x['message'];
              }
            }
            ?>
              </div>
              
                <div class="post_details">  
                    <div class="clear"></div>
                </div>
            
              
            </div>

          <div class="page_content"> 
          
          <div class="buttons-row">
                <a href="#tab3" class="tab-link active button">Comments</a>
                <a href="#tab4" class="tab-link button">Leave a comment</a>
          </div>
          
          <div class="tabs-animated-wrap">
                <div class="tabs">
                      

                    
                      <div id="tab3" class="tab active" >
                            <ul class="comments">
                              <?php    
                              $query = " 
                                        SELECT * FROM messages_replies 
                                        WHERE 
                                            message_id = :messageid AND
                                            family_id = :familyid
                                            ORDER BY timestamp desc
                                        
                                    "; 
                                     
                                    $query_params = array( 
                                        ':messageid' => $messageId,
                                        ':familyid' => $_SESSION['family_id']
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

                                    $replyrows = $stmt->fetchAll();
                    
                                  if ($replyrows) {
                                      foreach ($replyrows as $r) {
                                echo '<li class="comment_row">'.
                                    '<div class="comm_avatar"><img src="images/icons/blue/user.png" alt="" title="" border="0" /></div>'.
                                    '<div class="comm_content"><p>'.$r['reply'].
                                    '<br /><br />'.date("M j, Y, g:i a", strtotime($r['timestamp'])+ 2 * 3600).'<br />by <strong>'.$r['replied_by_first'].' '.$r['replied_by_last'].'</strong></p></div>'.
                                '</li>';
                              }

                            }
                            else {
                                echo '<p>There are no comments to this post</p>';
                              }
                            ?>
                                <div class="clear"></div>
                            </ul>
                      </div> 
                      <div id="tab4" class="tab">
                            <div class="commentform">
                            <form onsubmit="return validateReplyForm()" id="commentForm" method="post" action="post-reply.php">
                            <div class="form_row">
                             <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                    <td><h5 style="margin-bottom: 20px;">added by</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="button form-control validateReply email select" id="repliedBySelect"  name="replied-by">
                  
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
                    </tr>
                        <?php echo '<input type="hidden" name="message-id" value="'.$messageId.'">'; ?>
                    
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                   
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                   <tr>
                    <td>
                            <br>
                            <label for="replyBody" style="display: block;">comment</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; "  class="form-control desktopInput2 email validateReply" rows="10" id="replyBody" name="reply-body" /></textarea>
                        </td>
                   </tr>
                </table>
                <br>
                            </div>
                          
                            <input type="submit" name="submit" class="form_submit" id="submit" value="REPLY" />
                            </form>
                            </div>
                      </div>
                </div>
          </div>
      
         </div>
         
         
    </div>
  </div>
</div>