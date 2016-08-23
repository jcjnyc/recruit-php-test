<?php

namespace FizzBuzz\Controller;

class Article extends AbstractController
{
    public function view()
    {
        $articleID = (int) $this->getRoutedParam('id');
        $slug = $this->getRoutedParam('slug');
        if (!$articleID) {
           throw new \Exception("Article ID is invalid", 404);
        }
        if (!$slug) {
        	throw new \Exception("Slug is invalid", 404);
        }

        $articlesRepository = $this->app->container->get('ArticlesRepository');
        $article = $articlesRepository->findByIdAndSlug($articleID, $slug);

        if (!is_array($article) or !count($article)) {
            throw new \Exception("Article not found", 404);
        }

        $this->tpl->article = $article;
        echo $this->tpl->render('article/view.phtml');
    }
}
