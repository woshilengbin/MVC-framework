<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:58:25
 * @version $Id$
 */
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
    protected $table = "articles";

    function __construct()
    {
        parent::__construct();
    }

    public function get_user_info_by_id($id)
    {
        $article = Article::find($id);
        return $article;
    }
}