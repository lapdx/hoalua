<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use function redirect;
use function view;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    public function index() {
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;

        $saleProductsConfig = DB::table('parameter')->where('param_key', '=', 'home.saleProducts')->first();
        if (!empty($saleProductsConfig)) {
            $saleProductIds = json_decode($saleProductsConfig->param_value);
            if (!empty($saleProductIds)) {
                $saleProducts = DB::table('product')->whereIn('id', $saleProductIds)->where('status', '!=', 'inactive')->get();
                $retVal['saleProducts'] = $saleProducts;
            }
        }
        $bestProductsConfig = DB::table('parameter')->where('param_key', '=', 'home.bestProducts')->first();
        if (!empty($bestProductsConfig)) {
            $bestProductIds = json_decode($bestProductsConfig->param_value);
            if (!empty($bestProductIds)) {
                $bestProducts = DB::table('product')->whereIn('id', $bestProductIds)->where('status', '!=', 'inactive')->get();
                $retVal['bestProducts'] = $bestProducts;
            }
        }
        $sliderConfig = DB::table('parameter')->where('param_key', '=', 'home.slider')->first();
        if (!empty($sliderConfig)) {
            $retVal['sliders'] = json_decode($sliderConfig->param_value);
        }
        $news = $this->getNews();
        $retVal['news'] = $news;

        return view('frontend.home.index', $retVal);
    }

    public function search(Request $request) {
        $retVal = [];
        $keyword = $request->get("k");
        $retVal['keyword'] = $keyword;
        if (!empty($keyword)) {
            $retVal['products'] = DB::table('product')->where('status', '!=', 'inactive')->whereRaw('MATCH (title,content,description) AGAINST ("' . $keyword . '" IN NATURAL LANGUAGE MODE)')->paginate(10000);
        }
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        return view('frontend.home.search', $retVal);
    }

    public function contact() {
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        return view("frontend.home.contact", $retVal);
    }

    public function saveContact(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'content' => 'required',
                        ], [
                    'name.required' => 'Vui lòng nhập Tên',
                    'email.required' => 'Vui lòng nhập Email',
                    'phone.required' => 'Vui lòng nhập số điện thoại',
                    'content.required' => 'Vui lòng nhập nội dung',
                    'email.email' => 'Email không hợp lệ',
                    'phone.numeric' => 'Số điện thoại không hợp lệ',
        ]);
        if ($validator->fails()) {
            return redirect('/lien-he')
                            ->withErrors($validator)
                            ->withInput();
        }

        DB::table('email_newsletter')->insertGetId($request->only(["name", "email", "phone", "content"]));
        $retVal = [];
        $categoryMenu = $this->getCategories();
        $retVal['categoryMenu'] = $categoryMenu;
        $news = $this->getNews();
        $retVal['news'] = $news;
        $retVal['message'] = "Cảm ơn bạn! chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
        return view("frontend.home.contact", $retVal);
    }

}
