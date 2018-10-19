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
        $input = $request->all();
        $paramFiltered = [];
        $paramPrices = [];
        if (array_key_exists('gia', $input)) {
            $arrPrices = explode('-', $input['gia']);
            $paramPrices['left'] = $arrPrices[0];
            $paramPrices['right'] = $arrPrices[1];
        }
        if (count($paramPrices) > 0) {
            $paramFiltered['price'] = $paramPrices;
        }
        if (array_key_exists('param', $input)) {
            $paramFiltered['attributeValueIds'] = explode(',', $input['param']);
            $retVal['params'] = explode(',', $input['param']);
        }
        if (array_key_exists('hsx', $input)) {
            $paramFiltered['hsx'] = explode(',', $input['hsx']);
            $retVal['manus'] = explode(',', $input['hsx']);
        }
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
        $attributes = DB::table('attributes')->join('attribute_n_category','attributes.id','=','attribute_n_category.attribute_id')->where('attribute_n_category.category_id','=',$category->id)->get(['attributes.*']);
        $attIds = [0];
        foreach ($attributes as $item) {
            $attIds[] = $item->id;
        }
        $attributeValues = DB::table('attribute_values')->whereIn('attribute_id',$attIds)->get();
        $attrValues = [];
        foreach ($attributeValues as $item) {
            if (!isset($attrValues[$item->attribute_id])) {
                $attrValues[$item->attribute_id] = [$item];
            }else{
                $attrValues[$item->attribute_id][] = $item;
            }
        }
        
        $retVal['attributes'] = $attributes;
        $retVal['attributeValues'] = $attrValues;
//        $products = DB::table('product')->where('status','!=','inactive')->whereIn('category_id',$ids)->paginate(15);
        $query = DB::table('product');
        if (array_key_exists('price', $paramFiltered)) {
            if (isset($paramFiltered['price']['left']) && intval($paramFiltered['price']['left']) > 0) {
                $query->where('product.sale_price','>=',intval($paramFiltered['price']['left']));
            }
            if (isset($paramFiltered['price']['right']) && intval($paramFiltered['price']['right']) > 0) {
                $query->where('product.sale_price','<=',intval($paramFiltered['price']['right']));
            }
        }
        if (array_key_exists('attributeValueIds', $paramFiltered)) {
                $query->join("product_n_attribute_value","product_n_attribute_value.product_id","=","product.id")->whereIn('product_n_attribute_value.attribute_value_id',($paramFiltered['attributeValueIds']));
        }
        if (array_key_exists('hsx', $paramFiltered)) {
                $query->whereIn('product.manufacturer_id',($paramFiltered['hsx']));
        }
        $query->where('product.status','!=','inactive')->whereIn('product.category_id',$ids);
        $products = $query->select(["product.*"])->paginate(15);
        $retVal['products'] = $products;
        
        $manufacturers = DB::table('manufacturer')->where('status', '=', 'active')->get();
        $retVal['manufacturers'] = $manufacturers;
        return view('frontend.product.list', $retVal);
    }

}
