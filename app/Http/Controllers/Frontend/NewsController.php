<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function view;

class NewsController extends Controller
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

    public function detail($slug)
    {
        $retVal = [];
        $detail = DB::table('blog')->where('slug','=', $slug)->where('status', '=', 'active')->first();
        if (empty($detail)) {
            throw new Exception("Không tim thấy trang này", 404);
        }
        $others = DB::table('blog')->where('status', '=', 'active')->limit(5)->orderBy(DB::raw('RAND()'))->get();
        $retVal['others'] = $others;
        $retVal['detail'] = $detail;
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        return view('frontend.news.detail', $retVal);
    }
    
    public function index(){
        $retVal = [];
                $news = $this->getNews();
        $retVal['news'] = $news;
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $retVal['newss'] =DB::table('blog')->where('status', '=', 'active')->paginate(15);
        return view('frontend.news.index', $retVal); 
    }
    public function sale(){
        $retVal = [];
        $news = $this->getNews();
        $retVal['news'] = $news;
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $retVal['newss'] =DB::table('blog')->where('status', '=', 'sale')->paginate(15);
        return view('frontend.news.index', $retVal); 
    }
    
}
