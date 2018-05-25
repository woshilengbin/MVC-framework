<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:18:03
 * @version $Id$
 */
/* load the HMVC_Router class */
require APPPATH . 'third_party/MX/Loader.php';

class MY_loader extends MX_Loader
{

    protected $_ci_services = array();
    protected $_ci_service_paths = array();

    function __construct()
    {
        parent::__construct();
        $this->_ci_service_paths = array(APPPATH);
    }


    public function service($service = '', $modules, $params = null, $object_name = null)
    {
        if (is_array($service)) {
            foreach ($service as $key => $class) {
                $this->service($class, $params);
            }
            return;
        }
        if ($service == '' or isset($this->_ci_services[$service])) {
            return false;
        }
        if (!is_null($params) && !is_array($params)) {
            $params = null;
        }
        $subdir = '';
        if (($last_slash = strrpos($service, '/')) !== false) {
            $subdir = substr($service, 0, $last_slash + 1);
            $service = substr($service, $last_slash + 1);
        }
        foreach ($this->_ci_service_paths as $path) {
            $filePath = $path .'modules/'.$modules. '/services/' . $subdir . $service . '.php';
            if (!file_exists($filePath)) {
                continue;
            }
            include_once($filePath);
            $service = strtolower($service);
            if (empty($object_name)) {
                $object_name = $service;
            }
            $service = ucfirst($service);
            $CI = &get_instance();
            if ($params !== null) {
                $CI->$object_name = new $service($params);
            } else {
                $CI->$object_name = new $service();
            }
            $this->_ci_services[] = $object_name;
            return;
        }
    }
}