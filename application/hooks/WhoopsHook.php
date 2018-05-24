<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 15:15:59
 * @version $Id$
 */

class WhoopsHook{
    
   public function bootWhoops()
   {
   		$whoops = new \Whoops\Run;
   		$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
   		$whoops->register();
   }
}