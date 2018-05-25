<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:54:15
 * @version $Id$
 */

include_once(APPPATH . 'core/CI_service.php');

class Index_Service extends CI_service
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Article');
    }

    public function index()
    {
        $info = $this->Article->get_index_info();
        return $info;
    }
}