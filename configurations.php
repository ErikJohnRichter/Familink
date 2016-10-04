<?php
    require("common.php"); 
     
   
    if(empty($_SESSION['user'])) 
    { 
        
        header("Location: datagenerator.php"); 
         
        
        die("Redirecting to datagenerator.php"); 
    } 

    $query = " 
            SELECT 
                * 
            FROM users 
        "; 
    $link = mysql_connect($host, $username, $password);
    mysql_select_db($dbname);
    $sql = "SELECT * FROM users WHERE id='".$_SESSION['userid']."' ";
    $result = mysql_query("$sql");

    try 
    { 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
       die($ex); 
    } 
         
    $rows = $stmt->fetchAll(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Generate Data</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="css/datepicker.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="css/animate.css" rel="stylesheet">

    <link rel="shortcut icon" href="">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="" />

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>

</head>

<body>
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

    <nav class="navbar navbar-login navbar-default navbar-fixed-top mainPc" style="padding-top: 25px;">
    <div class="container">
        <div class="two" style="margin-top: -12px;">
            <table>
                <tr>
                    <td><h3>saved configurations</h3></td>
                </tr>
            </table>
            <br>
        </div>
        
        <div class="form-group one" style="padding-top: 16px;">
            <table>
                <tr class="nav">
                    
                    
                    <td> Hello <?php echo ucfirst(htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8')); ?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <form action="datagenerator-user.php">
                        <td><input type="submit" class="btn btn-default btn-info" value="Back to Generator"></td>
                    </form>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <form action="logout.php">
                        <td><a href="logout.php">&nbsp Logout</a></td>
                    </form>
                    
                </tr>
            </table>
        </div>
    </div>
</nav>

<div class="col-md-12" style="margin-bottom: 130px;"> </div>
    <!--Add Columns Sidebar-->
    <div class="col-lg-5 mainPc">
        
    </div>

    <!--Custom Data Columns-->
    <div class="col-lg-5 mainPc">
        
        <?php
            $link = mysql_connect($host, $username, $password);
            mysql_select_db($dbname);
            $sql = "SELECT * FROM data_generator.`configurations-".$_SESSION['user']['username']."`";
            $result = mysql_query("$sql");

            $count == 0;
            echo '<table style="border-collapse: separate; border-spacing: 0 1em;">';
            
            while($row = mysql_fetch_assoc($result)) {
                echo '<tr>
                        <form action="saved-configuration.php" method="post"/>
                            <td><h5>'.($count+1).'</h5></td>
                            <td>&nbsp;&nbsp;</td>
                            <td><input type="hidden" name="id" value="'.$row['id'].'"/></td>
                            <td><input type="hidden" name="name" value="'.$row['name'].'"/></td>
                            <td><h5>'.$row['name'].'</h5></td>
                            <td>&nbsp;&nbsp;</td>
                            <td><input type="submit" class="btn btn-success btn-file" value="Open"></td>
                        </form>
                        <form action="delete.php" method="post"/>
                            <td><input type="hidden" name="id" value="'.$row['id'].'"/></td>
                            <td>&nbsp;&nbsp;</td>
                            <td><button type="submit" class="btn btn-danger btn-file"><i class="fa fa-times" aria-hidden="true" ></i></button></td>
                        </form>
                    </tr>';
                $count++;
            }
            
            echo '</table>';
            echo '</div>';

            if ($count == 0){
                echo '<div class="col-md-12 text-center mainPc">
                        <br>
                        <br>
                        <br>
                        <br>

                        <p style="font-size: 36px;">You have no saved data configurations.</p>
                        <p>To save a configuration, return to the Data Generator, create a configuration, and click "Save Config."</p>
                        
                        </div>';
                    }
            mysql_close($link);
        ?>
        
    

    <div class="col-lg-2 mainPc"></div>
    
    <div class="clearfix"></div>
    
    <!--Mobile Access Content-->
    <div class="mobile text-center">
        <h5 style="margin: 10px;">Sorry, this app is not available in a mobile setting</h5>
        <h5 style="margin: 10px;">Please visit from a desktop or laptop</h5>
    </div>  

    <!--Documentation Modal-->
    <div class="modal fade modal-center" id="documentation" role="dialog" style="width: 850px; margin: 0 auto;">
        <div class="modal-content" >
            <div class="container">
                <div class="modal-body">
                    <div class="col-md-8">
                        <div class="text-center">
                            <h3>documentation</h3>
                            <br><br>
                        </div>

                        <p style="font-family: sans-serif;">This is a free tool written in PHP, JavaScript, and MySQL that lets a user quickly generate large volumes of custom-formatted data for use in software testing.<p>
                        <p style="font-family: sans-serif;">Human-data - like names, addresses, town names etc. - is particularly hard to fake because you need a semi-realistically looking data set. This tool was written to solve this problem.<p>

                        <br>

                        <p style="font-family: sans-serif;">The following is a list of items this app can generate random, realistic data for. Each description represents one data cell:</p>
                   
                        <br>

                        <ul >
                            <strong>Human Data</strong>
                            <li>First Name - Generates a male or female first name</li>
                            <li>Male First Name - Generates a male-only first name</li>
                            <li>Female First Name - Generates a female-only first name</li>
                            <li>Last Name - Generates a surname</li>
                            <li>US Phone/Fax Number - Generates a phone/fax number in the format: (xxx) xxx-xxxx</li>
                            <li>UK Phone/Fax Number - Generates a phone/fax number in the format: 0xx xxxx xxxx</li>
                            <li>US or UK Phone/Fax Number - Generates a US or UK phone/fax number</li>
                            <li>Extension - Generates a selected 3, 4, or 5 digit numeric extension</li>
                            <li>Random Extension - Generates a 3, 4, or 5 digit numeric extension</li>
                            <li>Email - Generates an email address based on random text strings</li>
                            <li>Today's Date - Generates today's date in four different formats</li>
                            <li>Random Date - Generates a random date within a selected date range in four different formats</li>
                            <br>
                            <strong>Geographic Data</strong>
                            <li>Street Address - Generates a street address</li>
                            <li>City - Generates a city</li>
                            <li>State - Generates a two-letter state abbreviation</li>
                            <li>Zipcode - Generates a zipcode in the format: xxxxx</li>
                            <li>Zipcode with Extension - Generates a zipcode in the format: xxxxx-xxxx</li>
                            <br>
                            <strong>Text Data</strong>
                            <li>Fixed number of words - Generates a 'lorem ipsum' text string with a specified number of words</li>
                            <li>Random number of words - Generates a 'lorem ipsum' text string with a random number of words</li>
                            <li>Custom Text - Generates a user-specified text string</li>
                            <br>
                            <strong>Numerical Data</strong>
                            <li>Number of fixed length - Generates a number with a specified number of digits</li>
                            <li>Number of random length - Generates a number with a random number of digits</li>
                            <li>Custom number - Generates a user-specified number</li>
                            <br>
                            <strong>Other</strong>
                            <li>Custom List - Allows user to make a list of items and generate a random item from that list. Each item should be separated by a&nbsp&nbsp|&nbsp&nbspcharacter.</li>
                        </ul>

                        <br>

                        <p style="font-family: sans-serif;">On page-load, there are four empty data columns as a default. On the left side of the app, a user can add additional columns or define how many total columns to generate data for. An indiviual column can be deleted by clicking the 'x' button to the right of the column. The 'Reset Data' button will reset all columns and data to the default four.<p>
                        <p style="font-family: sans-serif;">Each column allows a user to give that column a title, something that will appear in the first row of the CSV data file, however it is not required. After adding all data, clicking 'Generate CSV' will write all custom data to a CSV file that downloads to your 'Downloads' folder. As a side-note, clicking 'Generate CSV' will not reset your existing data set-up in the app. You may edit it further and regenerate that new data.<p>

                        <br>

                        <h4>release notes</h4>
                        <br><br>
                        <p style="font-family: sans-serif;"><strong>Verison:</strong> 1.0.0 Beta</p>
                        <p style="font-family: sans-serif;"><strong>Notes:</strong> This is the open beta of Data Generator. The following are some of the things I am aware of and working to fix:</p>
                        <br>
                        <ul> <strong>Bugs</strong>
                            <li>If a user adds a custom date range in an existing column and then adds another column that requires a custom date range, the newly added column does not allow the user to select a date range.</li>
                        </ul>
                        <ul>
                            <strong>Needed Features</strong>
                            <li>Ability to create an account to save data setup.</li>
                            <li>API</li>
                            <li>Create more-realistic email addresses.</li>
                        </ul>

                        <br>
                        
                        <h4>privacy and terms</h4>
                        <br><br>
                        
                        <p style="font-family: sans-serif;">By using this site, you accept that, at anytime, Data Generator may discontinue its service. If that happens, you will no longer have access to the app. All previously generated data will remain on your hard drive. Additionally, until out of beta release, this app may contain bugs that produce results contrary to expected performance. By using this site, you are aware of this and acknowledge these bugs may affect your user-experience.<p>
                        
                        <br>

                        <div class="text-center">
                            <br>
                            <button type="button" class="btn btn-lg btn-default btn-success" data-dismiss="modal">Close</button>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Page Footer-->
    <footer style="position:fixed; bottom:0; width:100%; background-color:white;">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 text-center">
            <br>
                1.0.0 | <a class="mainPc" data-toggle="modal" href="#documentation">Documentation</a>
                        <a class="mobile" href="index.php">Return to Apps</a>
            <br>
            <br>
       </div>
       <div class="col-lg-2"></div>
    </footer>

    <div class="clear-fix"></div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>

</body>

</html>