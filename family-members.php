<div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" data-target="#collapseTwo">
        <h3 class="panel-title">
            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
              Family Members
            </a>
        </h3>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
        <div class="panel-body text-center">
            
            <h5 style="margin-bottom: 20px;">contact info</h5>
            <?php

            if ($row['is_admin'] == 1) {
                echo '<button type="button" id="addMemberButton" class="btn btn-default btn-green" style="width: 30px; height: 30px; margin-right: 4px; margin-bottom: 4px;"><i class="fa fa-plus" aria-hidden="true"></i></button>';
            }

            ?>
                <form action="delete-member.php" method="post" id="familyMemberForm" style="display: inline-block;">
                <select class="form-control" id="familyMemberSelect" style="display: inline-block; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="member-id">
                  
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
                    echo '<option value="" selected="selected">Select Family Member</option>';
                    $memberId = 0;
                    $count = 1;
                    foreach ($rows as $x) {
                    echo '<option value="'.$x['id'].'">'.$x['first_name'].'&nbsp'.$x['last_name'].'</option>';
                    $count++;
                    }
                    
                }
                else {
                    echo '<option value="">None added yet</option>';
                }

                ?>
              
                </select>
                <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                
                <a id="viewMember" class="btn btn-default btn-file btn-blue btn-blue-inactive" data-toggle="modal" data-target="#memberDetails" href=""><i class="fa fa-search" style="padding-top: 6px;" aria-hidden="true"></i></a>
                <?php

                    if ($row['is_admin'] == 1) {
                    echo '<button disabled type="submit" id="deleteMember" class="btn btn-default btn-file btn-red delete-confirm" style="width: 30px; height: 30px; margin-bottom: 4px;" name="submit"/><i class="fa fa-remove" aria-hidden="true"></i></button>';
                    }

                    ?>

                
            </form>

            <script>
            $('#familyMemberSelect').change(function() {
                var id = $(this).val();
                $("#viewMember").attr("href", "view-member.php?id="+id);
                
                  
                }).trigger('change');

            </script>

  
            <script type="text/javascript">
                                    
            $("#familyMemberSelect").change(function() {
                var dataVal = $(this).val();
                if (dataVal != "") {
                    $('#viewMember').unbind('click', false);
                    $('#viewMember').removeClass('btn-blue-inactive');
                }
                else {
                    $('#viewMember').bind('click', false);
                    $('#viewMember').addClass('btn-blue-inactive');
                }
                
            }).trigger('change');

            $("#familyMemberSelect").change(function() {
                var dataVal = $(this).val();
                if (dataVal != "") {
                    document.getElementById("deleteMember").disabled = false;
                }
                else {
                    document.getElementById("deleteMember").disabled = true;
                }
                
            }).trigger('change');


            </script>

            <script>
                function validateMemberForm() {
                  var isValid = true;
                  $('.validateMember').each(function() {
                    if ( $(this).val() === '' ) {
                        $(this).addClass('inputError');

                        isValid = false;
                    }
                    else if ($(this).val() != '') {
                        $(this).removeClass('inputError');
                    }
                  });
                  if (isValid == false) {
                    alert("Your family member needs a first and last name.")
                  }
                  return isValid;
                }

                

            </script>

            <div class="form-group" id="addMemberForm" style="margin-top: 5px;">
                <form onsubmit="return validateMemberForm()" action="add-family-member.php" method="post">
                <table align="center">
                    
                    <thead>
                    <h5 style="margin-bottom: 20px;">add a family member</h5>
                    </thead>

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <input class="desktopInput2 validateMember" id="firstInput" type="text" name="first-name" placeholder="First Name" value="" />
                        </td>
                    </tr>
                        <tr>
                         <td text-align="center">
                            <input class="desktopInput2 validateMember" id="lastInput" type="text" name="last-name" placeholder="Last Name" value="" />
                        </td>
                    </tr>
                    <tr>
                        
                        <td text-align="center">
                            <select class="form-control" id="familyUnitSelect1" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="family-unit-1">
                  
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
                        if ($rows) {
                            echo '<option value="" selected="selected">Select Family Unit 1</option>';
                            $count = 1;
                            foreach ($rows as $x) {
                            echo '<option value="'.$x['unit_name'].'">'.$x['unit_name'].'</option>';
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
                        <tr>
                        <td text-align="center">
                            <select class="form-control" id="familyUnitSelect2" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="family-unit-2">
                  
                        <?php

                        if ($rows) {
                            echo '<option value="" selected="selected">Select Family Unit 2</option>';
                            $count = 1;
                            foreach ($rows as $x) {
                            echo '<option value="'.$x['unit_name'].'">'.$x['unit_name'].'</option>';
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
                        <tr> 

                        <td text-align="center">
                            <input class="desktopInput2" id="emailInput" type="text" name="email" placeholder="Email" value="" />
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="mobilePhoneInput" type="text" name="mobile-phone" placeholder="Mobile Phone" value="" />
                        </td>

                        </tr>
                        <tr> 

                        <td text-align="center">
                            <input class="desktopInput2" id="homePhoneInput" type="text" name="home-phone" placeholder="Home Phone" value="" />
                        </td>
                     </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="address1Input" type="text" name="address1" placeholder="Street Address" value="" />
                        </td>

                        </tr>
                        <tr>
                     
                        <td text-align="center">
                            <input class="desktopInput2" id="address2Input" type="text" name="address2" placeholder="Unit or Box #" value="" />
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="cityInput" type="text" name="city" placeholder="City" value="" />
                        </td>

                        </tr>
                        <tr> 
                    
                        <td text-align="center">
                            <input class="desktopInput2" id="stateInput" type="text" name="state" placeholder="State" value="" />
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="zipInput" type="text" name="zip" placeholder="Zip" value="" />
                        </td>

                        </tr>
                        <tr> 
                    
                        <td text-align="center">
                            <input class="desktopInput2" id="dobInput" type="text" name="dob" placeholder="Birthday" value="" />
                        </td>
                     </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="anniversaryInput" type="text" name="anniversary" placeholder="Anniversary" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <input class="desktopInput2" id="notesInput" type="text" name="notes" placeholder="Notes" value="" />
                        </td>
                    </tr>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$row['family_id'].'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>
                    <button id="addMember" type="submit" class="btn btn-default btn-file btn-green" style="margin-top: 20px; width: 80px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>

                </form>
            </div> 

        </div>
    </div>
</div>