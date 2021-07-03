<?php

/**
 * Connecting with Database
 *
 * 
 *
 * PHP version 8.0.7
 *
 * @category  PHP
 * @author    Dumidu sanjeewa
 */

class connectDb
    {
        public $mysqlCon;

        public function __construct()
        {
            try {
                $this->mysqlCon = new mysqli(DB_SERVER, DB_USER, DB_PWD, DB_NAME);
                if ($this->mysqlCon->connect_error) {
                    throw new Exception("Failed to connect to MySQL: " . mysqli_connect_error());
                 }
            } catch (Exception $e) {
                throw $e;
                
            }
        }

    /**
     * This function get brand wise data
     *
     * @param   string  $startDate Start date for get data
     * @param   string  $endDate   End date for get data
     * @return  array   array of data 
     * @throws  exception on failure
     */
        public function getBrandWiseData($startDate, $endDate)
        {
            try {
                $data = array();
                $query = "SELECT brands.name, CAST(gmv.date AS DATE), (gmv.turnover*0.79) AS finalturnover FROM brands LEFT JOIN gmv ON brands.id=gmv.brand_id WHERE gmv.date BETWEEN '".$startDate."' AND '".$endDate."'";
                $result = $this->mysqlCon->query($query);


            if ($result->num_rows > 0) {
                
                    while ($row = $result->fetch_assoc()) {
                        $data[] = array_values($row);
                    }
                }
                return $data;
            } catch (Exception $e) {
                throw $e;
            }
        }        

    /**
     * This function get day wise data
     *
     * @param   string  $startDate Start date for get data
     * @param   string  $endDate   End date for get data
     * @return  array   array of data 
     * @throws  exception on failure
     */
        public function getDayWiseData($startDate, $endDate)
        {
            try {
                $data = array();
                $query = "SELECT CAST(date AS DATE),SUM(turnover*0.79) AS finalturnover FROM gmv WHERE date BETWEEN '".$startDate."' AND '".$endDate."' GROUP BY date";
                $result = $this->mysqlCon->query($query);


            if ($result->num_rows > 0) {
                
                    while ($row = $result->fetch_assoc()) {
                        $data[] = array_values($row);
                    }
                }

                return $data;
            } catch (Exception $e) {
                throw $e;
            }
        }


    }
?>

