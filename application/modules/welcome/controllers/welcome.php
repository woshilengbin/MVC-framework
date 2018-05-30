<?php
/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/25
 * Time: 17:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Base
{

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->service('welcome', 'welcome_service');
    }

    public function index()
    {
        $this->config->load('pagination');
        $data = $this->welcome_service->getAll($this->input->get('per_page'), $this->config->item('per_page'));
        $this->load->library('pagination');
        $config['base_url'] = site_url() . '/welcome/index';
        $config['total_rows'] = $data['count'];
        $this->pagination->initialize($config);
        $data['page'] = $this->pagination->create_links();
        $this->twig->display('welcome/views/welcome_message.html', ['data' => $data, 'url' => site_url()]);
    }


    public function info()
    {
        $id = $this->input->get('id');
        $info = $this->welcome_service->get_article_info_by_id($id);
        $this->twig->display('welcome/views/info.html', ['info' => $info, 'url' => site_url()]);
    }

    function add()
    {
        $this->twig->display('welcome/views/add.html');
    }

    /**
     *
     */
    function doAdd()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Create a news item';
        $this->form_validation->set_rules('name', 'name', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->twig->display('welcome/views/add.html', ['data' => $data]);
        } else {
            $isAdd = $this->welcome_service->addNew($this->input->post());
            if ($isAdd) {
                redirect('welcome/index');
            } else {
                $this->twig->display('welcome/views/add.html', ['data' => $data]);
            }
        }
    }

    function update()
    {
        $info = $this->welcome_service->get_article_info_by_id($this->input->get('id'));
        $this->twig->display('welcome/views/update.html', ['article' => $info]);
    }

    function doUpdate()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Create a news item';
        $this->form_validation->set_rules('name', 'name', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->twig->display('welcome/views/add.html', ['data' => $data]);
        } else {
            $idUpdate = $this->welcome_service->updateArt($this->input->post());
            if ($idUpdate) {
                redirect('welcome/index');
//                redirect('welcome/update?id=' . $this->input->post('id'));
            } else {
                redirect('welcome/update?id=' . $this->input->post('id'));
            }
        }
    }

    function delete()
    {
        $isDel = $this->welcome_service->deleteArt($this->input->get('id'));
        if ($isDel) {
            redirect('welcome/index');
        } else {
            echo 'errror!';
        }
    }

    public function get_welcome_info()
    {
        $user = $this->article->get_user_info_by_id(1);
        return $user;
    }

    public function runTest()
    {
        echo '<h1>this is a run test!</h1>';
        $user = $this->article->get_user_info_by_id(1);
        $this->twig->display('welcome/views/welcome_message.html');
    }

    function logout()
    {

        $this->load->module('user/user');
        $list = $this->user->logout();
    }
}
