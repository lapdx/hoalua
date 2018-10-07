<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use function view;

class CategoryController extends Controller {

    public function index() {
        $retVal = [];
        $news = $this->getNews();
        $retVal['news'] = $news;
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $categories = $this->getCategories();
        $retVal['categories'] = $categories;
        return view('frontend.category.index', $retVal);
    }

}
