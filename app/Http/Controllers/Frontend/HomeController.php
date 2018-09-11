<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function view;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    protected function index()
    {
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        
        $saleProductsConfig = DB::table('parameter')->where('param_key','=','home.saleProducts')->first();
        if (!empty($saleProductsConfig)) {
            $saleProductIds = json_decode($saleProductsConfig->param_value);
            if (!empty($saleProductIds)) {
                $saleProducts = DB::table('product')->whereIn('id',$saleProductIds)->where('status','=','active')->get();
                $retVal['saleProducts'] = $saleProducts;
            }
        }
        $bestProductsConfig = DB::table('parameter')->where('param_key','=','home.bestProducts')->first();
        if (!empty($bestProductsConfig)) {
            $bestProductIds = json_decode($bestProductsConfig->param_value);
            if (!empty($bestProductIds)) {
                $bestProducts = DB::table('product')->whereIn('id',$bestProductIds)->where('status','=','active')->get();
                $retVal['bestProducts'] = $bestProducts;
            }
        }
        $sliderConfig = DB::table('parameter')->where('param_key','=','home.slider')->first();
        if (!empty($sliderConfig)) {
            $retVal['sliders'] = json_decode($sliderConfig->param_value);
        }
        $news = $this->getNews();
        $retVal['news'] = $news;
        
        return view('frontend.home.index', $retVal);
    }
}
