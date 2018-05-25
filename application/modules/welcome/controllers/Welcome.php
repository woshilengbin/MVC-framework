<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends MX_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->service('welcome_service');
    }

    public function index()
    {
        // log_message('debug','are you funking kidding me!');
        $data['user_info'] = $this->welcome_service->index();
        $this->twig->display('welcome_message.html', ['name' => $data]);
    }
}
