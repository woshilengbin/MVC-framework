<?php
/**
 * 地方棋牌SSO登录类
 * @author weicky
 */
class Simplesso
{
    private $CI = null;
    /**
     * 应用ID
     * @var int
     */
    protected $_appId = 0;
    /**
     * 应用KEY
     * @var string
     */
    protected $_appKey = '';
    /**
     * 正式域名
     * @var string
     */
    protected $_domain = 'http://sso.ifere.com:8871/api'; // 内网URL值用这个http://192.168.100.248:8871/api';

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->config->load('sso');
        $sso           = $this->CI->config->item("sso");
        $this->_appId  = $sso['appid'];
        $this->_appKey = $sso['appkey'];
    }

    /**
     * 获取SSO登录URL
     * @return string
     */
    public function getLoginUrl()
    {
        return "http://sso.oa.com/Index/login/appid/" . $this->_appId;
    }

    public function Logout()
    {
        setcookie('admin_uid', '', time() - 1);
        setcookie('admin_key', '', time() - 1);
        redirect('http://sso.oa.com/Index/logout/appid/' . $this->_appId);
    }

    /**
     * SSO接口调用
     *
     * @param string $uid 用户ID
     * @param string $key 用户KEY
     * @param string $appid 应用ID
     * @param string $act 请求接口 getInfo:取个人信息 getPriv:取权限
     * @return array 结果数组
     */
    public function api($uid, $key, $act = 'getInfo')
    {
        $act     = urlencode($act);
        $uid     = urlencode($uid);
        $key     = urlencode($key);
        $url     = "{$this->_domain}?do={$act}&uid={$uid}&key={$key}&appid={$this->_appId}";
        $options = array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 10,
        );
        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $resp = curl_exec($ch);
        curl_close($ch);
        if ($resp) {
            $ret = json_decode($resp, true);
        }
        return ($ret ? $ret : false);
    }

    /**
     * 获取用户信息
     * @param int $uid SSO用户ID
     * @param string $key SSO用户KEY
     * @return mixed 成功返回用户信息数组，失败返回false
     */
    public function getUser($uid, $key)
    {
        $ret = $this->api($uid, $key, 'getInfo');
        return ($ret && $ret['ret'] == 1 ? $ret : false);
    }

}
