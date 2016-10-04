<?php
    require("common.php");
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

    <div class="text-center">
        <h3>data generator</h3>
        <br><br>
    </div>

    <!--Add Columns Sidebar-->
    <div class="col-lg-2 sidebar-outer">
    <div class="sidebar">
        <table align="center">
            <th>Columns</th>
            <th>&nbsp;</th>
            <tr>
                <td><input type="text" id="columnsToGenerate" class="form-control" style="width: 50px; height: 34px;" value="1" /></td>
                <td><button class="btn btn-default btn-info addColumn form-control" style="width: 120px;" id="addColumn" />Add Column(s)</button></td>
            </tr>
            
            <tr>
                <td><input type="text" id="totalColumns" class="form-control" style="width: 50px; height: 34px;" value="4" /></td>
                <td><button class="btn btn-default btn-info addTotalColumns form-control" style="width: 120px;" id="addTotalColumns" />Total Columns</button></td>
            </tr>
            <tr>
                <td>&nbsp</td>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td>&nbsp</td>
                <td><a href="generate.php"><button class="btn btn-default btn-warning" id="return">Reset Data</button></a></td>
            </tr>
        </table>
    </div>
    </div>

    <!--Custom Data Columns-->
    <div class="col-lg-8 text-center">
        <form target="_blank" action="generatecsv.php" method="post" id="dataForm" enctype="multipart/form-data"/>
            <table align="center" class="dataTable" >
                <th>Column Title</th>
                <th>Data Category</th>
                <th>Data Type</th>
                <th>Options</th>
                <th>Delete</th>

                <!--Default column creation-->
                <?php

                $count = 0;
                while($count < 4) {
                    echo'<tr>
                        <td><input type="text" id="Title-'.$count.'" class="form-control form-control-text" name="Title-'.$count.'" placeholder="Column Title" /></td>
                        <td><select class="form-control" id="Type-'.$count.'" name="Type-'.$count.'">
                                <option value="select">Select Data Category</option>
                                <optgroup label="Human Data">
                                <option value="name">Name</option>
                                <option value="phone">Phone/Fax</option>
                                <option value="extension">Extension</option>
                                <option value="email">Email</option>
                                <option value="date">Date</option>
                                </optgroup>
                                <optgroup label="Geo Data">
                                <option value="address">Street Address</option>
                                <option value="city">City</option>
                                <option value="state">State</option>
                                <option value="zip">Zipcode</option>
                                </optgroup>
                                <optgroup label="Text Data">
                                <option value="text">Text</option>
                                </optgroup>
                                <optgroup label="Number Data">
                                <option value="numeric">Numeric</option>
                                </optgroup>
                                <optgroup label="Other">
                                <option value="other">Custom List</option>
                                </optgroup>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" id="Data-'.$count.'" name="Data-'.$count.'">
                                <option value="">Select a Data Category</option>
                            </select>
                        </td>'; ?>

                        <!--Dynamic JS settings for Data Type dropdown-->
                        <script src="js/jquery-1.11.3.js"></script>
                        <script type="text/javascript">
                                
                                $("#Type-<?php echo $count; ?>").change(function() {
                                    var dataVal = $(this).val();
                                    if (dataVal != "select") {
                                        $("#Data-<?php echo $count; ?>").removeAttr("disabled");
                                    }
                                    else {
                                        $("#Data-<?php echo $count; ?>").attr("disabled", "disabled").val("");
                                    }
                                }).trigger('change');
                                
                                $("#Type-<?php echo $count; ?>").change(function() {
                                    var val = $(this).val();
                                    if (val == "select") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Category</option>");
                                    }

                                    // HUMAN DATA
                                    else if (val == "name") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                                    "<option value='first'>First Name</option>"+
                                                                                    "<option value='male'>First Name - Male</option>"+
                                                                                    "<option value='female'>First Name - Female</option>"+
                                                                                    "<option value='last'>Last Name</option>");
                                    } 
                                    else if (val == "phone") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                                    "<option value='us'>US</option>"+
                                                                                    "<option value='uk'>UK</option>"+
                                                                                    "<option value='comboPhones'>Combination of both</option>");
                                    } 
                                    else if (val == "extension") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                                    "<option value='three'>3 Digit</option>"+
                                                                                    "<option value='four'>4 Digit</option>"+
                                                                                    "<option value='five'>5 Digit</option>"+
                                                                                    "<option value='comboExt'>Combination of all three</option>");
                                    } 
                                    else if (val == "email") {
                                        $("#Data-<?php echo $count; ?>").html("<option>No Additional Selectors</option>");
                                    } 
                                    else if (val == "date") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
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
                                        $("#Data-<?php echo $count; ?>").html("<option>No Additional Selectors</option>");
                                    }
                                    else if (val == "city") {
                                        $("#Data-<?php echo $count; ?>").html("<option>No Additional Selectors</option>");
                                    }
                                    else if (val == "state") {
                                        $("#Data-<?php echo $count; ?>").html("<option>No Additional Selectors</option>");
                                    }
                                    else if (val == "zip") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                            "<option value='fiveDigit'>5 Digit</option>"+
                                                                            "<option value='plusExtension'>5 Digit + 4 Ext</option>"+
                                                                            "<option value='comboZips'>Combination of both</option>");
                                    }

                                    // TEXT DATA
                                    else if (val == "text") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                            "<option value='fixed'>Fixed number of words</option>"+
                                                                            "<option value='random'>Random number of words</option>"+
                                                                            "<option value='customText'>Custom text</option>");
                                    } 

                                    // NUMERIC DATA
                                    else if (val == "numeric") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                            "<option value='fixed'>Number of fixed length</option>"+
                                                                            "<option value='random'>Number of random length</option>"+
                                                                            "<option value='customNumber'>Custom number</option>");
                                    } 

                                    // OTHER DATA
                                    else if (val == "other") {
                                        $("#Data-<?php echo $count; ?>").html("<option>Select a Data Type</option>"+
                                                                            "<option value='customList'>Custom List</option>");
                                    }
                                });
                        </script>
                        
                        <!--Options input-->
                        <?php
                        echo'<td>';

                        echo '<input type="text" id="Custom-'.$count.'" class="form-control form-control-text" name="Custom-'.$count.'" />';

                        echo '<div class="date-form" id="DateSelector-'.$count.'">
    
                                    <div class="form-horizontal">
                                        <div class="control-group">
                                            
                                            <div class="controls">
                                                <div class="input-group">
                                                    <input id="DateRange1-'.$count.'" name="DateRange1-'.$count.'" type="text" class="date-picker form-control form-control-date" />
                                                    <label for="DateRange1-'.$count.'" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                                    </label>
                                                    <input id="DateRange2-'.$count.'" name="DateRange2-'.$count.'" type="text" class="date-picker form-control form-control-date" />
                                                    <label for="DateRange2-'.$count.'" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                                    </label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>';

                        echo '</td>';
                        ?>

                        <!--Dynamic JS settings for Options input-->
                        <script type="text/javascript">
                                
                                $("#Data-<?php echo $count; ?>").change(function() {
                                    var dataVal = $(this).val();
                                    if (dataVal == "mmddyyyyRange" || dataVal == "ddmmyyyyRange" || dataVal == "monthdayyearRange" || dataVal == "daymonthyearRange") {
                                        $("#Custom-<?php echo $count; ?>").hide();
                                        $("#DateSelector-<?php echo $count; ?>").show();
                                        $("#DateRange1-<?php echo $count; ?>").datepicker();
                                        $("#DateRange2-<?php echo $count; ?>").datepicker();
                                        
                                    }
                                    else if (dataVal == "customDate") {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").removeAttr("disabled");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "Enter custom date");
                                    }
                                    else if (dataVal == "customText") {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").removeAttr("disabled");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "Enter custom text");
                                    }
                                    else if (dataVal == "customNumber") {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").removeAttr("disabled");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "Enter custom number");
                                    }
                                    else if (dataVal == "fixed") {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").removeAttr("disabled");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "Enter number length");
                                    }
                                    else if (dataVal == "customList") {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").removeAttr("disabled");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "Separate list items with a  |");
                                    }
                                    else {
                                        $("#DateSelector-<?php echo $count; ?>").hide();
                                        $("#Custom-<?php echo $count; ?>").show();
                                        $("#Custom-<?php echo $count; ?>").attr("disabled", "disabled").val("");
                                        $("#Custom-<?php echo $count; ?>").attr("placeholder", "");
                                    }
                                }).trigger('change');

                        </script>

                        <!--Delete individual column-->
                        <?php
                        if ($count == 0){
                            echo'<td><i class="fa fa-times" aria-hidden="true" style="color: lightgrey;"></i></td>';
                        }
                        else {
                            echo'<td><a href="#" class="removeRow"><i class="fa fa-times" aria-hidden="true" style="color: red;"></i></a></td>';
                        }
                    echo'</tr>';
                $count++;
                }
                
                ?>
                
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
    
    <div class="clearfix"></div>

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
                            <li>Allow user to select random length ranges.</li>
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
                1.0.0 | <a data-toggle="modal" href="#documentation">Documentation</a>
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