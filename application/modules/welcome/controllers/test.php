<?php
/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/25
 * Time: 17:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class test extends Base
{

    public function __construct()
    {

        parent::__construct();
    }

    public function getTest()
    {
        return 'this is a test !';
    }

}
