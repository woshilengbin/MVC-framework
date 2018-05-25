<?php
/**
 * 
 * @authors Your Name (you@example.org)
 * @date    2018-05-24 09:52:54
 * @version $Id$
 */

class Index extends MX_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->service('index_service','pcoa');
    }
    public function index()
    {
        $data['user_info'] = $this->index_service->index();
        $this->twig->display('pcoa/views/index/index.html', ['name' => $data]);
    }
}