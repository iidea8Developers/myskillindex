<?php
/* Usage: This service is used to send email in case of 

1. Critical System Failure such as DB connection not connecting
2. System emails to 

 Created by Pranab Pandey 
 Create Date : 26-03-2016

*/
// Include and configure log4php
include_once('../../lib/log4php/Logger.php');
Logger::configure('../../config/log_config.xml');

 
/**
 * This is a classic usage pattern: one logger object per class.
 */
class errMailService
{
    /** Holds the Logger. */
    private $log;
 
    /** Logger is instantiated in the constructor. */
    public function __construct()
    {
        // The __CLASS__ constant holds the class name, in our case "errMailService".
        // Therefore this creates a logger named "errMailService" (which we configured in the config file)
        $this->log = Logger::getLogger(__CLASS__);
    }
 
    /** Logger can be used from any member method. */
    public function go()
    {
        $this->log->info("We have liftoff.");
    }
}
 
$errMailService = new errMailService();
$errMailService->go();
?>