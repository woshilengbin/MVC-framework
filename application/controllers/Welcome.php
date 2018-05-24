<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->service('welcome_service');
	}

	public function index()
	{
	    // log_message('debug','are you funking kidding me!');
		$name= 'trest';
		$pwd = '123';
		$data['user_info'] = $this->welcome_service->index();
		 // $this->twig->display('welcome_message.html', ['name' => 'Welcome to CodeIgniter!This is from Twig']);
		$this->load->view('welcome_message',$data);
	}
}
