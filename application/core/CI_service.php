<?php
/**
 * 业务层
 */
class CI_service
{
	function __construct()
	{
		 log_message('debug', 'service class init');
	}
	public function __get($key)
	{
		$CI = & get_instance();
		return $CI->$key;
	}
}

