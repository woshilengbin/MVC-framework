<?php
/**
 *
 * @authors Your Name (you@example.org)
 * @date    2018-05-23 11:58:25
 * @version $Id$
 */

use \Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Pagination;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class Article extends Eloquent
{
    protected $table = "articles";

    function __construct()
    {
        parent::__construct();
    }

    function getAll($per_page, $pageSize)
    {
        if (empty($per_page)) $per_page = 1;
        $data['data'] = Article::orderby('id')->offset(($per_page - 1) * $pageSize)->limit($pageSize)->get();
        $data['count'] = Article::count();
        return $data;
    }

    public function get_user_info_by_id($id)
    {
        $article = Article::find($id);
        return $article;
    }

    function getById($id)
    {
        $article = Article::find($id);
        return $article;
    }

    function addNew($data)
    {
        $article = new Article;
        $article->article = $data['name'];
        return $article->save();
    }

    function updateArt($data)
    {
        $article = Article::find($data['id']);
        $article->article = $data['name'];
        return $article->save();
    }

    function deleteArt($id)
    {
        return Article::destroy($id);
    }
}