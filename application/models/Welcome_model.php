<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:58:25
 * @version $Id$
 */

use \Illuminate\Database\Eloquent\Model as Eloquent;

class Welcome_model extends Eloquent
{
    protected $table = "articles";

    function __construct()
    {
        parent::__construct();
    }

    public function get_welcome_info()
    {
        $article = Article::first();
        return $article;
    }
}