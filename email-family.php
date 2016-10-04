<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseThree">
        <h3 class="panel-title">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
              Send Email
            </a>
        </h3>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
        <div class="panel-body text-center">

             <div class="form-group" id="emailToForm" style="margin-top: 5px;">

                
                <form action="" method="post">
                <table align="center">
                    
                    <thead>
                    <h5 style="margin-bottom: 20px;">recipients</h5>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="form-control" id="sendToSelect" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="email-to">
                  
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
                        <td><button id="sendTo" type="submit" class="btn btn-default btn-file btn-green btn-blue-inactive" style="margin-top: -4px; padding-left: 6px; padding-top: 3px; height: 30px; width: 30px;"><i class="fa fa-plus" aria-hidden="true"></i></button></td>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>

  
            
                    <br>
                    <script>
                    $('#sendTo').click(function() {
                        var value = $('#sendToSelect').val();
                        var input = $('#sendEmailTo');
                        input.val(input.val() + value + ';');
                        return false;
                        
                    });
                    $('#sendTo').mouseup(function() {
                        $(this).blur();
                            $('.two').trigger();
                        });
                    </script>
                    <script type="text/javascript">
                                    
            $("#sendToSelect").change(function() {
                var dataVal = $(this).val();
                if (dataVal != "") {
                    $('#sendTo').unbind('click', false);
                    $('#sendTo').removeClass('btn-blue-inactive');
                }
                else {
                    $('#sendTo').bind('click', false);
                    $('#sendTo').addClass('btn-blue-inactive');
                }
                
            }).trigger('change');

            </script>
                </form>
            </div> 

            <hr>

            <script>
                function validateEmailForm() {
                  var isValid = true;
                  $('.validateEmail').each(function() {
                    if ( $(this).val() === '' ) {
                        $(this).addClass('inputError');

                        isValid = false;
                    }
                    else if ($(this).val() != '') {
                        $(this).removeClass('inputError');
                    }
                  });
                  if (isValid == false) {
                    alert("Whoa, whoa, whoa! Looks like you're missing some stuff!")
                  }
                  return isValid;
                }

                

            </script>
            <div class="form-group" id="emailForm" style="margin-top: 5px;">
                <form onsubmit="return validateEmailForm()" name="sendEmailForm" action="send-email.php" method="post">
                <table align="center">
                    
                    <thead>
                    <h5 style="margin-bottom: 20px;">email</h5>
                    </thead>

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <label for="sendEmailTo" class="mainPc email1">To</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px;" rows="2" class="form-control desktopInput2 email validateEmail" id="sendEmailTo" name="send-email-to" placeholder="Select (+) recipients above"/></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <br>
                            <label for="emailSubject" class="mainPc email2">Subject</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px;" rows="2" class="form-control desktopInput2 email validateEmail" id="emailSubject" name="email-subject" placeholder="Add Subject"/></textarea>
                            <!--<label for="sendEmailTo">To</label>
                            <input class="desktopInput2" id="sendEmailTo" type="text" name="send-email-to" placeholder="Select recipients above..." value="" />-->
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <br>
                            <label for="emailBody" class="mainPc email3">Email Body</label>
                            <textarea type="text" style="padding-top: 4px; margin-top: 4px;" rows="10" class="desktopInput2 email validateEmail" id="emailBody" name="email-body" placeholder="Compose Email"/></textarea>
                        </td>
                    </tr>
                    </tbody>
                    
                    
                </table>


                <table align="center">
                    
                    <thead>
                        <br>
                    <h5 style="margin-bottom: 20px;">sent from</h5>
                    </thead>

                    <tbody>
                    <tr> 
                        
                        <td text-align="center">
                            <select class="form-control validateEmail" id="sentFromSelect" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="sent-from">
                  
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
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>
                    <button id="sendEmail" type="submit" class="btn btn-default btn-file btn-blue" style="margin-top: 20px; height: 40px; width: 145px;"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp;&nbsp;Send Email</button>
                    <input type="hidden" name="submitted" id="submitted" value="true" />
                </form>

            </div> 


        </div>
    </div>
</div>