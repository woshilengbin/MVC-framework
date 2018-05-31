<?php
/**
 * list后台数据交换方法 PHP demo
 * 注意必须保证通讯双方各服务器时间相差不到60分钟
 * include_once 'class.ListApi.php';
 * $objList = new ListApi();
 * $this->resturl  内网使用: list.oa.com/api/rest.php
 * $x = $objList->oo::listapi()->makeRequest(array('receiver'=>'simonsheng', 'type'=>'rtx;notify', 'title'=>$sTitle, 'content'=>$aMsgs['content'])) //发送消息
 * var_dump( $x);
 */
class Rtx
{
    private $appid; //应用ID
    private $secret; //通信密钥
    private $resturl; //应用rest地址
    private $proxyUrl = array(

    );

    public function __construct()
    {
        $this->appid   = '1';
        $this->secret  = '6fe7f10342bfae481c09665dbb86f5e7';
        $this->resturl = 'list.oa.com/api/rest.php';
    }

    private function call_method($param, $url)
    {
        $params['appid']   = $this->appid;
        $params['method']  = 'Message.Send';
        $param['clientip'] = self::getclientip();
        $params['param']   = $param;
        $params['time']    = time();

        $str = $this->joins($params, null, false);
        $str .= '&sig=' . md5($this->secret . $str . $this->secret);

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Texas API PHP Client 0.1 (curl) ' . phpversion());
            $result = curl_exec($ch);
            $errno  = curl_errno($ch);
            curl_close($ch);
        } else {
            $context = array('http' => array('method' => 'POST',
                'header'                                  => 'Content-type: application/x-www-form-urlencoded' . "\r\n" .
                'User-Agent: Texas API PHP Client 0.1 (non-curl) ' . phpversion() . "\r\n" .
                'Content-length: ' . strlen($str),
                'content'                                 => $str));
            $contextid = stream_context_create($context);
            $sock      = fopen($url, 'r', false, $contextid);
            if ($sock) {
                $result = '';
                while (!feof($sock)) {
                    $result .= fgets($sock, 4096);
                }
                fclose($sock);
            }
        }
        $result = unserialize($result);

        //$result['errno'] 服务端错误...1参数不够2不存在该应用3IP验证失败4时间相差1小时5sig验证失败

        return $errno ? null : $result;
    }
    /**
     * 对外部请求$_POST/$_GET的变量进行编码和去斜线
     */
    private function joins($params, $key = null, $strip = false)
    {
        $ret = array();
        if (is_array($params)) {
            krsort($params, SORT_STRING);
            foreach ($params as $k => $v) {
                if ((!empty($key)) || ($key === 0)) {
                    $k = $key . '[' . urlencode($strip && get_magic_quotes_gpc() ? stripslashes($k) : $k) . ']';
                }
                if (is_array($v) || is_object($v)) {
                    array_push($ret, self::joins($v, $k, $strip));
                } else {
                    array_push($ret, $k . '=' . urlencode($strip && get_magic_quotes_gpc() ? stripslashes($v) : $v));
                }
            }
        }
        return implode('&', $ret);
    }
    public static function getclientip()
    {
        if (isset($_SERVER['HTTP_QVIA'])) {
            $ip = self::qvia2ip($_SERVER['HTTP_QVIA']);
            if ($ip) {
                return $ip;
            }
        }
        if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
            return self::checkIP($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '0.0.0.0';
        }
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = strtok($_SERVER['HTTP_X_FORWARDED_FOR'], ',');
            do {
                $tmpIp = explode('.', $ip);
                //-------------------
                // skip private ip ranges
                //-------------------
                // 10.0.0.0 - 10.255.255.255
                // 172.16.0.0 - 172.31.255.255
                // 192.168.0.0 - 192.168.255.255
                // 127.0.0.1, 255.255.255.255, 0.0.0.0
                //-------------------
                if (is_array($tmpIp) && count($tmpIp) == 4) {
                    if (($tmpIp[0] != 10) && ($tmpIp[0] != 172) && ($tmpIp[0] != 192) && ($tmpIp[0] != 127) && ($tmpIp[0] != 255) && ($tmpIp[0] != 0)) {
                        return $ip;
                    }
                    if (($tmpIp[0] == 172) && ($tmpIp[1] < 16 || $tmpIp[1] > 31)) {
                        return $ip;
                    }
                    if (($tmpIp[0] == 192) && ($tmpIp[1] != 168)) {
                        return $ip;
                    }
                    if (($tmpIp[0] == 127) && ($ip != '127.0.0.1')) {
                        return $ip;
                    }
                    if ($tmpIp[0] == 255 && ($ip != '255.255.255.255')) {
                        return $ip;
                    }
                    if ($tmpIp[0] == 0 && ($ip != '0.0.0.0')) {
                        return $ip;
                    }
                }
            } while (($ip = strtok(',')));
        }

        if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])) {
            return self::checkIP($_SERVER['HTTP_PROXY_USER']) ? $_SERVER['HTTP_PROXY_USER'] : '0.0.0.0';
        }

        if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
            return self::checkIP($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
        } else {
            return '0.0.0.0';
        }
    }
    /**
     * 获取网通代理或教育网代理带过来的客户端IP
     * @return        string/flase    IP串或false
     */
    public static function qvia2ip($qvia)
    {
        if (strlen($qvia) != 40) {
            return false;
        }
        $ips   = array(hexdec(substr($qvia, 0, 2)), hexdec(substr($qvia, 2, 2)), hexdec(substr($qvia, 4, 2)), hexdec(substr($qvia, 6, 2)));
        $ipbin = pack('CCCC', $ips[0], $ips[1], $ips[2], $ips[3]);
        $m     = md5('QV^10#Prefix' . $ipbin . 'QV10$Suffix%');
        if ($m == substr($qvia, 8)) {
            return implode('.', $ips);
        } else {
            return false;
        }
    }
    /**
     * 验证ip地址
     * @param        string    $ip, ip地址
     * @return        bool    正确返回true, 否则返回false
     */
    public static function checkIP($ip)
    {
        $ip = trim($ip);
        $pt = '/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/';
        if (preg_match($pt, $ip) === 1) {
            return true;
        }
        return false;
    }
    /**
     * 请求API
     * @param String $method
     * @param Array $array
     * @return unknown
     */
    public function makeRequest($param = array())
    {
        if (isset($param['udid'])) {
            $param['udid'] = '##udid##' . $param['udid'];
        }

        $result = $this->call_method((array) $param, $this->resturl);
        var_dump($result);
        $count  = 0;
        while (($result === null) && ($count < count($this->proxyUrl))) {
            //服务器错误切换proxy
            $param['url']  = $this->resturl;
            $this->resturl = $this->proxyUrl[$count];
            $result        = $this->call_method((array) $param, $this->resturl);
            $count++;
        }
        return $result;
    }
}
