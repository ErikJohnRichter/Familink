<?php
$date = date("Y-m-d H:i:s");
header('Content-Disposition: attachment;filename="data-'.$date.'.csv"');


date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/London');

include "csv.php";

/** PHPExcel_IOFactory */
require_once 'Classes/PHPExcel/IOFactory.php';


// If you're serving to IE 9, then the following may be needed

// If you're serving to IE over SSL, then the following may be needed

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter(',')
                                                                  ->setEnclosure('"')
                                                                  ->setSheetIndex(0)
                                                                  ->save('php://output');
exit;


echo date('H:i:s') , " Read from CSV format" , EOL;
$callStartTime = microtime(true);
$objReader = PHPExcel_IOFactory::createReader('CSV')->setDelimiter(',')
                                                    ->setEnclosure('"')
                                                    ->setSheetIndex(0);
$objPHPExcelFromCSV = $objReader->load(str_replace('.php', '.csv', __FILE__));

$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo 'Call time to reload Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter2007 = PHPExcel_IOFactory::createWriter($objPHPExcelFromCSV, 'Excel2007');
$objWriter2007->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;
