<?php

/**
 * This is the main entering point of the reporting system
 *
 * 
 *
 * PHP version 8.0.7
 *
 * @category  PHP
 * @author    Dumidu sanjeewa
 */
try {
  require_once '../src/packages.php';
  $log = new LogHelper();

  $reportType = trim($_GET['type']);
  $startDate = '2018-05-01'; // this will be hardcord because assignment have two dates only
  $endDate = '2018-05-07'; // this will be hardcord because assignment have two dates only

  /*
    When pass date as parameter we can validate using following
      if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
        {
          echo 'Date is valid';
        }else{
          echo 'Date is invalid';
        }
  */

  if(in_array($reportType, json_decode(REPORT_TYPE_JSON,true))){
    $reportObj = new report();
    $reportObj->genReport($reportType, $startDate, $endDate);
  }else{
    $log->error('Trying to request invalid report.');
    echo 'Sorry! You are trying to request invalid report';
  }
 
} catch (Exception $e) {
    $log->error($e->getMessage());
    echo 'Sorry! something goes wrong. Please try again later';
}




?>