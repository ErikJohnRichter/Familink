<?php
require("common.php"); 
//Include database connection here
$memberId = $_POST["member-id"]; 
// Run the Query
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>familink</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="" />

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,900' rel='stylesheet' type='text/css'>

    <!-- Include the plugin's CSS and JS: -->
    <script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
    <!--Import Google Icon Font-->
    <!--Import materialize.css-->
    <!--Let browser know website is optimized for mobile-->
    <!--<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/jquery-ui.js"></script>

</head>

<body style="background-color: white;">
<div class="col-md-4"></div>

<?php

echo '<div class="col-md-4">'.
        '<div class="container form-group">';
   
    
        $query = " 
            SELECT * FROM family_member 
            WHERE 
                id = :memberid AND
                family_id = :familyid
            
        "; 
         
        $query_params = array( 
            ':memberid' => $memberId,
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
            if ($rows) {
                foreach ($rows as $x) {
                	echo '<h3>edit family member</h3><br><br>';
                	
                }
                
            }
            else {
                echo $memberId;
            }
           
?>
     



                <form action="edit-save.php" method="post">
                <table>
                    

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <label for="firstEditInput">First Name</label>
                            <input class="desktopInput2" id="firstEditInput" type="text" name="first-name" placeholder="First Name" value="<?php echo htmlspecialchars($x['first_name']); ?>" />
                        </td>
                    </tr>
                    <tr>
                         <td text-align="center">
                            <?php $lastname = str_replace('&nbsp;', ' ', $x['last_name']); ?>
                            <label for="lastEditInput">Last Name</label>
                            <input class="desktopInput2" id="lastEditInput" type="text" name="last-name" placeholder="Last Name" value="<?php echo htmlspecialchars($lastname); ?>" />
                        </td>
                    </tr>
                    <tr>
                        
                        <td text-align="center">
                            <label for="familyUnitEditSelect1" style="display: inline-block;">Family Unit</label>
                            <select class="form-control" id="familyUnitEditSelect1" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 0px; margin-bottom: 0px;" name="family-unit-1">
                  
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
                    echo '<option value="">Select Family Unit</option>';
                    $count = 1;
                    foreach ($rows as $y) {
                    echo '<option value="'.$y['unit_name'].'">'.$y['unit_name'].'</option>';
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
                            <label for="familyUnitEditSelect2">Family Unit</label>
                            <select class="form-control" id="familyUnitEditSelect2" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="family-unit-2">
                  
                        <?php

                        if ($rows) {
                            echo '<option value="" selected="selected">Select Family Unit 2</option>';
                            $count = 1;
                            foreach ($rows as $y) {
                            echo '<option value="'.$y['unit_name'].'">'.$y['unit_name'].'</option>';
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
                            <label for="familyUnitEditSelect3">Family Unit</label>
                            <select class="form-control" id="familyUnitEditSelect3" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="family-unit-3">
                  
                        <?php

                        if ($rows) {
                            echo '<option value="" selected="selected">Select Family Unit 3</option>';
                            $count = 1;
                            foreach ($rows as $y) {
                            echo '<option value="'.$y['unit_name'].'">'.$y['unit_name'].'</option>';
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
                            <label for="emailEditInput">Email</label>
                            <input class="desktopInput2" id="emailEditInput" type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($x['email']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label for="subscribedEditInput">Subscribed?</label>
                            <input style="transform: scale(2); margin-left:6px; margin-top:13px;" id="subscribedEditInput" type="checkbox" name="is-subscribed" placeholder="" value="" <?php if ($x['is_subscribed'] == 1) { echo "checked";} ?>/>
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="mobilePhoneEditInput">Mobile Phone</label>
                            <input class="desktopInput2" id="mobilePhoneEditInput" type="text" name="mobile-phone" placeholder="Mobile Phone" value="<?php echo htmlspecialchars($x['mobile_phone']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label for="homePhoneEditInput">Home Phone</label>
                            <input class="desktopInput2" id="homePhoneEditInput" type="text" name="home-phone" placeholder="Home Phone" value="<?php echo htmlspecialchars($x['home_phone']); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="address1EditInput">Address</label>
                            <input class="desktopInput2" id="address1EditInput" type="text" name="address1" placeholder="Street Address" value="<?php echo htmlspecialchars($x['address1']); ?>" />
                        </td>
                     </tr>
                    <tr>
                        <td text-align="center">
                            <label for="address2EditInput">Unit or Box#</label>
                            <input class="desktopInput2" id="address2EditInput" type="text" name="address2" placeholder="Unit or Box #" value="<?php echo htmlspecialchars($x['address2']); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="cityEditInput">City</label>
                            <input class="desktopInput2" id="cityEditInput" type="text" name="city" placeholder="City" value="<?php echo htmlspecialchars($x['city']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label for="stateEditInput">State</label>
                            <input class="desktopInput2" id="stateEditInput" type="text" name="state" placeholder="State" value="<?php echo htmlspecialchars($x['state']); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="zipEditInput">Zip Code</label>
                            <input class="desktopInput2" id="zipEditInput" type="text" name="zip" placeholder="Zip" value="<?php echo htmlspecialchars($x['zip']); ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label for="birthMonthEditSelect">Birthday</label>
                            <select class="form-control button select" id="birthMonthEditSelect" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="birth-month">
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
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label> </label>
                            <select class="form-control button select" id="birthDayEditSelect" style="display: inline-block; width: 85px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="birth-day">
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
                            <!--<input class="desktopInput2" id="dobEditInput" type="text" name="dob" placeholder="Birthday" value="<?php /*echo htmlspecialchars($x['dob']); */?>" />-->
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="birthYearEditInput">Birth Year</label>
                            <input class="desktopInput2" id="birthYearEditInput" type="text" name="dob-year" placeholder="Birth Year" value="<?php echo htmlspecialchars($x['dob_year']); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="anniversaryMonthEditSelect">Anniversary</label>
                            <select class="form-control button select" id="anniversaryMonthEditSelect" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="anniversary-month">
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
                    </tr>
                    <tr>
                        <td text-align="center">
                            <label> </label>
                            <select class="form-control button select" id="anniversaryDayEditSelect" style="display: inline-block; width: 85px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 1px;" name="anniversary-day">
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
                            <!--<input class="desktopInput2" id="anniversaryEditInput" type="text" name="anniversary" placeholder="Anniversary" value="<?php /*echo htmlspecialchars($x['anniversary']); */?>" />-->
                        </td>
                    </tr>
                    <tr> 
                        <td text-align="center">
                            <label for="anniversaryYearEditInput">Year Married</label>
                            <input class="desktopInput2" id="anniversaryYearEditInput" type="text" name="anniversary-year" placeholder="Year Married" value="<?php echo htmlspecialchars($x['anniversary_year']); ?>" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <br>
                            <label for="notesEditInput">Notes</label>
                            <textarea type="text" rows="4" class="form-control desktopInput2" id="notesEditInput" name="notes" style="width: 325px;"/><?php echo htmlspecialchars($x['notes']); ?></textarea>
                        </td>
                    </tr>
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    <?php echo '<input type="hidden" name="member-id" value="'.$memberId.'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>
                <div class="text-center">
                    <button id="saveMemberEdit" type="submit" class="btn btn-default btn-file btn-green" style="margin-top: 20px; width: 90px; height: 40px; display: inline-block;" aria-hidden="true"></i> Save</button>
                    <a href="familink-secure.php" class="btn btn-default btn-danger" style="font-size: 18px; margin-top: 20px; width: 90px; height: 40px; display: inline-block; padding-top: 7px;">Cancel</a>
                </div>
                <br><br>
                </form>
                <script>
        
                var temp1 = "<?php echo htmlspecialchars($x['family_unit_1']); ?>";

                $(function(){
                    $("#familyUnitEditSelect1").val(temp1).attr('selected','selected');
                });

                var temp2 = "<?php echo htmlspecialchars($x['family_unit_2']); ?>";

                $(function(){
                    $("#familyUnitEditSelect2").val(temp2).attr('selected','selected');
                });

                var temp3 = "<?php echo htmlspecialchars($x['family_unit_3']); ?>";

                $(function(){
                    $("#familyUnitEditSelect3").val(temp3).attr('selected','selected');
                });



                var birthdayMonth = "<?php echo htmlspecialchars($x['dob_month']); ?>";
                var birthdayDay = "<?php echo htmlspecialchars($x['dob_day']); ?>";

                $(function(){
                    $("#birthMonthEditSelect").val(birthdayMonth).attr('selected','selected');
                });

                $(function(){
                    $("#birthDayEditSelect").val(birthdayDay).attr('selected','selected');
                });

                var anniversaryMonth = "<?php echo htmlspecialchars($x['anniversary_month']); ?>";
                var anniversaryDay = "<?php echo htmlspecialchars($x['anniversary_day']); ?>";

                $(function(){
                    $("#anniversaryMonthEditSelect").val(anniversaryMonth).attr('selected','selected');
                });

                $(function(){
                    $("#anniversaryDayEditSelect").val(anniversaryDay).attr('selected','selected');
                });



                </script>
</div>
</div>
 
<div class="col-md-4"></div>
<div class="clear-fix"></div>

    <!-- jQuery Version 1.11.3 -->
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>

</body>

</html>