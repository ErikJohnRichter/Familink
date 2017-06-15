<?php
$start = $_GET["cal-event-start"] ;
$ends = $_GET["cal-event-start"] ;
$name = $_GET["cal-event-name"] ;
$time = $_GET["cal-event-time"] ;
$ampm = $_GET["cal-event-am-pm"] ;
$description = str_replace("<br />", " ",$_GET['cal-event-description']);
$location = $_GET["cal-event-location"] ;

$offset = 0;
$hours = substr($time, 0, -3);
$halfHour = $rest = substr($time, -2, 1);
$hourFraction = 0;
if ($halfHour == 3) {
	$hourFraction = 1800;
}

if ($ampm == "AM") {
	$offset = 6+$hours;
}
elseif ($ampm == "PM") {
	if ($hours == 12) {
		$offset = 18;
	}
	else {
		$offset = 18+$hours;
	}
	
}
$uid = rand();
 
class ICS {
    var $data;
    var $name;

    function ICS($offset,$hourFraction,$uid,$start,$end,$name,$description,$location) {
        $this->name = $name;
        $this->data = "BEGIN:VCALENDAR\nVERSION:2.0\nMETHOD:PUBLISH\nBEGIN:VEVENT\nDTSTART:".date("Ymd\THis\Z",strtotime($start)+ ((($offset-1) * 3600)+$hourFraction))."\nDTEND:".date("Ymd\THis\Z",strtotime($end)+ ((($offset+2) * 3600)+$hourFraction))."\nLOCATION:".$location."\nTRANSP: OPAQUE\nSEQUENCE:0\nUID:".$uid."\nDTSTAMP:".date("Ymd\THis\Z")."\nSUMMARY:".$name."\nDESCRIPTION:".$description."\nPRIORITY:1\nCLASS:PUBLIC\nBEGIN:VALARM\nTRIGGER:-PT60M\nACTION:DISPLAY\nDESCRIPTION:Reminder\nEND:VALARM\nEND:VEVENT\nEND:VCALENDAR\n";
    }
    function save() {
        file_put_contents($this->name.".ics",$this->data);
    }
    function show() {
        header("Content-type:text/calendar");
        header('Content-Disposition: attachment; filename="'.$this->name.'.ics"');
        //Header('Content-Length: '.strlen($this->data));
        //Header('Connection: close');
        echo $this->data;
    }
}
$event = new ICS($offset,$hourFraction,$uid,$start,$ends,$name,$description,$location);
$event->show();
echo $start
 
?>