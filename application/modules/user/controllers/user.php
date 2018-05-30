<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/30
 * Time: 11:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class user extends Base
{

    function login()
    {
        $this->load->library('Simplesso');
        $adminUid = intval($this->input->get('admin_uid'));
        $adminKey = $this->input->get('admin_key');
        $user = $this->simplesso->getUser($adminUid, $adminKey);
        if ($user) {
            $adm = array();
            $adm["id"] = $user["id"];
            $adm["username"] = $user["username"];
            $adm["cname"] = $user["cname"];
            $adm["email"] = $user["email"];
            $adm["phone"] = $user["phone"];
            $adm['logtime'] = $_SERVER['REQUEST_TIME']; //记录登陆时间
            $adm["admin_uid"] = $_GET['admin_uid'];
            $adm["admin_key"] = $_GET['admin_key'];
            $this->session->set_userdata('myadm', $adm);
            $this->session->set_userdata('username', $user["username"]);
            $this->getPermit($user["username"], $user["cname"]); //将权限设置为session
            redirect('c=common&m=welcome');
        } else {
            $sso_url = $this->simplesso->getLoginUrl();
            redirect($sso_url);
        }
    }
}