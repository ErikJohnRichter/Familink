<?php
    require("common.php"); 
?>

     <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>

<div class="pages">
  <div data-page="features" class="page no-toolbar no-navbar">
    <div class="page-content">
    
     <div class="navbarpages">
       <div class="navbar_left">&nbsp;</div>
       <div class="navbar_center"><h2><a href="familink-secure.php">familink</a></h2></div>
       <div class="navbar_right"><a href="familink-secure.php"><img src="images/icons/blue/home.png" alt="" title="" /></a></div>
     </div>
     
     <div id="pages_maincontent">
      
      <h2 class="page_title">SEND EMAIL</h2>
      
      <div class="page_content">
      
      
               <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                    <td><h5 style="margin-bottom: 20px;">recipients</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="form-control button email select" id="sendToSelect" onChange='document.getElementById("sendEmailTo").value = document.getElementById("sendEmailTo").value + this.value + ";"' name="email-to" >
                  
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

                        echo '<option value="" selected="selected">Send Email To:</option>';

                        if ($rows) {
                            echo '<optgroup label="Family Units">';
                            echo '<option value="Whole Family">Whole Family</option>';
                            $count = 1;
                            foreach ($rows as $a) {
                            echo '<option value="'.$a['unit_name'].'">'.$a['unit_name'].'</option>';
                            $count++;
                            }
                            echo '</optgroup>';
                        }
                        else {
                            echo '<option>None added yet</option>';
                        }

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
                        if ($rows) {
                            echo '<optgroup label="Individual Members">';
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

                        ?>
                            </select>
                        </td>
                        <!--<td><button id="sendTo" type="submit" class="button">Add</button></td>-->
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>



                    



                <div id="emailForm" style="margin-top: 5px;">
                <form onsubmit="return validateEmailForm()" name="sendEmailForm" id="sendEmailForm" action="send-email.php" method="post">
                <table align="center" style="margin: 0 auto;">
                    
                    <thead><br><br>
                    <td><h5 style="margin-bottom: 20px;">email</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <label for="sendEmailTo" style="display: block;">To</label>
                            <textarea type="text" readonly style="padding-top: 4px; margin-top: 4px; " rows="2" class="form-control desktopInput2 desktopInput email validateEmail" id="sendEmailTo" name="send-email-to" placeholder="First select recipients above..."/></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <br>
                            <label for="emailSubject" style="display: block;">Subject</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; " rows="2" class="form-control desktopInput2 email validateEmail" id="emailSubject" name="email-subject" /></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <br>
                            <label for="emailBody" style="display: block;">Email Body</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px; "  class="form-control desktopInput2 email validateEmail" rows="10" id="emailBody" name="email-body" /></textarea>
                        </td>
                    </tr>
                    </tbody>
                    
                    
                </table>


                <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                        <br>
                    <td><h5 style="margin-bottom: 20px;">sent from</h5></td>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="button form-control validateEmail email select" id="sentFromSelect"  name="sent-from">
                  
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
                    <td><br><button id="sendEmail" type="submit" class="button" style="margin-top: 20px; width: 145px;">Send Email</button></td>

                    </tr>
                </table>
                    
                </form>

            </div> 

      
      
      </div>
      
     </div>
      
      
    </div>
  </div>
</div>