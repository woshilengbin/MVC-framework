<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:58:25
 * @version $Id$
 */
//namespace modules\pcoa\model;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
    protected $table = "articles";

    function __construct()
    {
        parent::__construct();
    }

    public function get_index_info()
    {
        $article = Article::find(2);
        return $article;
    }
}