<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--TODO title will be table name-->
    <title>Your Data</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">


    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster|Comfortaa|Amatic+SC|Coming+Soon|Architects+Daughter' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body>
    <div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

    <!--<form action="generate.php" method="post" id="return" enctype="multipart/form-data">-->
            <div class="col-md-12">
                <a href="generate.php"><button class="btn btn-default btn-info" id="return">New Data</button></a>
            </div>
    <!--</form>-->

    <?php
        require("common.php"); 

        $link = mysql_connect($host, $username, $password);

        if (!$link) {
          die("Sorry, there was an error. Please try again.");
        }

        $db_selected = mysql_select_db($dbname, $link);

        if (!$link) {
          die("Sorry, there was an error. Please try again.");
        }
        echo '<div class=container-fluid>';
        $totalColumns = $_POST['totalColumnsInTable'];
        $totalColumns = $totalColumns-1;
        $totalRowsRequested = $_POST['totalRowsToGenerate'];
        for ($dataRow = 0; $dataRow <= $totalColumns; $dataRow++) {

            $columnTitle = $_POST['Title-'.$dataRow.''];
            $dataType = $_POST['Type-'.$dataRow.''];
            $data = $_POST['Data-'.$dataRow.''];
            $custom = $_POST['Custom-'.$dataRow.''];
            $date1 = $_POST['DateRange1-'.$dataRow.''];
            $date2 = $_POST['DateRange2-'.$dataRow.''];
            $number1 = $_POST['NumberRange1-'.$dataRow.''];
            $number2 = $_POST['NumberRange2-'.$dataRow.''];
            
            if ($dataType != "select") {

                echo '<div class="col-md-2">';
                echo '<strong>'.$columnTitle.'</strong>';
                echo '<br>';

                if ($dataType == "name") {

                    if ($data == "first" || $data == "last") {

                        $sql = "SELECT COUNT(*) FROM data_generator.".$dataType.";";
                        $result = mysql_query($sql);
                        $totalInDatabase = mysql_result($result, 0);

                        if ($totalRowsRequested <= $totalInDatabase){
                            $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$data];
                                echo '<br>';
                            }
                        }
                        else {
                            $remainder = $totalRowsRequested % $totalInDatabase;
                            $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                            
                            for ($x = 0; $x < $timesMultiplied; $x++ ) {
                                $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                                $result = mysql_query("$sql");
                                while($row = mysql_fetch_assoc($result)) {
                                    echo $row[$data];
                                    echo '<br>';
                                }
                            }
                            $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$data];
                                echo '<br>';
                            }
                        }
                    }
                    else {

                        $sql = "SELECT COUNT(*) FROM data_generator.`gender_name`;";
                        $result = mysql_query($sql);
                        $totalInDatabase = mysql_result($result, 0);

                        if ($totalRowsRequested <= $totalInDatabase){
                            $sql = "SELECT * FROM data_generator.`gender_name` ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$data];
                                echo '<br>';
                            }
                        }
                        else {
                            $remainder = $totalRowsRequested % $totalInDatabase;
                            $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                            
                            for ($x = 0; $x < $timesMultiplied; $x++ ) {
                                $sql = "SELECT * FROM data_generator.`gender_name` ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                                $result = mysql_query("$sql");
                                while($row = mysql_fetch_assoc($result)) {
                                    echo $row[$data];
                                    echo '<br>';
                                }
                            }
                            $sql = "SELECT * FROM data_generator.`gender_name` ORDER BY RAND() LIMIT 0,".$remainder.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$data];
                                echo '<br>';
                            }
                        }
                    }
                }

                elseif ($dataType == "phone") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        
                        if ($data == "us") {
                            $areaCode = rand(111,999);
                            $prefix = rand(111,999);
                            $line = rand(1111,9999);
                            echo "(".$areaCode.") ".$prefix."-".$line;
                        }
                        elseif ($data == "uk") {
                            $areaCode = rand(11,99);
                            $prefix = rand(1111,9999);
                            $line = rand(1111,9999);
                            echo "0".$areaCode." ".$prefix." ".$line;
                        }
                        else {
                            $chance = rand(1,2);
                            if ($chance == 1) {
                                $areaCode = rand(111,999);
                                $prefix = rand(111,999);
                                $line = rand(1111,9999);
                                echo "(".$areaCode.") ".$prefix."-".$line;
                            }
                            else {
                                $areaCode = rand(11,99);
                                $prefix = rand(1111,9999);
                                $line = rand(1111,9999);
                                echo "0".$areaCode." ".$prefix." ".$line;
                            }
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "extension") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == "three") {
                            $extension = rand(111,999);
                            echo $extension;
                        }
                        elseif ($data == "four") {
                            $extension = rand(1111,9999);
                            echo $extension;
                        }
                        elseif ($data == "five") {
                            $extension = rand(11111,99999);
                            echo $extension;
                        }
                        else {
                            $chance = rand(3,5);
                            if ($chance == 3) {
                                $extension = rand(111,999);
                                echo $extension;
                            }
                            elseif ($chance == 4) {
                                $extension = rand(1111,9999);
                                echo $extension;
                            }
                            else {
                                $extension = rand(11111,99999);
                                echo $extension;
                            }
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "email") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        $length1 = rand(2,6);
                        $length2 = rand(2,8);
                        $length3 = rand(2,8);
                        $string1 = randomString($length1);
                        $string2 = randomString($length2);
                        $string3 = randomString($length3);
                        $array = array(".com", ".net", ".co.uk", ".org");
                        $domain = $array[mt_rand(0, count($array) - 1)];
                        echo $string1.".".$string2."@".$string3.$domain;
                        echo '<br>';
                    }
                }

                elseif ($dataType == "date") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == "mmddyyyy") {
                            echo date('m/d/Y');
                        }
                        elseif ($data == "ddmmyyyy") {
                            echo date('d/m/Y');
                        }
                        elseif ($data == "monthdayyear") {
                            echo date('F d, Y');
                        }
                        elseif ($data == "daymonthyear") {
                            echo date('d F Y');
                        }
                        elseif ($data == "mmddyyyyRange") {
                            $startDate = strtotime($date1);
                            $endDate = strtotime($date2);
                            $randomDate = mt_rand($startDate, $endDate);
                            
                            echo date('m/d/Y',$randomDate);
                        }
                        elseif ($data == "ddmmyyyyRange") {
                            $startDate = strtotime($date1);
                            $endDate = strtotime($date2);
                            $randomDate = mt_rand($startDate, $endDate);
                            
                            echo date('d/m/Y',$randomDate);
                        }
                        elseif ($data == "monthdayyearRange") {
                            $startDate = strtotime($date1);
                            $endDate = strtotime($date2);
                            $randomDate = mt_rand($startDate, $endDate);
                            
                            echo date('F d, Y',$randomDate);
                        }
                        elseif ($data == "daymonthyearRange") {
                            $startDate = strtotime($date1);
                            $endDate = strtotime($date2);
                            $randomDate = mt_rand($startDate, $endDate);
                            
                            echo date('d F Y',$randomDate);
                        }
                        else {
                            echo $custom;
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "address") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        $chance = rand(1,20);
                        if ($chance > 5) {
                            $length1 = rand(3,5);
                            $length2 = rand(5,10);
                            $string1 = randomNumber($length1);
                            $string2 = randomWord($length2);
                            $string2 = ucfirst($string2);
                            $array = array("Street", "Place", "Road", "Drive", "Parkway", "Avenue");
                            $road = $array[mt_rand(0, count($array) - 1)];
                            echo $string1." ".$string2." ".$road;
                        }
                        else {
                            $length1 = rand(3,5);
                            $string1 = randomNumber($length1);
                            $array1 = array("1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th");
                            $array2 = array("Street", "Avenue");
                            $number = $array1[mt_rand(0, count($array1) - 1)];
                            $road = $array2[mt_rand(0, count($array2) - 1)];
                            echo $string1." ".$number." ".$road;
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "city") {

                    $sql = "SELECT COUNT(*) FROM data_generator.".$dataType.";";
                    $result = mysql_query($sql);
                    $totalInDatabase = mysql_result($result, 0);

                    if ($totalRowsRequested <= $totalInDatabase){
                        $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                        $result = mysql_query("$sql");
                        while($row = mysql_fetch_assoc($result)) {
                            echo $row[$dataType];
                            echo '<br>';
                        }
                    }
                    else {
                        $remainder = $totalRowsRequested % $totalInDatabase;
                        $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                        
                        for ($x = 0; $x < $timesMultiplied; $x++ ) {
                            $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$dataType];
                                echo '<br>';
                            }
                        }
                        $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                        $result = mysql_query("$sql");
                        while($row = mysql_fetch_assoc($result)) {
                            echo $row[$dataType];
                            echo '<br>';
                        }
                    }
                }

                elseif ($dataType == "state") {

                    $sql = "SELECT COUNT(*) FROM data_generator.".$dataType.";";
                    $result = mysql_query($sql);
                    $totalInDatabase = mysql_result($result, 0);

                    if ($totalRowsRequested <= $totalInDatabase){
                        $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                        $result = mysql_query("$sql");
                        while($row = mysql_fetch_assoc($result)) {
                            echo $row[$dataType];
                            echo '<br>';
                        }
                    }
                    else {
                        $remainder = $totalRowsRequested % $totalInDatabase;
                        $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                        
                        for ($x = 0; $x < $timesMultiplied; $x++ ) {
                            $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                            $result = mysql_query("$sql");
                            while($row = mysql_fetch_assoc($result)) {
                                echo $row[$dataType];
                                echo '<br>';
                            }
                        }
                        $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                        $result = mysql_query("$sql");
                        while($row = mysql_fetch_assoc($result)) {
                            echo $row[$dataType];
                            echo '<br>';
                        }
                    }
                }



                elseif ($dataType == "zip") {

                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == "fiveDigit") {
                            $string1 = randomNumber('5');
                            echo $string1;
                        }
                        elseif ($data == "plusExtension") {
                            $string1 = randomNumber('5');
                            $string2 = randomNumber('4');
                            echo $string1."-".$string2;
                        }
                        else {
                            $chance = rand(1,10);
                            if ($chance > 2) {
                                $string1 = randomNumber('5');
                                echo $string1;
                            }
                            else {
                                $string1 = randomNumber('5');
                                $string2 = randomNumber('4');
                                echo $string1."-".$string2;
                            }
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "text") {
                    require('LoremIpsum.class.php');
                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == 'fixed') {
                            $length = $custom;
                            $generator = new LoremIpsumGenerator;
                            $htmlformat = $generator->getContent($length);
                            echo "$htmlformat"; 
                        }
                        elseif ($data == "random") {
                            $lowNumber = $number1;
                            $highNumber = $number2;
                            $length = rand($lowNumber,$highNumber);
                            $generator = new LoremIpsumGenerator;
                            $htmlformat = $generator->getContent($length);
                            echo "$htmlformat"; 
                        }
                        else {
                            echo $custom;
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "numeric") {
                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == "fixed") {
                            $length = $custom;
                            $number = randomNumber($length);
                            echo $number; 
                        }
                        elseif ($data == "random") {
                            $lowNumber = $number1;
                            $highNumber = $number2;
                            $number = rand($lowNumber,$highNumber);
                            echo $number; 
                        }
                        else {
                            echo $custom;
                        }
                        echo '<br>';
                    }
                }

                elseif ($dataType == "other") {
                    $string = $custom;
                    $wordArray = explode("|", $string);
                    $length = count($wordArray);
                    $length = $length-1;
                    for ($x = 0; $x < $totalRowsRequested; $x++) {
                        if ($data == "customList") {
                            $chance = mt_rand(0,$length);
                            echo $wordArray[$chance];
                            echo '<br>';
                        }
                    }
                }
                
                echo '</div>';
            }
        }
        echo '</div>';

        function randomString($length) {
            $str = "";
            $characters = array_merge(range('a','z'));
            $max = count($characters) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $characters[$rand];
            }
            return $str;
        }

        function randomNumber($length) {
            $str = "";
            $numbers = array_merge(range(1,9));
            $max = count($numbers) - 1;
            for ($i = 0; $i < $length; $i++) {
                $rand = mt_rand(0, $max);
                $str .= $numbers[$rand];
            }
            return $str;
        }

        function randomWord( $length ) {
       
                // consonant sounds
                $cons = array(
                        // single consonants. Beware of Q, it's often awkward in words
                        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
                        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'z',
                        // possible combinations excluding those which cannot start a word
                        'pt', 'gl', 'gr', 'ch', 'ph', 'ps', 'sh', 'st', 'th', 'wh',
                );
               
                // consonant combinations that cannot start a word
                $cons_cant_start = array(
                        'ck', 'cm',
                        'dr', 'ds',
                        'ft',
                        'gh', 'gn',
                        'kr', 'ks',
                        'ls', 'lt', 'lr',
                        'mp', 'mt', 'ms',
                        'ng', 'ns',
                        'rd', 'rg', 'rs', 'rt',
                        'ss',
                        'ts', 'tch',
                );
               
                // wovels
                $vows = array(
                        // single vowels
                        'a', 'e', 'i', 'o', 'u', 'y',
                        // vowel combinations your language allows
                        'ee', 'oa', 'oo',
                );
               
                // start by vowel or consonant ?
                $current = ( mt_rand( 0, 1 ) == '0' ? 'cons' : 'vows' );
               
                $word = '';
                       
                while( strlen( $word ) < $length ) {
               
                        // After first letter, use all consonant combos
                        if( strlen( $word ) == 2 )
                                $cons = array_merge( $cons, $cons_cant_start );
         
                         // random sign from either $cons or $vows
                        $rnd = ${$current}[ mt_rand( 0, count( ${$current} ) -1 ) ];
                       
                        // check if random sign fits in word length
                        if( strlen( $word . $rnd ) <= $length ) {
                                $word .= $rnd;
                                // alternate sounds
                                $current = ( $current == 'cons' ? 'vows' : 'cons' );
                        }
                }
               
                return $word;
        }

        /*if (!mysql_query($sql)) {
            die('Error: ' . mysql_error()); 
        }*/

    ?>
     <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.3.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script src="js/masonry-docs.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/sweetalert.min.js"></script>

</body>
</html>