<?php

/**
 * Writing all logs data
 *
 * 
 *
 * PHP version 8.0.7
 *
 * @category  PHP
 * @author    Dumidu sanjeewa
 */

class logHelper
    {
        private $logFile;

        public function __construct()
        {
            try {
                if(is_writable(LOG_BASE)){
                    $this->logFile = LOG_BASE.'/' . date('Y-m-d') . '.log';
                   }else{
                    die ('Permission need to write logs');
                }
                
            } catch (Exception $e) {
                throw $e;
                
            }
        }

    /**
     * This function write logs to file
     *
     * @param   string  $type     type of log 'info' or 'error'
     * @param   string  $message  Message that need to write in file
     * @return  no return
     * @throws  exception on failure
     */
        public function write($type,$message)
        {
            try {
                file_put_contents($this->logFile, date("H:i:s").' | '.$type.' | '.$message. "\n", FILE_APPEND);
                
            } catch (Exception $e) {
                throw $e;
                
            }
        }

        public function info($message)
        {
            try {
                $this->write('info',$message);
                
            } catch (Exception $e) {
                throw $e;
                
            }
        }

        public function error($message)
        {
            try {
                $this->write('error',$message);
                
            } catch (Exception $e) {
                throw $e;
                
            }
        }
}
?>