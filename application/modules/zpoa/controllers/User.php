<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-24 09:52:54
 * @version $Id$
 */

class User extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->module('pcoa');
    }

    public function index()
    {
//        var_dump($this->model->get_index_info());
        echo 234234;
        die();
        $data['user_info'] = $this->model->get_index_info();
        $this->twig->display('zpoa/views/index/index.html', ['name' => $data]);
    }
}