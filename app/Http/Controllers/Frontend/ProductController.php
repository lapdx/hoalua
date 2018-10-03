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
        $product = DB::table('product')->join('category', 'product.category_id', '=', 'category.id')->where('product.slug','=',$slug)->where('product.status','!=','inactive')->select('product.*','category.slug as categorySlug')->first();
        $retVal['product'] = $product;
        $releatedProducts = DB::table('product')->where('slug','=',$slug)->where('status','!=','inactive')->where('manufacturer_id','=',$product->manufacturer_id)->limit(9)->get();
        $retVal['releatedProducts'] = $releatedProducts;
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        $images = DB::table('product_gallery')->where('product_id','=',$product->id)->get();
        $retVal['images'] = $images;
        return view('frontend.product.detail', $retVal);
    }
    
    public function listByManufacturer($slug) {
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        $manufacturer = DB::table('manufacturer')->where('slug','=',$slug)->where('status','=','active')->first();
        $retVal['manufacturer'] = $manufacturer;
        $ids = [$manufacturer->id];
        $products = DB::table('product')->where('status','!=','inactive')->whereIn('manufacturer_id',$ids)->paginate(15);
        $retVal['products'] = $products;
        return view('frontend.product.list-by-manufacturer', $retVal);
    }
    public function listByCategory(\Illuminate\Http\Request $request,$slug) {
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        $category = DB::table('category')->where('slug','=',$slug)->where('status','=','active')->first();
        $retVal['category'] = $category;
        $categories = DB::table('category')->where('parent_id','=',$category->id)->where('status','=','active')->get();
        $ids = [$category->id];
        foreach ($categories as $item) {
            $ids[] = $item->id;
        }
        $products = DB::table('product')->where('status','!=','inactive')->whereIn('category_id',$ids)->paginate(15);
        $retVal['products'] = $products;
        return view('frontend.product.list', $retVal);
    }

}
