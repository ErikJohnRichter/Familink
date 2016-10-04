<?php

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Data Generator")
							 ->setTitle("Data List");
							 
require("common.php"); 

$link = mysql_connect($host, $username, $password);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
}

$db_selected = mysql_select_db($dbname, $link);

if (!$link) {
  die("Sorry, there was an error. Please try again.");
}


$objPHPExcel->setActiveSheetIndex(0);
$totalColumns = $_POST['totalColumnsInTable'];
$totalRowsRequested = $_POST['totalRowsToGenerate'];

for ($dataColumn = 0; $dataColumn <= $totalColumns; $dataColumn++) {
    
    
    $columnTitle = $_POST['Title-'.$dataColumn.''];
    $dataType = $_POST['Type-'.$dataColumn.''];
    $data = $_POST['Data-'.$dataColumn.''];
    $custom = $_POST['Custom-'.$dataColumn.''];
    $date1 = $_POST['DateRange1-'.$dataColumn.''];
    $date2 = $_POST['DateRange2-'.$dataColumn.''];
    
    if (1==1) {

        
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, 1, "".$columnTitle."");

        if ($dataType == "name") {

            if ($data == "first" || $data == "last") {

                $sql = "SELECT COUNT(*) FROM data_generator.".$dataType.";";
                $result = mysql_query($sql);
                $totalInDatabase = mysql_result($result, 0);

                if ($totalRowsRequested <= $totalInDatabase){
                    $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                    $result = mysql_query("$sql");
                    $rowCount = 2;
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$data]."");
                    	$rowCount++;
                    }
                }
                else {
                    $remainder = $totalRowsRequested % $totalInDatabase;
                    $remainder = $remainder+2;
                    $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                    
                    for ($x = 0; $x < $timesMultiplied; $x++ ) {
                        $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                        $result = mysql_query("$sql");
                        $rowCount = 2+($x*$totalInDatabase);
                        while($row = mysql_fetch_assoc($result)) {
                        	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$data]."");
                        	$rowCount++;
                        }
                    }
                    $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                    $result = mysql_query("$sql");
                    $remainingRows = $timesMultiplied*$totalInDatabase;
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $remainingRows, "".$row[$data]."");
                        $remainingRows++;
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
                    $rowCount = 2;
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$data]."");
                        $rowCount++;
                    }
                }
                else {
                    $remainder = $totalRowsRequested % $totalInDatabase;
                    $remainder = $remainder+2;
                    $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                    
                    for ($x = 0; $x < $timesMultiplied; $x++ ) {
                        $sql = "SELECT * FROM data_generator.`gender_name` ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                        $result = mysql_query("$sql");
                        $rowCount = 2+($x*$totalInDatabase);
                        while($row = mysql_fetch_assoc($result)) {
                        	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$data]."");
                        	$rowCount++;
                        }
                    }
                    $sql = "SELECT * FROM data_generator.`gender_name` ORDER BY RAND() LIMIT 0,".$remainder.";";
                    $result = mysql_query("$sql");
                    $remainingRows = $timesMultiplied*$totalInDatabase;
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $remainingRows, "".$row[$data]."");
                        $remainingRows++;
                    }
                }
            }
        }

        elseif ($dataType == "phone") {

            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                
                if ($data == "us") {
                    $areaCode = rand(111,999);
                    $prefix = rand(111,999);
                    $line = rand(1111,9999);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "(".$areaCode.") ".$prefix."-".$line."");
                }
                elseif ($data == "uk") {
                    $areaCode = rand(11,99);
                    $prefix = rand(1111,9999);
                    $line = rand(1111,9999);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "0".$areaCode." ".$prefix." ".$line."");
                }
                else {
                    $chance = rand(1,2);
                    if ($chance == 1) {
                        $areaCode = rand(111,999);
                        $prefix = rand(111,999);
                        $line = rand(1111,9999);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "(".$areaCode.") ".$prefix."-".$line."");
                    }
                    else {
                        $areaCode = rand(11,99);
                        $prefix = rand(1111,9999);
                        $line = rand(1111,9999);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "0".$areaCode." ".$prefix." ".$line."");
                    }
                }
            }
        }

        elseif ($dataType == "extension") {

            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == "three") {
                    $extension = rand(111,999);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                }
                elseif ($data == "four") {
                    $extension = rand(1111,9999);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                }
                elseif ($data == "five") {
                    $extension = rand(11111,99999);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                }
                else {
                    $chance = rand(3,5);
                    if ($chance == 3) {
                        $extension = rand(111,999);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                    }
                    elseif ($chance == 4) {
                        $extension = rand(1111,9999);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                    }
                    else {
                        $extension = rand(11111,99999);
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$extension."");
                    }
                }
            }
        }

        elseif ($dataType == "email") {

            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                $length1 = rand(2,6);
                $length2 = rand(2,8);
                $length3 = rand(2,8);
                $string1 = randomString($length1);
                $string2 = randomString($length2);
                $string3 = randomString($length3);
                $array = array(".com", ".net", ".co.uk", ".org");
                $domain = $array[mt_rand(0, count($array) - 1)];
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1.".".$string2."@".$string3.$domain."");
            }

        }

        elseif ($dataType == "date") {
            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == "mmddyyyy") {
                	$date = date('m/d/Y');
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "ddmmyyyy") {
                    $date = date('d/m/Y');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "monthdayyear") {
                    $date = date('F d Y');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "daymonthyear") {
                    $date = date('d F Y');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "mmddyyyyRange") {
                    $startDate = strtotime($date1);
                    $endDate = strtotime($date2);
                    $randomDate = mt_rand($startDate, $endDate);
                    
                    $date = date('m/d/Y',$randomDate);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "ddmmyyyyRange") {
                    $startDate = strtotime($date1);
                    $endDate = strtotime($date2);
                    $randomDate = mt_rand($startDate, $endDate);
                    
                    $date = date('d/m/Y',$randomDate);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "monthdayyearRange") {
                    $startDate = strtotime($date1);
                    $endDate = strtotime($date2);
                    $randomDate = mt_rand($startDate, $endDate);
                    
                    $date = date('F d Y',$randomDate);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                elseif ($data == "daymonthyearRange") {
                    $startDate = strtotime($date1);
                    $endDate = strtotime($date2);
                    $randomDate = mt_rand($startDate, $endDate);
                    
                    $date = date('d F Y',$randomDate);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$date."");
                }
                else {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$custom."");
                }
            }
        }

        elseif ($dataType == "address") {

            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                $chance = rand(1,20);
                if ($chance > 5) {
                    $length1 = rand(3,5);
                    $length2 = rand(5,10);
                    $string1 = randomNumber($length1);
                    $string2 = randomWord($length2);
                    $string2 = ucfirst($string2);
                    $array = array("Street", "Place", "Road", "Drive", "Parkway", "Avenue");
                    $road = $array[mt_rand(0, count($array) - 1)];
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1." ".$string2." ".$road."");
                }
                else {
                    $length1 = rand(3,5);
                    $string1 = randomNumber($length1);
                    $array1 = array("1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th", "9th", "10th");
                    $array2 = array("Street", "Avenue");
                    $number = $array1[mt_rand(0, count($array1) - 1)];
                    $road = $array2[mt_rand(0, count($array2) - 1)];
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1." ".$number." ".$road."");
                }
            }
        }

        elseif ($dataType == "city") {

            $sql = "SELECT COUNT(*) FROM data_generator.".$dataType.";";
            $result = mysql_query($sql);
            $totalInDatabase = mysql_result($result, 0);

            if ($totalRowsRequested <= $totalInDatabase){
                $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalRowsRequested.";";
                $result = mysql_query("$sql");
                $rowCount = 2;
                while($row = mysql_fetch_assoc($result)) {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$dataType]."");
                    $rowCount++;
                }
            }
            else {
                $remainder = $totalRowsRequested % $totalInDatabase;
                $remainder = $remainder+2;
                $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                
                for ($x = 0; $x < $timesMultiplied; $x++ ) {
                    $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                    $result = mysql_query("$sql");
                    $rowCount = 2+($x*$totalInDatabase);
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$dataType]."");
                    	$rowCount++;
                    }
                }
                $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                $result = mysql_query("$sql");
                $remainingRows = $timesMultiplied*$totalInDatabase;
                while($row = mysql_fetch_assoc($result)) {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $remainingRows, "".$row[$dataType]."");
                    $remainingRows++;
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
                $rowCount = 2;
                while($row = mysql_fetch_assoc($result)) {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$dataType]."");
                    $rowCount++;
                }
            }
            else {
                $remainder = $totalRowsRequested % $totalInDatabase;
                $remainder = $remainder+2;
                $timesMultiplied = (int)($totalRowsRequested/$totalInDatabase);
                
                for ($x = 0; $x < $timesMultiplied; $x++ ) {
                    $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$totalInDatabase.";";
                    $result = mysql_query("$sql");
                    $rowCount = 2+($x*$totalInDatabase);
                    while($row = mysql_fetch_assoc($result)) {
                    	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $rowCount, "".$row[$dataType]."");
                    	$rowCount++;
                    }
                }
                $sql = "SELECT * FROM data_generator.".$dataType." ORDER BY RAND() LIMIT 0,".$remainder.";";
                $result = mysql_query("$sql");
                $remainingRows = $timesMultiplied*$totalInDatabase;
                while($row = mysql_fetch_assoc($result)) {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $remainingRows, "".$row[$dataType]."");
                    $remainingRows++;
                }
            }
        }

        elseif ($dataType == "zip") {

            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == "fiveDigit") {
                    $string1 = randomNumber('5');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1."");
                }
                elseif ($data == "plusExtension") {
                    $string1 = randomNumber('5');
                    $string2 = randomNumber('4');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1."-".$string2."");
                }
                else {
                    $chance = rand(1,10);
                    if ($chance > 2) {
                        $string1 = randomNumber('5');
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1."");
                    }
                    else {
                        $string1 = randomNumber('5');
                        $string2 = randomNumber('4');
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$string1."-".$string2."");
                    }
                }
            }
        }

        elseif ($dataType == "text") {
            require_once 'LoremIpsum.class.php';
            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == 'fixed') {
                    $length = $custom;
                    $generatorFixed = new LoremIpsumGenerator;
                    $htmlformat = $generatorFixed->getContent($length);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, ""."$htmlformat"."");
                }
                elseif ($data == "random") {
                    $length = rand(50,500);
                    $generatorRandom = new LoremIpsumGenerator;
                    $htmlformat = $generatorRandom->getContent($length);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, ""."$htmlformat"."");
                }
                else {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$custom."");
                }
            }
        }

        elseif ($dataType == "numeric") {
            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == "fixed") {
                    $length = $custom;
                    $number = randomNumber($length);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$number."");
                }
                elseif ($data == "random") {
                    $number = rand();
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$number."");
                }
                else {
                	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$custom."");
                }
            }
        }

        elseif ($dataType == "other") {
            $string = $custom;
            $wordArray = explode("|", $string);
            $length = count($wordArray);
            $length = $length-1;
            
            for ($x = 2; $x < ($totalRowsRequested+2); $x++) {
                if ($data == "customList") {
                    $chance = mt_rand(0,$length);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($dataColumn, $x, "".$wordArray[$chance]."");
                }
            }
        }
    }
    
}


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

?>