<?php
    require("common.php"); 
?>

<div class="pages">
  <div data-page="features" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">UPCOMING EVENTS</h2>
      
      <div class="page_content">
      



<div class="buttons-row">
                <a href="#tab5" class="tab-link active button">Events</a>
                <a href="#tab6" class="tab-link button">Create an event</a>
          </div>


           <div class="tabs-animated-wrap">
                <div class="tabs">



      
      <div id="tab5" class="tab active">
      <?php
      
      //$thisMonth = "January";
      $thisMonth = date("F");
      // THIS WAS +2 rather than -5 10/17
      $today = date('d', strtotime("-6 hours"));
      $nextMonth = date('F', strtotime("+30 days"));
      $year = date("Y");
      $future = date("Y-m-d", strtotime("+60 days"));
      $now = date("Y-m-d", strtotime("-6 hours"));
                        




                    $query = " 
                            SELECT 
                                * 
                            FROM custom_events
                            WHERE 
                                family_id = :id AND
                                
                                 timestamp BETWEEN :now AND :future
                                ORDER BY timestamp asc
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':now' => $now,
                            ':future' => $future
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
                        echo '<table style="margin:0 auto; font-size: 20px; text-align: left">';
                        echo '<tr><th colspan="2" align="center"><h2 style="font-size: 20px; padding-top: 20px; padding-bottom: 20px;">FAMILY EVENTS</h2></th></tr>';
                        
                        $rows = $stmt->fetchAll();
                        if ($rows) {
                            foreach ($rows as $x) {

                                echo '<tr>';

                                
                                
                                if ($today == $x['event_date_day'] and $thisMonth == $x['event_date_month']) {
                                echo '<td style="padding: 10px; text-align: left; vertical-align: middle;">TODAY!</td>';
                                }
                                else {
                                //echo '<td style="padding: 10px; text-align: left">'.$x['event_date_month'].' '.$x['event_date_day'].'</td></tr>';
                                
                                echo '<td style="vertical-align: middle; padding-bottom: 5px; padding-right: 19px;"><div class="post_date" style="left: 20px; height: 25px; width: 50px; ">'.
                                      '<span class="day" style="font-size: 20px; line-height: 6px;">'.date('j', strtotime($x['timestamp'])+ 1 * 3600).'</span>'.
                                       '<span class="month" style="line-height: 35px;">'.strtolower(date('M', strtotime($x['timestamp']))).'</span>'.
                                       '</div></td>';
                                }
                                
                                echo '<td style="padding: 10px; text-align: left;"><a href="event-details.php?id='.$x['id'].'" style="color: blue;">'.$x['event_name'].'</a></td>';
                                
                                

                                echo '</tr>';
                                
                              }
                            
                        }
                        else {
                            echo '<tr><td style="padding: 10px; text-align: left">None!</td>';
                             echo '<td style="padding: 10px; text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
                        }

                        

                        


                        echo'<tr><td><br><hr></td><td><br><hr></td></tr>';









                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id AND
                                dob LIKE :thismonth AND
                                dob_day >= :today
                                ORDER BY dob_day asc
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':thismonth' => $thisMonth.'%',
                            ':today' => $today
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
                        echo '<tr><th colspan="2" align="center"><h2 style="font-size: 20px; padding-top: 20px; padding-bottom: 20px;">BIRTHDAYS</h2></th></tr>';
                        
                        $rows = $stmt->fetchAll();
                        if ($rows) {
                          //echo '<tr><td><h2 style="font-size: 20px;padding-bottom: 10px;">'.$thisMonth.'</h2></td></tr>';
                            foreach ($rows as $x) {
                              if (strpos($x['dob'], $thisMonth) !== false) {
                                
                                if ($today == $x['dob_day']) {
                                echo '<tr>';
                                
                                echo '<td><h2 style="padding: 10px; text-align: left">TODAY!</h2>';
                                
                                echo '</td>';
                                echo '<td style="padding: 10px; text-align: left">'.$x['first_name'].' '.$x['last_name'];

                                if ($x['dob_year'] != null) {
                                      $birthmonth = date('m', strtotime($x['dob_month']));
                                      $birthday = ($x['dob_year']).'-'.$birthmonth.'-'.$x['dob_day'];
                                      $date1 = date("Y-m-d", strtotime($birthday));
                                      $date2 = date("Y-m-d");

                                      $datetime1 = date_create($date1);
                                      $datetime2 = date_create($date2);
                                      $interval = date_diff($datetime1, $datetime2);
                                      $howOld = $interval->format('%y');
                                      echo ' - <i>'.$howOld.'</i>';
                                  }

                                if ($x['mobile_phone'] != null) {
                              echo '&nbsp;&nbsp;<a href="tel:'.$x['mobile_phone'].'" class="external"><img src="images/icons/blue/phone.png" alt="" title="" style="display: inline-block; margin-bottom: -5px; width: 30px;"/></a>';
                            }
                            else if ($x['home_phone'] != null) {
                              echo '&nbsp;&nbsp;<a href="tel:'.$x['home_phone'].'" class="external" ><img src="images/icons/blue/phone.png" alt="" title="" style="display: inline-block; margin-bottom: 0px; width: 20px;"/></a>';
                            }
                                echo '</td>';
                                echo '</tr>';
                                }
                                else {
                                echo '<tr>';
                                
                                echo '<td style="vertical-align: middle; padding-bottom: 5px;"><div class="post_date" style="left: 20px; height: 25px; width: 50px; ">'.
                                      '<span class="day" style="font-size: 20px; line-height: 6px;">'.$x['dob_day'].'</span>'.
                                       '<span class="month" style="line-height: 35px;">'.strtolower(substr($x['dob_month'], 0, 3)).'</span>'.
                                       '</div>';

                                //echo '<td style="padding: 10px; text-align: left">'.$x['dob'];
                                
                                echo '</td>';
                                echo '<td style="padding: 10px; text-align: left">'.$x['first_name'].' '.$x['last_name'];
                                if ($x['dob_year'] != null) {
                                      $birthmonth = date('m', strtotime($x['dob_month']));
                                      $birthday = ($x['dob_year']-1).'-'.$birthmonth.'-'.$x['dob_day'];
                                      $date1 = date("Y-m-d", strtotime($birthday));
                                      $date2 = date("Y-m-d");

                                      $datetime1 = date_create($date1);
                                      $datetime2 = date_create($date2);
                                      $interval = date_diff($datetime1, $datetime2);
                                      $howOld = $interval->format('%y');
                                      echo ' - <i>'.$howOld.'</i>';
                                }
                                echo '</td>';
                                echo '</tr>';
                                }
                                
                              }
                            }
                            
                        }
                        /*else {
                          echo '<tr><td><h2 style="font-size: 20px;padding-bottom: 10px;">'.$thisMonth.'</h2></tr></td>';
                            echo '<tr><td style="padding: 10px; text-align: left">No more!</td>';
                             echo '<td style="padding: 10px; text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
                        }*/

                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id AND
                                dob LIKE :nextmonth
                                ORDER BY dob_day asc
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':nextmonth' => $nextMonth.'%'
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
                        if ($rowz) {
                          //echo '<tr><td><h2 style="font-size: 20px; padding-bottom: 10px; padding-top: 20px;">'.$nextMonth.'</h2></td></tr>';
                            foreach ($rowz as $y) {
                              if (strpos($y['dob'], $nextMonth) !== false) {
                                
                                echo '<tr>';
                                
                                echo '<td style="vertical-align: middle; padding-bottom: 5px;"><div class="post_date" style="left: 20px; height: 25px; width: 50px; ">'.
                                      '<span class="day" style="font-size: 20px; line-height: 6px;">'.$y['dob_day'].'</span>'.
                                       '<span class="month" style="line-height: 35px;">'.strtolower(substr($y['dob_month'], 0, 3)).'</span>'.
                                       '</div>';

                                //echo '<td style="padding: 10px; text-align: left">'.$y['dob'];
                                
                                echo '</td>';
                                echo '<td style="padding: 10px; text-align: left">'.$y['first_name'].' '.$y['last_name'];
                                if ($y['dob_year'] != null) {
                                      $birthmonth2 = date('m', strtotime($y['dob_month']));
                                      $birthday2 = ($y['dob_year']-1).'-'.$birthmonth2.'-'.$y['dob_day'];
                                      $date3 = date("Y-m-d", strtotime($birthday2));
                                      $date4 = date("Y-m-d");

                                      $datetime3 = date_create($date3);
                                      $datetime4 = date_create($date4);
                                      $interval2 = date_diff($datetime3, $datetime4);
                                      $howMany = $interval2->format('%y');
                                      echo ' - <i>'.$howMany.'</i>';
                                }
                                echo '</td>';
                                echo '</tr>';
                              }
                            }
                            
                        }
                        /*else {
                          echo '<tr><td><h2 style="font-size: 20px; padding-bottom: 10px; padding-top: 20px;">'.$nextMonth.'</h2></td></tr>';
                            echo '<tr><td style="padding: 10px; text-align: left">No birthdays</td>';
                            echo '<td style="padding: 10px; text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
                        }*/

                        ?>


                        <tr><td><br><hr></td><td><br><hr></td></tr>
                        <tr><th colspan="2" align="center"><h2 style="font-size: 20px; padding-top: 40px; padding-bottom: 20px;">ANNIVERSARIES</h2></th></tr>
      
      <?php
      

                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id AND
                                anniversary LIKE :thismonth AND
                                anniversary_day >= :today
                                ORDER BY anniversary_day asc
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':thismonth' => $thisMonth.'%',
                            ':today' => $today
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
                          //echo '<tr><td><h2 style="font-size: 20px;padding-bottom: 10px;">'.$thisMonth.'</h2></td></tr>';
                            foreach ($rows as $x) {
                              if (strpos($x['anniversary'], $thisMonth) !== false) {
                                if ($x['anniversary_day'] >= $today) {
                                    if ($today == $x['anniversary_day']) {
                                    echo '<tr>';
                                    
                                    echo '<td><h2 style="padding: 10px; text-align: left">TODAY!</h2></td>';
                                    echo '<td style="padding: 10px; text-align: left">'.$x['first_name'].' '.$x['last_name'].'</td>';
                                    echo '</tr>';
                                    }
                                    else {
                                    echo '<tr>';
                                    
                                    echo '<td style="vertical-align: middle; padding-bottom: 5px;"><div class="post_date" style="left: 20px; height: 25px; width: 50px; ">'.
                                      '<span class="day" style="font-size: 20px; line-height: 6px;">'.$x['anniversary_day'].'</span>'.
                                       '<span class="month" style="line-height: 35px;">'.strtolower(substr($x['anniversary_month'], 0, 3)).'</span>'.
                                       '</div></td>';

                                    //echo '<td style="padding: 10px; text-align: left">'.$x['anniversary'].'</td>';
                                    echo '<td style="padding: 10px; text-align: left">'.$x['first_name'].' '.$x['last_name'].'</td>';
                                    echo '</tr>';
                                    }
                                }
                              }
                            }
                            
                        }
                        /*else {
                          echo '<tr><td><h2 style="font-size: 20px;padding-bottom: 10px;">'.$thisMonth.'</h2></td></tr>';
                            echo '<tr><td style="padding: 10px; text-align: left">None</td>';
                            echo '<td style="padding: 10px; text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
                        }*/

                        $query = " 
                            SELECT 
                                * 
                            FROM family_member
                            WHERE 
                                family_id = :id AND
                                anniversary LIKE :nextmonth
                                ORDER BY anniversary_day asc
                            
                        "; 
                         
                        $query_params = array( 
                            ':id' => $_SESSION['family_id'],
                            ':nextmonth' => $nextMonth.'%'
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
                        if ($rowz) {
                          //echo '<tr><td><h2 style="font-size: 20px; padding-bottom: 10px; padding-top: 20px;">'.$nextMonth.'</h2></td></tr>';
                            foreach ($rowz as $y) {
                              if (strpos($y['anniversary'], $nextMonth) !== false) {
                                
                                echo '<tr>';
                                
                                echo '<td style="vertical-align: middle; padding-bottom: 5px;"><div class="post_date" style="left: 20px; height: 25px; width: 50px; ">'.
                                      '<span class="day" style="font-size: 20px; line-height: 6px;">'.$y['anniversary_day'].'</span>'.
                                       '<span class="month" style="line-height: 35px;">'.strtolower(substr($y['anniversary_month'], 0, 3)).'</span>'.
                                       '</div></td>';
                                //echo '<td style="padding: 10px; text-align: left">'.$y['anniversary'].'</td>';
                                echo '<td style="padding: 10px; text-align: left">'.$y['first_name'].' '.$y['last_name'].'</td>';
                                echo '</tr>';
                              }
                            }
                            
                        }
                        else {
                          echo '<tr><td><h2 style="font-size: 20px; padding-bottom: 10px; padding-top: 20px;">'.$nextMonth.'</h2></td></tr>';
                            echo '<tr><td style="padding: 10px; text-align: left">None</td>';
                            echo '<td style="padding: 10px; text-align: left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>';
                        
                        }
                        echo '</table>';

                        ?>

                    </div>





<div id="tab6" class="tab">
                    <div id="eventForm" style="margin-top: 5px;">
                <form onsubmit="return validateEventForm()" name="postEventForm" id="postEventForm" action="post-event.php" method="post">
                <table align="center" style="margin: 0 auto;">
                    

                    <tbody>

                      <tr>
                        <td text-align="center">
                            <br>
                            <label for="eventLocation" style="display: block;">Event Date</label>
                            <input type="text" style="padding-top: 4px; margin-top: 4px; height: 35px;" class="form-control desktopInput2 email validateEvent date" id="datepicker" name="datepicker" /></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    
                    <tr>
                        <td text-align="center">
                            <br>
                            <label for="eventTitle" style="display: block;">Event Name</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " rows="2" class="form-control desktopInput2 email validateEvent" id="eventTitle" name="event-title" /></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <br>
                            <label for="eventLocation" style="display: block;">Event Location</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " rows="2" class="form-control desktopInput2 email validateEvent" id="eventLocation" name="event-location" /></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>

                    

                    
                    <tr>
                        <td text-align="center">
                            <br>
                            <select class="form-control button select validateEvent" id="eventTime" style="display: inline-block; width: 90px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="event-time">
                            <option value="" selected="selected">Time</option>
                                    <optgroup label="AM">
                                    <option value="7:00 AM">7:00</option>       
                                    <option value="7:30 AM">7:30</option>       
                                    <option value="8:00 AM">8:00</option>       
                                    <option value="8:30 AM">8:30</option>       
                                    <option value="9:00 AM">9:00</option>       
                                    <option value="9:30 AM">9:30</option>       
                                    <option value="10:00 AM">10:00</option>       
                                    <option value="10:30 AM">10:30</option>       
                                    <option value="11:00 AM">11:00</option>       
                                    <option value="11:30 AM">11:30</option>
                                    </optgroup>       
                                    <optgroup label="PM">
                                    <option value="12:00 PM">12:00</option>       
                                    <option value="12:30 PM">12:30</option>       
                                    <option value="1:00 PM">1:00</option>       
                                    <option value="1:30 PM">1:30</option>       
                                    <option value="2:00 PM">2:00</option>       
                                    <option value="2:30 PM">2:30</option>       
                                    <option value="3:00 PM">3:00</option>       
                                    <option value="3:30 PM">3:30</option>       
                                    <option value="4:00 PM">4:00</option>       
                                    <option value="4:30 PM">4:30</option>       
                                    <option value="5:00 PM">5:00</option>       
                                    <option value="5:30 PM">5:30</option>       
                                    <option value="6:00 PM">6:00</option>       
                                    <option value="6:30 PM">6:30</option>       
                                    <option value="7:00 PM">7:00</option>
                                    <option value="7:30 PM">7:30</option>       
                                    <option value="8:00 PM">8:00</option>       
                                    <option value="8:30 PM">8:30</option>       
                                    <option value="9:00 PM">9:00</option>  
                                    </optgroup>     

                            </select>
                        </td>
                    </tr>


                    <tr> 
                        <td>
                            <br>
                            <label for="eventBody" style="display: block;">Description</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " class="form-control desktopInput2 email validateEvent" rows="10" id="eventBody" name="event-body" /></textarea>
                        </td>
                    </tr>
                    </tbody>
                    
                    
                </table>


                <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                        <br>
                    <td><h5 style="margin-bottom: 20px;">for</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                    <td text-align="center">
                            <select class="form-control button email select validateEvent" id="eventFor" name="event-for" >
                  
                        <?php

                        $query = " 
                            SELECT 
                                * 
                            FROM family_unit
                            WHERE 
                                family_id = :id 
                            ORDER BY unit_name asc;
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

                        echo '<option value="" selected="selected">Event For:</option>';

                        if ($rows) {
                            echo '<option value="Whole Family">Whole Family</option>';
                            $count = 1;
                            foreach ($rows as $a) {
                            echo '<option value="'.$a['unit_name'].'">'.$a['unit_name'].'</option>';
                            $count++;
                            }
                        }
                        else {
                            echo '<option>None added yet</option>';
                        }

                        
                        ?>
                            </select>
                        </td>

                    </tr>
                    
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                   
                   
                </table>


                <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                        <br>
                    <td><h5 style="margin-bottom: 20px;">added by</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="button form-control validateEvent email select" id="addedBySelect"  name="added-by">
                  
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
                        echo '<option value="" selected="selected">Added By:</option>';
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
                    <td><br><button id="postEvent" type="submit" class="button" style="margin-top: 20px; width: 145px;">Add Event</button></td>

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