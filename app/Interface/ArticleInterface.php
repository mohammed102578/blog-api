<?php

namespace App\Interface;


interface ArticleInterface
{



    //get all articles
    public function index();

    //get one article
    public function getArticleById($request);

    //create article
    public function store($request);

    //update article
    public function update($request);

    //delete article
    public function destroy($request);


}
