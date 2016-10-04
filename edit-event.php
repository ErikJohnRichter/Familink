<?php
require("common.php"); 
//Include database connection here
$eventId = $_POST["event-id"]; 
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
            if ($rows) {
                foreach ($rows as $x) {
                	echo '<h3>edit details</h3><br><br>';
                    $string = $x['timestamp'];
                    $stamp = strtotime($string);
                    $monthNumber = date("m", $stamp);
                }
                
            }
            else {
                echo $eventId;
            }
           
?>
     



                <form action="edit-save-event.php" method="post">
                <table>
                    

                    <tbody>
                    <tr> 
                        <td text-align="center">
                            <label for="nameEditInput">Event Name</label>
                            <input class="desktopInput2" id="nameEditInput" type="text" name="event-title" placeholder="Event Name" value="<?php echo htmlspecialchars($x['event_name']); ?>" />
                        </td>
                    </tr>
                    <tr>
                         <td text-align="center">
                            <label for="locationEditInput">Location</label>
                            <input class="desktopInput2" id="locationEditInput" type="text" name="event-location" placeholder="Event Location" value="<?php echo htmlspecialchars($x['event_location']); ?>" />
                        </td>
                    </tr>
                    
                    <tr>
                        
                        <td text-align="center">
                            <label for="monthEditSelect" style="display: inline-block;">Month</label>
                            <select class="form-control" id="monthEditSelect" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 0px; margin-bottom: 0px;" name="event-month">
                  
                            <option value="" selected="selected">Event Month</option>
                                        <option value="January 01">January</option>
                                        <option value="February 02">February</option>
                                        <option value="March 03">March</option>
                                        <option value="April 04">April</option>
                                        <option value="May 05">May</option>
                                        <option value="June 06">June</option>
                                        <option value="July 07">July</option>
                                        <option value="August 08">August</option>
                                        <option value="September 09">September</option>
                                        <option value="October 10">October</option>
                                        <option value="November 11">November</option>
                                        <option value="December 12">December</option>

                            </select>
                
                        </td>
                        </tr>
                    <tr>
                        
                        <td text-align="center">
                            <label for="dayEditSelect" style="display: inline-block;">Day</label>
                            <select class="form-control" id="dayEditSelect" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 0px; margin-bottom: 0px;" name="event-day">
                  
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
                
                        </td>
                        </tr>
                     <tr>
                        
                        <td text-align="center">
                            <label for="timeEditSelect" style="display: inline-block;">Time</label>
                            <select class="form-control" id="timeEditSelect" style="display: inline-block; width: 218px; -webkit-border-radius: 0px; border: solid 2px darkgrey; margin-left: 0px; margin-bottom: 0px;" name="event-time">
                  
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
                
                        </td>
                        </tr>
                        <tr>
                         <td text-align="center"><br>
                            <label for="descriptionEditInput">Description</label>
                            <textarea type="text" rows="4" class="form-control desktopInput2" id="descriptionEditInput" name="event-description" style="width: 325px;"/><?php echo strip_tags(htmlspecialchars_decode($x['event_description'], ENT_QUOTES)); ?></textarea>
                        </td>
                    </tr>

                    
                    
                    <?php echo '<input type="hidden" name="family-id" value="'.$_SESSION['family_id'].'">'; ?>
                    <?php echo '<input type="hidden" name="event-id" value="'.$eventId.'">'; ?>
                    </tbody>
                    
                        <!--<td><button class="btn waves-effect waves-light" type="submit" name="action">Login</button></td>-->
                    
                </table>
                <div class="text-center">
                    <button id="saveEventEdit" type="submit" class="btn btn-default btn-file btn-green" style="margin-top: 20px; width: 90px; height: 40px; display: inline-block;" aria-hidden="true"></i> Save</button>
                    <a href="familink-secure.php" class="btn btn-default btn-danger" style="font-size: 18px; margin-top: 20px; width: 90px; height: 40px; display: inline-block; padding-top: 7px;">Cancel</a>
                </div>
                <br><br>
                </form>
                <script>
        
                var temp1 = "<?php echo htmlspecialchars($x['event_date_month'].' '.$monthNumber); ?>";

                $(function(){
                    $("#monthEditSelect").val(temp1).attr('selected','selected');
                });

                var temp2 = "<?php echo htmlspecialchars($x['event_date_day']); ?>";

                $(function(){
                    $("#dayEditSelect").val(temp2).attr('selected','selected');
                });

                var temp3 = "<?php echo htmlspecialchars($x['event_time_start'].' '.$x['am_pm']); ?>";

                $(function(){
                    $("#timeEditSelect").val(temp3).attr('selected','selected');
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