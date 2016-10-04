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
      
      <h2 class="page_title">ADMIN SETTINGS</h2>
      
      <div class="page_content">
      
      
      
      <div class="panel-body text-center" >

        <div class="form-group" id="addMemberForm" style="margin-top: 5px;">
                <form onsubmit="return validateMemberForm()" action="add-family-member.php" method="post">
                <table align="center" style="margin: 0 auto;">
                    
                    <thead>
                    <h5 style="margin-bottom: 20px;">add a family member</h5>
                    </thead>

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <input class="desktopInput2 validateMember generalInput" id="firstInput" type="text" name="first-name" placeholder="First Name" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                        <tr>
                         <td text-align="center">
                            <input class="desktopInput2 validateMember generalInput" id="lastInput" type="text" name="last-name" placeholder="Last Name" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                    <tr>
                        
                        <td text-align="center">
                            <select class="form-control button select" id="familyUnitSelect1" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="family-unit-1">
                  
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
                        <td text-align="center"><br>
                            <select class="form-control button select" id="familyUnitSelect2" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="family-unit-2">
                  
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
                        <td text-align="center"><br>
                            <select class="form-control button select" id="familyUnitSelect3" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="family-unit-3">
                  
                        <?php

                        if ($rows) {
                            echo '<option value="" selected="selected">Select Family Unit 3</option>';
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

                        <td text-align="center"><br>
                            <input class="desktopInput2 generalInput" id="emailInput" type="text" name="email" placeholder="Email" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="mobilePhoneInput" type="text" name="mobile-phone" placeholder="Mobile Phone" value="" style="font-size: 16px"/>
                        </td>

                        </tr>
                        <tr> 

                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="homePhoneInput" type="text" name="home-phone" placeholder="Home Phone" value="" style="font-size: 16px"/>
                        </td>
                     </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="address1Input" type="text" name="address1" placeholder="Street Address" value="" style="font-size: 16px"/>
                        </td>

                        </tr>
                        <tr>
                     
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="address2Input" type="text" name="address2" placeholder="Unit or Box #" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="cityInput" type="text" name="city" placeholder="City" value="" style="font-size: 16px"/>
                        </td>

                        </tr>
                        <tr> 
                    
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="stateInput" type="text" name="state" placeholder="State" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                        <tr>
                        <td text-align="center">
                            <input class="desktopInput2 generalInput" id="zipInput" type="text" name="zip" placeholder="Zip" value="" style="font-size: 16px"/>
                        </td>

                        </tr>

                        <tr> 
                        <td text-align="center">
                            <select class="form-control button select" id="birthMonthSelect" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="birth-month">
                            <option value="" selected="selected">Birth Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>

                            </select>
                            <!--<input class="desktopInput2 generalInput" id="dobInput" type="text" name="dob" placeholder="Birthday" value="" style="font-size: 16px"/>-->
                        </td>
                        <td text-align="center">
                            <select class="form-control button select" id="birthDaySelect" style="display: inline-block; width: 70px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="birth-day">
                            <option value="" selected="selected">Day</option>
                                    <option>1</option>       
                                    <option>2</option>       
                                    <option>3</option>       
                                    <option>4</option>       
                                    <option>5</option>       
                                    <option>6</option>       
                                    <option>7</option>       
                                    <option>8</option>       
                                    <option>9</option>       
                                    <option>10</option>       
                                    <option>11</option>       
                                    <option>12</option>       
                                    <option>13</option>       
                                    <option>14</option>       
                                    <option>15</option>       
                                    <option>16</option>       
                                    <option>17</option>       
                                    <option>18</option>       
                                    <option>19</option>       
                                    <option>20</option>       
                                    <option>21</option>       
                                    <option>22</option>       
                                    <option>23</option>       
                                    <option>24</option>       
                                    <option>25</option>       
                                    <option>26</option>       
                                    <option>27</option>       
                                    <option>28</option>       
                                    <option>29</option>       
                                    <option>30</option>       
                                    <option>31</option>       

                            </select>
                            <!--<input class="desktopInput2 generalInput" id="dobInput" type="text" name="dob" placeholder="Birthday" value="" style="font-size: 16px"/>-->
                        </td>
                     </tr>
                     <tr>
                        <td text-align="center"><br>
                            <input class="desktopInput2 generalInput" id="dobYear" type="text" name="dob-year" placeholder="Birth Year" value="" style="font-size: 16px"/>
                        </td>

                        </tr>
                        <tr>
                        <td text-align="center"><br>
                            <select class="form-control button select" id="anniversaryMonthSelect" style="display: inline-block; width: 220px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="anniversary-month">
                            <option value="" selected="selected">Anniversary Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>

                            </select>
                            <!--<input class="desktopInput2 generalInput" id="dobInput" type="text" name="dob" placeholder="Birthday" value="" style="font-size: 16px"/>-->
                        </td>
                        <td text-align="center"><br>
                            <select class="form-control button select" id="anniversaryDaySelect" style="display: inline-block; width: 70px; -webkit-border-radius: 0px; border: 2px solid #d6d6d6; margin-left: 1px;" name="anniversary-day">
                            <option value="" selected="selected">Day</option>
                                    <option>1</option>       
                                    <option>2</option>       
                                    <option>3</option>       
                                    <option>4</option>       
                                    <option>5</option>       
                                    <option>6</option>       
                                    <option>7</option>       
                                    <option>8</option>       
                                    <option>9</option>       
                                    <option>10</option>       
                                    <option>11</option>       
                                    <option>12</option>       
                                    <option>13</option>       
                                    <option>14</option>       
                                    <option>15</option>       
                                    <option>16</option>       
                                    <option>17</option>       
                                    <option>18</option>       
                                    <option>19</option>       
                                    <option>20</option>       
                                    <option>21</option>       
                                    <option>22</option>       
                                    <option>23</option>       
                                    <option>24</option>       
                                    <option>25</option>       
                                    <option>26</option>       
                                    <option>27</option>       
                                    <option>28</option>       
                                    <option>29</option>       
                                    <option>30</option>       
                                    <option>31</option>       

                            </select>
                            <!--<input class="desktopInput2 generalInput" id="anniversaryInput" type="text" name="anniversary" placeholder="Anniversary" value="" style="font-size: 16px"/>-->
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center"><br>
                            <input class="desktopInput2 generalInput" id="anniversaryYear" type="text" name="anniversary-year" placeholder="Year Married" value="" style="font-size: 16px"/>
                        </td>

                        </tr>
                    <tr>
                        <td text-align="center"><br>
                            <input class="desktopInput2 generalInput" id="notesInput" type="text" name="notes" placeholder="Notes" value="" style="font-size: 16px"/>
                        </td>
                    </tr>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>
                    <button id="addMember" type="submit" class="button button-green" style="margin: 0 auto; margin-top: 20px; width: 80px;"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>

                </form>
            </div> 
            <br>

            <hr>
<h5 style="margin-bottom: 20px;">add unit</h5>
        <div class="form-group" id="addUnitForm" style="margin-top: 5px;">
                <form onsubmit="return validateUnitForm()" action="add-family-unit.php" method="post">
                <table align="center" style="margin: 0 auto; width: 288px;" >

                  
                    <tr>
                    
                        <td>
                            <input class="desktopInput2 generalInput" id="unitInput" type="text" name="unit-name" placeholder="New Family Unit" value="" style="display: inline-block; font-size: 16px; width: 180px;" />
                        </td>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                        <td><button type="submit" id="addUnit" class="button button-green" style="display: inline-block; width: 65px;">Add</i></button></td>
                        
                    </tr>
                </table>
                </form>
            </div>     
            <hr>
            <h5 style="margin-bottom: 20px;">delete unit</h5>
            <form action="delete-unit.php" method="post" id="familyUnitForm">
                <table style="margin: 0 auto;">
                  
                <tr>
                <td><select class="form-control button select" id="familyUnitSelect" name="unit-name" style="display: inline-block; border: 2px solid #d6d6d6; width: 180px;">
                  
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
                if ($rows) {
                    echo '<option value="" selected="selected">Select Family Unit</option>';
                    $count = 1;
                    foreach ($rows as $x) {
                    echo '<option value="'.$x['unit_name'].'">'.$count.')&nbsp&nbsp'.$x['unit_name'].'</option>';
                    $count++;
                    }
                    
                }
                else {
                    echo '<option value="">None added yet</option>';
                }

                ?>
                </select></td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                <td><button type="submit" id="deleteUnit" class="button button-red"  style="display: inline-block; width: 65px;" name="submit"/>Delete</i></button></td>
              </tr>
            </table>
            </form>
            
            <!--<script>
                function validateUnitForm() {
                  var isValid = true;
                  $('.validateUnit').each(function() {
                    if ( $(this).val() === '' ) {
                        $(this).addClass('inputError');

                        isValid = false;
                    }
                    else if ($(this).val() != '') {
                        $(this).removeClass('inputError');
                    }
                  });
                  if (isValid == false) {
                    alert("Whoa, whoa, whoa! You definitely need to add a unit name first!")
                  }
                  return isValid;
                }

                

            </script>-->

            
        


<br>
<hr>


            <h5 style="margin-bottom: 20px;">delete member</h5>
            <form action="delete-member.php" method="post" id="familyMemberForm">
              <table align="center" style="margin: 0 auto;">
                  
                <tr>
                <td><select class="form-control button select" id="familyMemberSelect" style="display: inline-block; border: 2px solid #d6d6d6; width: 180px" name="member-id">
                  
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
                 
                $rows = $stmt->fetchAll();
                if ($rows) {
                    echo '<option value="" selected="selected">Select Member:</option>';
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
              
                </select></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                
                
                <td><button type="submit" id="deleteMember" class="button button-red" style="display: inline-block; width: 65px;" name="submit"/>Delete</button></td>
                  
                </tr>
              </table>
                
            </form>


<br>





      
      </div>
      
      </div>
      
      
    </div>
  </div>
</div>