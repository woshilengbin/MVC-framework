<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twig extends Twig_Environment {

    protected $config;

    public function __construct($config)
    {
        $config_default = array(
            'cache_dir' => false,
            'debug' => true,
            'auto_reload' => true,
            'extension' => '.twig',
        );

        $this->config = array_merge($config_default, $config);

        $loader = new Twig_Loader_Filesystem($this->config['template_dir']);
        parent::__construct($loader, [
            'cache' => $this->config['cache_dir'],
            'debug' => $this->config['debug'],
            'auto_reload' => $this->config['auto_reload'],
        ]);
    }
}