<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function view;

class CategoryController extends Controller {

    public function index() {
        $retVal = [];
        $categories = $this->getCategories();
        $retVal['categories'] = $categories;
        return view('frontend.category.all', $retVal);
    }
    
    public function listProducts($slug,$page = 1) {
        $retVal = [];
        $category = DB::table('category')->where('status','=','active')->where('slug','=',$slug)->first();
        $categories = $this->getCategories();
        $retVal['categories'] = $categories;
        DB::table('product')->where('slug','=',$slug)->where('status','!=','inactive')->where('category_id','=',$category->id)->paginate(30);
        
        return view('frontend.category.all', $retVal);
    }

}
