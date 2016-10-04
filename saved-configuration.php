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
                    <td><h3>data generator</h3></td>
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
                    <form action="configurations.php">
                        <td><input type="submit" class="btn btn-default btn-info" value="My Configurations"></td>
                    </form>
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
    <div class="col-lg-2 sidebar-outer mainPc">
        <div class="sidebar">
            <table align="center">
                <th>Columns</th>
                <th>&nbsp;</th>
                <tr>
                    <td><input type="text" id="columnsToGenerate" class="form-control" style="width: 50px; height: 34px;" value="1" /></td>
                    <td><button class="btn btn-default btn-info addColumn form-control" style="width: 120px;" id="addColumn" />Add Column(s)</button></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td>&nbsp</td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <form id="saveForm" action="datagenerator-user.php" method="post">
                        <td><button type="submit" class="btn btn-default btn-success form-control" id="save" style="width: 120px;">Save New</button></td>
                    </form>
                </tr>
            </table>
        </div>
    </div>

    <!--Custom Data Columns-->
    <div class="col-lg-8 text-center mainPc">
        <form target="_blank" action="generatecsv.php" method="post" id="dataForm" enctype="multipart/form-data"/>
            <?php
                $id = $_POST['id'];
                $name = $_POST['name'];
            echo'<table align="center" >
                    <tr>
                        <td><h4>'.$name.'</h4></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>

                <table align="center" class="dataTable" id="dataTable">
                    <th>Column Title</th>
                    <th>Data Category</th>
                    <th>Data Type</th>
                    <th>Options</th>';
                

                $link = mysql_connect($host, $username, $password);
                mysql_select_db($dbname);
                $sql = "SELECT * FROM data_generator.`configurations-".$_SESSION['user']['username']."` WHERE id =".$id."";
                $result = mysql_query("$sql");
                while($row = mysql_fetch_assoc($result)) {
                    $json = $row['config'];                
                }
                ?>
                <script src="js/jquery-1.11.3.js"></script>
                <script type="text/javascript">
                    var json = <?php echo $json; ?>;
                    var wrapper         = $(".dataTable"); 
                    var x = 0;
                    var tr;
                    for (var i = 0; i < json.length; i++) {
                        var options = json[i].Options;
                        var title = json[i].Title;
                        if (title == "") {
                            title = "----";
                        }

                        // Create table elements
                        tr = $('<tr/>');
                        tr.append("<td><input type='text' id='Title-"+i+"' class='form-control form-control-text' name='Title-"+i+"' value="+ title +" /></td>");
                        
                        tr.append(
                            '    <td><select class="form-control" id="Type-'+i+'" name="Type-'+i+'">'+
                            '            <option value="select">Select Data Category</option>'+
                            '            <optgroup label="Human Data">'+
                            '            <option value="name">Name</option>'+
                            '            <option value="phone">Phone/Fax</option>'+
                            '            <option value="extension">Extension</option>'+
                            '            <option value="email">Email</option>'+
                            '            <option value="date">Date</option>'+
                            '            </optgroup>'+
                            '            <optgroup label="Geo Data">'+
                            '            <option value="address">Street Address</option>'+
                            '            <option value="city">City</option>'+
                            '            <option value="state">State</option>'+
                            '            <option value="zip">Zipcode</option>'+
                            '            </optgroup>'+
                            '            <optgroup label="Text Data">'+
                            '            <option value="text">Text</option>'+
                            '            </optgroup>'+
                            '            <optgroup label="Number Data">'+
                            '            <option value="numeric">Numeric</option>'+
                            '            </optgroup>'+
                            '            <optgroup label="Other">'+
                            '            <option value="other">Custom List</option>'+
                            '            </optgroup>'+
                            '        </select>'+
                            '    </td>');

                        tr.append(
                            '    <td>'+
                            '        <select class="form-control" id="Data-'+i+'" name="Data-'+i+'">'+
                            '            <option value="">Select a Data Category</option>'+
                            '        </select>'+
                            '    </td>');

                        tr.append(
                            '    <td>'+

                            '    <input type="text" id="Custom-'+i+'" class="form-control form-control-text" name="Custom-'+i+'" value='+ options +' />'+
                            '       <div class="date-form" id="DateSelector-'+i+'">'+
                            '                <div class="form-horizontal">'+
                            '                    <div class="control-group">'+
                            '                        <div class="controls">'+
                            '                            <div class="input-group">'+
                            '                                <input id="DateRange1-'+i+'" name="DateRange1-'+i+'" type="text" class="date-picker form-control form-control-date" />'+
                            '                                <label for="DateRange1-'+i+'" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>'+
                            '                                </label>'+
                            '                                <input id="DateRange2-'+i+'" name="DateRange2-'+i+'" type="text" class="date-picker form-control form-control-date" />'+
                            '                                <label for="DateRange2-'+i+'" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>'+
                            '                                </label>'+
                            '                            </div>'+
                            '                        </div>'+
                            '                    </div>'+
                            '                </div>'+
                            '       </div>'+

                            '       <div class="date-form" id="NumberSelector-'+i+'">'+
                            '                <div class="form-horizontal">'+
                            '                    <div class="control-group">'+
                            '                        <div class="controls">'+
                            '                            <div class="input-group">'+
                            '                                <label for="NumberRange1-'+i+'" class="input-group-addon btn">'+
                            '                                 Between'+
                            '                                </label>'+
                            '                                <input id="NumberRange1-'+i+'" name="NumberRange1-'+i+'" type="text" class="form-control form-control-date" />'+
                            '                                <label for="NumberRange2-'+i+'" class="input-group-addon btn">'+
                            '                                 &'+
                            '                                </label>'+
                            '                                <input id="NumberRange2-'+i+'" name="NumberRange2-'+i+'" type="text" class="form-control form-control-date" />'+
                            '                            </div>'+
                            '                        </div>'+
                            '                    </div>'+
                            '                </div>'+
                            '       </div>'+

                            '    </td>');
                        
                        $('#dataTable').append(tr);

                    }

                    // Populate Type Dropdowns
                    for (var i = 0; i < json.length; i++) {

                        $("#Type-"+i+"").val(json[i].Type);
                    }

                    // Set Data Dropdowns based on Type
                    for (var i = 0; i < json.length; i++) {

                        var val = $("#Type-"+i+"").val();
                        setDataDropdown(val);
                    }

                    // Set enabled/disabled on Data Dropdowns
                    for (var i = 0; i < json.length; i++) {

                        var dataVal = $("#Type-"+i+"").val();
                            if (dataVal != "select") {
                                $("#Data-"+i+"").removeAttr("disabled");
                                $("#Data-"+i+"").val("none");
                            }
                            else {
                                $("#Data-"+i+"").attr("disabled", "disabled").val("");
                            }
                    }

                    // Populate Data Dropdowns
                    for (var i = 0; i < json.length; i++) {

                        $("#Data-"+i+"").val(json[i].Data);
                    }

                    // Set Option Inputs
                    for (var i = 0; i < json.length; i++) {

                        var dataVal = $("#Data-"+i+"").val();
                        setOptionInputs(val);
                    }

                    function setDataDropdown(val){
                        if (val == "select") {
                            $("#Data-"+i+"").html("<option>Select a Data Category</option>");
                        }

                        // HUMAN DATA
                        else if (val == "name") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                        "<option value='first'>First Name</option>"+
                                                                        "<option value='male'>First Name - Male</option>"+
                                                                        "<option value='female'>First Name - Female</option>"+
                                                                        "<option value='last'>Last Name</option>");
                        } 
                        else if (val == "phone") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                        "<option value='us'>US</option>"+
                                                                        "<option value='uk'>UK</option>"+
                                                                        "<option value='comboPhones'>Combination of both</option>");
                        } 
                        else if (val == "extension") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                        "<option value='three'>3 Digit</option>"+
                                                                        "<option value='four'>4 Digit</option>"+
                                                                        "<option value='five'>5 Digit</option>"+
                                                                        "<option value='comboExt'>Combination of all three</option>");
                        } 
                        else if (val == "email") {
                            $("#Data-"+i+"").html("<option value='none'>No Additional Selectors</option>");
                        } 
                        else if (val == "date") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                        "<optgroup label='Now'>"+
                                                                        "<option value='mmddyyyy'>Now - mm/dd/yyyy</option>"+
                                                                        "<option value='ddmmyyyy'>Now - dd/mm/yyyy</option>"+
                                                                        "<option value='monthdayyear'>Now - Month dd yyyy</option>"+
                                                                        "<option value='daymonthyear'>Now - dd-Month-yy</option>"+
                                                                        "<optgroup label='Date Between Range'>"+
                                                                        "<option value='mmddyyyyRange'>Range - mm/dd/yyyy</option>"+
                                                                        "<option value='ddmmyyyyRange'>Range - dd/mm/yyyy</option>"+
                                                                        "<option value='monthdayyearRange'>Range - Month dd yyyy</option>"+
                                                                        "<option value='daymonthyearRange'>Range - dd-Month-yy</option>"+
                                                                        "<optgroup label='Custom'>"+
                                                                        "<option value='customDate'>Enter Date String</option>");
                        } 

                        // GEOGRAPHIC DATA
                        else if (val == "address") {
                            $("#Data-"+i+"").html("<option value='none'>No Additional Selectors</option>");
                        }
                        else if (val == "city") {
                            $("#Data-"+i+"").html("<option value='none'>No Additional Selectors</option>");
                        }
                        else if (val == "state") {
                            $("#Data-"+i+"").html("<option value='none'>No Additional Selectors</option>");
                        }
                        else if (val == "zip") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                "<option value='fiveDigit'>5 Digit</option>"+
                                                                "<option value='plusExtension'>5 Digit + 4 Ext</option>"+
                                                                "<option value='comboZips'>Combination of both</option>");
                        }

                        // TEXT DATA
                        else if (val == "text") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                "<option value='fixed'>Fixed # of words</option>"+
                                                                "<option value='random'>Random # of words</option>"+
                                                                "<option value='customText'>Custom Text</option>");
                        } 

                        // NUMERIC DATA
                        else if (val == "numeric") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                "<option value='fixed'>Number-Fixed length</option>"+
                                                                "<option value='random'>Number-Random length</option>"+
                                                                "<option value='customNumber'>Custom Number</option>");
                        } 

                        // OTHER DATA
                        else if (val == "other") {
                            $("#Data-"+i+"").html("<option>Select a Data Type</option>"+
                                                                "<option value='customList'>Custom List</option>");
                        }
                    }

                    function setOptionInputs(val) {
                        if (dataVal == "mmddyyyyRange" || dataVal == "ddmmyyyyRange" || dataVal == "monthdayyearRange" || dataVal == "daymonthyearRange") {
                            $("#Custom-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#DateSelector-"+i+"").show();
                            $("#DateRange1-"+i+"").attr("value", "01/01/1950");
                            $("#DateRange2-"+i+"").attr("value", "12/31/1984");
                        }
                        else if (dataVal == "random") {
                            $("#DateSelector-"+i+"").hide();
                            $("#Custom-"+i+"").hide();
                            $("#NumberSelector-"+i+"").show();
                            $("#NumberRange1-"+i+"").attr("value", "1");
                            $("#NumberRange2-"+i+"").attr("value", "100");
                        }
                        else if (dataVal == "customDate") {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").removeAttr("disabled");
                            $("#Custom-"+i+"").attr("placeholder", "Enter custom date");
                        }
                        else if (dataVal == "customText") {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").removeAttr("disabled");
                            $("#Custom-"+i+"").attr("placeholder", "Enter custom text");
                        }
                        else if (dataVal == "customNumber") {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").removeAttr("disabled");
                            $("#Custom-"+i+"").attr("placeholder", "Enter custom number");
                        }
                        else if (dataVal == "fixed") {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").removeAttr("disabled");
                            $("#Custom-"+i+"").attr("placeholder", "Enter length");
                        }
                        else if (dataVal == "customList") {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").removeAttr("disabled");
                            $("#Custom-"+i+"").attr("placeholder", "Separate list items with a  |");
                        }
                        else {
                            $("#DateSelector-"+i+"").hide();
                            $("#NumberSelector-"+i+"").hide();
                            $("#Custom-"+i+"").show();
                            $("#Custom-"+i+"").attr("disabled", "disabled").val("");
                            $("#Custom-"+i+"").attr("placeholder", "");
                        }
                    }
                </script>
                
                
                </table>

                <!--Number of rows to generate and Submit button-->
                <footer>
                    <br>
                    <label for="totalRowsToGenerate" style="text-align: left; float:left; width: 180px;">Rows of data to generate</label> 
                    <input type="text" id="totalRowsToGenerate" name="totalRowsToGenerate" class="form-control" style="width: 100px; height: 34px;" value="1" />
                    <input type="hidden" name="totalColumnsInTable" id="totalColumnsInTable" value="">
                    <button class="btn btn-default btn-lg btn-success" value="Add" onclick="this.disabled=true;this.value='Generating...';this.form.submit(#dataForm);" id="submitButton">Generate CSV</button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                </footer>
        </form>
    </div>

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
                            <li>Deleting rows prior to generating a CSV affects the column number count in the CSV file. As a result, empty columns appear where those columns were deleted in the generator.</li>
                            <li>In saved configurations, editing is restricted to data found within the existing column's data type.</li>
                        </ul>
                        <ul>
                            <strong>Needed Features</strong>
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