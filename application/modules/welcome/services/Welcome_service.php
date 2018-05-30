<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/28
 * Time: 9:58
 */
include_once APPPATH . 'core/MY_service.php';

class Welcome_service extends MY_Service
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article');
    }

    function getAll($per_page,$pageSize)
    {
        $all = $this->article->getAll($per_page,$pageSize);
        return $all;
    }

    function get_article_info_by_id($id)
    {
        $article = $this->article->getById($id);
        return $article;
    }

    public function addNew($data)
    {
        $isAdd = $this->article->addNew($data);
        return $isAdd;
    }

    function updateArt($data)
    {
        $isUpsate = $this->article->updateArt($data);
        return $isUpsate;
    }

    function deleteArt($id)
    {
        $isDel = $this->article->deleteArt($id);
        return $isDel;
    }

    public function index($id)
    {
        $user = $this->article->get_user_info_by_id($id);
        return $user;
    }
}