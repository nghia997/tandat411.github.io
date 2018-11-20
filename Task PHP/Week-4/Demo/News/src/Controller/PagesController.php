<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Method news is a view
     * @return void
     */
    public function news()
    {
        $news = $this->loadModel('news');
        $typeOfNew = $this->loadModel('type_of_news');
        $listNew = $news->find();
        $listType = $typeOfNew->find();
        $this->set(['data' => ['title' => "News", 'listNew' => $listNew, 'listType' => $listType]]);
    }
}
