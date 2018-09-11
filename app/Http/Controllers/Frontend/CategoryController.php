<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function view;

class CategoryController extends Controller {

    protected function listByCategory($slug) {
        $retVal = [];
        $category = DB::table('category')->where('status', '=', 'active')->where('slug', '=', $slug)->first();
        $products = DB::table('product')->where('category_id', '=', $category->id)->where('status', '=', 'active')->get();
        $retVal['category'] = $category;
        $retVal['products'] = $products;
        return view('frontend.category.list', $retVal);
    }

    public function index() {
        $retVal = [];
        $categories = $this->getCategories();
        $retVal['categories'] = $categories;
        return view('frontend.category.all', $retVal);
    }

}
