<?php

/**
 * Report related main function goes here
 *
 *
 * PHP version 8.0.7
 *
 * @category  PHP
 * @author    Dumidu sanjeewa
 */

class report
    {
        public $dbCon;

        public function __construct()
        {
            try {      
             $this->dbCon = new connectDb();

            } catch (Exception $e) {
                throw $e;
                
            }
        }
    /**
     * This function related to get data from DB and pass to export csv
     *
     * @param   string  $reportType  type of the report
     * @param   string  $startDate   report start date
     * @param   string  $endDate     report end date
     * @return  No return 
     * @throws  exception on failure
     */
        public function genReport($reportType, $startDate, $endDate)
        {
            try {
                if($reportType=="brandwise"){
                    $data = $this->dbCon->getBrandWiseData($startDate, $endDate);
                    if(!empty($data)){
                        $this->exportCsv(array('Brand Name','Date','Turnover'),$data,'brandwise');
                    }else{
                        throw new Exception("Data not found related to the request");
                    }
                }else{
                    $data = $this->dbCon->getDayWiseData($startDate, $endDate);
                    if(!empty($data)){
                        $this->exportCsv(array('Date','Total Turnover'),$data,'daywise');
                    }else{
                        throw new Exception("Data not found related to the request");
                    }
                }
            } catch (Exception $e) {
                throw $e;
            }
        }

    /**
     * This function related download csv file
     *
     * @param   array  $headers     CSV Heading names array
     * @param   array  $dataArray   CSV data array
     * @param   string $filename    CSV file name
     * @return  No return 
     * @throws  exception on failure
     */
        public function exportCsv($headers, $dataArray, $filename) {
            try {
                $filename = $filename . ' - ' . date('Y M d') . ' at ' . date('g.i a');
                $dataArray = array('-1' => $headers) + $dataArray;
                header('Content-Type: text/csv; charset=utf-8');
                header('Content-Disposition: attachment; filename="' . str_replace('"', '\\"', $filename) . '.csv"');
                $outstream = fopen("php://output", "w");

                function __outputCSV(&$vals, $key, $filehandler) {
                    fputcsv($filehandler, $vals);
                }

                array_walk($dataArray, "__outputCSV", $outstream);
                fclose($outstream);
                die();
            } catch (Exception $e) {
                throw $e;
            }
        }

    }
?>

