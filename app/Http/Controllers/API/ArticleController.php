<?php

namespace App\Http\Controllers\API;

use App\Repository\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public $article;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ArticleRepository $article)
    {
        $this->article=$article;
        $this->middleware('auth:api');
    }


    //get all articles
    public function index()
    {
       $this->article->index();

    }


    //get one article
    public function getArticleById(Request $request)
    {
        $this->article->getArticleById($request);

    }


    //create article
    public function store(Request $request)
    {

            $this->article->store($request);
    }


//delete article
    public function destroy(Request $request)
    {
        $this->article->destroy($request);

    }

}
