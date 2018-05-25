<?php
/**
 * 业务层
 */
class CI_service
{

    function __construct()
    {
    }

    function __get($name)
    {
        // TODO: Implement __get() method.
        $CI = &get_instance();
        return $CI->$name;
    }
}

