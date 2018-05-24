<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-05-24 09:52:54
 * @version $Id$
 */

class Index extends CI_Controller {
    
    function __construct(){
        parent::__construct();
    }
    public function index()
    {
    	$this->twig->display('index/index.html', ['name' => 'Welcome to CodeIgniter!This is from Twig']);
    	// $this->load->view('index/index');
    }
}