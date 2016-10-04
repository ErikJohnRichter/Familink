<?php
require("common.php"); 
//Include database connection here
$eventId = $_GET["id"]; 
// Run the Query
   $query = " 
            SELECT * FROM custom_events 
            WHERE 
                id = :eventid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':eventid' => $eventId,
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
  <div data-page="shopitem" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">  
      <div class="shop_header_title">
          
          <a href="events.php" class="backto" style="float: right; width: 130px;">BACK TO EVENTS</a>
      </div>
      
      <div class="page_content">
          <div class="shop_item_details" style="font-size: 18px;">
          <?php    
        
            if ($rows) {
                foreach ($rows as $x) {
                  $timestamp = strtotime($x['timestamp']);
                  $day = date('l', $timestamp);

                  echo '<h2 style="font-size: 20px;">'.strtoupper($x['event_name']).'</h2>';
                  echo $day.', '.$x['event_date_month'].' '.$x['event_date_day'].' at '.$x['event_time_start'].' '.$x['am_pm'];

                    echo '<br><br><strong>Location: </strong>'.$x['event_location'].'<br>';
                      echo '<strong>Created By: </strong>'.$x['added_by_first'].' '.$x['added_by_last'].'<br>';
                     echo '<strong>For: </strong>'.$x['for_family_unit'].'<br>';

                    echo '<br><strong>Details: </strong><br><br>'.$x['event_description'].'<br>';
                    
                    echo '<div style="float:right;">
           <form action="edit-event.php" method="post" style="display: inline-block;">
          <input type="hidden" name="event-id" value="'.$eventId.'" >
          <button type="submit" class="button" style="display: inline-block; width: 100px;">Edit Event</button>&nbsp;&nbsp;
          </form>
          <br><br>
        </div>';
        echo '<div class="clear"></div>'; 
                    echo '<hr>';
                    echo '<br>';
                    echo '<form action="rsvp.php" target="frame" method="post">';

                    echo '<table style="width: 100%;">';
                    echo '<thead><td align="center" style="margin: 0 auto;"><h2 style="font-size: 20px; margin-bottom: 5px;">Guest List</h2><td></thead>';
                    echo '<tbody>';
                    
                    echo '<tr><td><strong>Yes</strong></td></tr>';
                    $query = " 
                            SELECT 
                                * 
                            FROM event_rsvp
                            WHERE 
                                event_id = :eventid AND
                                family_id = :id
                        "; 
                         
                        $query_params = array( 
                            ':eventid' => $eventId,
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

                        if($rowz) {
                          foreach($rowz as $c) {
                            echo '<tr><td>'.$c['yes'].'</td></tr>';
                          }
                        }

                    echo '<tr><td>&nbsp;</td></tr>';
                    echo '<tr><td><strong>No</strong></td></tr>';
                    if($rowz) {
                          foreach($rowz as $d) {
                            echo '<tr><td>'.$d['no'].'</td></tr>';
                          }
                        }

                    echo '<tr><td>&nbsp;</td></tr>';
                    echo '<tr><td><strong>Maybe</strong></td></tr>';
                    if($rowz) {
                          foreach($rowz as $e) {
                            echo '<tr><td>'.$e['maybe'].'</td></tr>';
                          }
                        }
                    echo '<tr><td>&nbsp;</td></tr>';
                    echo '<tr align="center" style="margin: 0 auto;"><td>';
                    echo '<select class="form-control button email select" id="rsvpSelect" name="rsvp" style="width: 200px; margin-bottom: 5px;">';
                    
                    if ($x['for_family_unit'] == "Whole Family") {
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
                         
                        $rows = $stmt->fetchAll();
                    }

                    else {
                    $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id AND
                                family_unit_1 = :familyunit OR
                                family_unit_2 = :familyunit OR
                                family_unit_3 = :familyunit
                            ORDER BY first_name asc
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':familyunit' => $x['for_family_unit']
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
                      }
                        if ($rows) {
                            echo '<option value="" selected="selected">RSVP Member</option>';
                            $memberId = 0;
                            $count = 1;
                            foreach ($rows as $b) {
                            echo '<option value="'.$b['first_name'].' '.$b['last_name'].'">'.$b['first_name'].'&nbsp'.$b['last_name'].'</option>';
                            $count++;
                            }
                            echo '</optgroup>';
                            
                        }
                        else {
                            echo '<option>None added yet</option>';
                        }

                    echo '</select></td></tr>';

                    echo '<tr><td><input type="hidden" name="event-id" value="'.$eventId.'"></td></tr>';
                    echo '<tr align="center" style="margin: 0 auto;">';
                    echo '<td><button type="submit" onClick="window.location.reload()" id="rsvpYes" name="action" value="yes" class="button button-green" style="display: inline-block; width: 63px;">Yes</button>';
                    echo '&nbsp;<button type="submit" id="rsvpNo" name="action" value="no" class="button button-red" style="display: inline-block; width: 63px;">No</button>';
                    echo '&nbsp;<button type="submit" id="rsvpMaybe" name="action" value="maybe" class="button" style="display: inline-block; width: 65px;">Maybe</button></td>';
                    echo '</tr>';

                    echo '</tbody>';
                    echo '</table>';
                    echo '</form>';

                    
                }
                
            }
            else {
                echo '<h4>sorry!<br>there seems to be an error now!<br>try again in a bit!</h4>';
            }
           

 ?>     
          <br><hr>
          
          
          </div>

          
      </div>



      <div class="page_content" style="padding-top: 10px;"> 
          
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
                                        SELECT * FROM event_replies 
                                        WHERE 
                                            event_id = :eventid AND
                                            family_id = :familyid
                                            ORDER BY timestamp desc
                                        
                                    "; 
                                     
                                    $query_params = array( 
                                        ':eventid' => $eventId,
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
                            <form onsubmit="return validateReplyForm()" id="commentForm" method="post" action="post-event-comment.php">
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
                        echo '<option value="" selected="selected">Comment From:</option>';
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
                        <?php echo '<input type="hidden" name="event-id" value="'.$eventId.'">'; ?>
                    
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
                          
                            <input type="submit" name="submit" class="form_submit" id="submit" value="ADD COMMENT" />
                            </form>
                            </div>
                      </div>
                </div>
          
      
      
      
      </div>
      
      </div>
      
      
    </div>
  </div>
  <iframe name="frame" style="display:none;"></iframe>
</div>