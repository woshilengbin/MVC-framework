<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 16:31:51
 * @version $Id$
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class MonologHook{
    
   public function monolog()
   {
   		$log = new Logger('name');
		$log->pushHandler(new StreamHandler(APPPATH.'/logs/monolog/log.log', Logger::WARNING));
		// $log->warning('Foo');
   }
}