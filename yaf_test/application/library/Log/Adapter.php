<?php
/**
 * 日志操作
 * @author  luq
 * @date    2014-07-20
 * <code>
 * <?php
 *  $logger = Yaf_Registry::get("logger");
 *
 *  $logger->debug("check it out");
 *  $logger->warning("you have a emergency");  
 *  $logger->err("something terrible happened");  
 *  $logger->info("bye!");  
 * ?>
 * </code>
*/

require "Log.php";

class Log_Adapter extends Log 
{
 
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }
 
}

?>
