<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function view;

class ProductController extends Controller {

    public function index() {
//        $retVal = [];
//        $categories = $this->getCategories();
//        $retVal['categories'] = $categories;
//        return view('frontend.category.all', $retVal);
    }
    
    public function detail($slug){
        $retVal = [];
        $product = DB::table('product')->where('slug','=',$slug)->where('status','!=','inactive')->first();
        $retVal['product'] = $product;
        $releatedProducts = DB::table('product')->where('slug','=',$slug)->where('status','!=','inactive')->where('manufacturer_id','=',$product->manufacturer_id)->limit(9)->get();
        $retVal['releatedProducts'] = $releatedProducts;
        $categories = $this->getCategories();
        $retVal['categories'] = $categories;
        return view('frontend.product.detail', $retVal);
    }

}
