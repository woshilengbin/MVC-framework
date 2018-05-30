<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/29
 * Time: 10:16
 */
class Base extends MX_Controller
{
    function __construct()
    {
//        parent::__construct();
//        $this->load->library('session');
//        $this->load->helper('url');
        log_message('info', 'this is a auth test log!');
//        $diyuid = $this->input->get('diyuid');
//        $myadmin = $this->session->userdata('myadm');
//        $controller = $this->router->fetch_class();
//        $method = $this->router->fetch_method();
//
//        if (($controller == 'common' && $method == 'noprivileges')) {
//            $tiaoshi = $this->input->get('tiaoshi');    //方便接口调试工具使用
//            if (!$myadmin && ($controller != 'user' || $method != 'login') && $tiaoshi != 1) {
//                redirect('c=user&m=login');
//                redirect('welcome/index');
            }

//            if (!($controller == 'user' && $method == 'login')) {
////                $this->load->model('manager/p_manager', 'manager');
//                if ($diyuid) {
//                    $permits_all = $this->manager->getOneByUserName($diyuid);
//                } else {
//                    $permits_all = $this->manager->getOneByUserName($myadmin['username']);
//                }
//
//                if (empty($permits_all) || (!$permits_all['permits'])) {
////                    redirect('c=common&m=noprivileges');
////                    redirect('welcome/index');
//                }
//                if (!$permits_all['cname']) {
//                    $dataManager = array();
//                    $dataManager['cname'] = $myadmin['cname'];
//                    $this->manager->updateManagerU($dataManager, $myadmin['username']);
//                }
//
//                $this->getOperatePermit($controller, $permits_all);
//                $this->data['myadmin'] = $myadmin;
//
//                $this->data['sideBarList'] = $sideBarList = $this->getSideBar($permits_all);
//
//                $this->data['statistics'] = $this->statistics();
//
//                $this->load->model('by_model', 'by');
//                $condition = array();
//                $condition['where'] = array('state' => 1, 'is_delete' => 0);
//                $condition['order'] = array('add_time' => 'DESC');
//                $noteItem = $this->by->getOne('db_note', $condition, 'title,content,start_time,end_time');
//                $this->data['noteItem'] = $noteItem;
//
//            }
//        }
//    }
}