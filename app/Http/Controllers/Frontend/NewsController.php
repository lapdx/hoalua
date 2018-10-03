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
        $news = DB::table('blog')->where('slug','=', $slug)->where('status', '=', 'active')->first();
        if (empty($news)) {
            throw new Exception("Không tim thấy trang này", 404);
        }
        $retVal['news'] = $news;
        return view('frontend.news.detail', $retVal);
    }
    
    public function index(){
        $retVal = [];
        $retVal['newss'] =DB::table('blog')->where('status', '=', 'active')->get();
        return view('frontend.news.index', $retVal); 
    }
    
}
