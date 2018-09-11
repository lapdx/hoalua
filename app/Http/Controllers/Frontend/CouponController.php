<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Store;
use View;
use function redirect;
use function view;
use Illuminate\Support\Facades\Request;


class CouponController extends Controller
{

    public function index() {
        View::share('remarketingType', 'home');
        return view('frontend.home.index');
    }
    public function go($id){
        $coupon = $this->couponRepository->getData(['id'=>$id]);
        if (empty($coupon)) {
            return view('errors.404');
        }
        $coupon = $coupon[0];
        if ($coupon->type == Coupon::TYPE_PRINTABLE) {
            $url = $coupon->affiliate_link;
            if (empty($url)) {
                $url = $coupon->print_image;
            }
        }else{
            $url = $coupon->affiliate_link;
        }

        $typeSource = Request::get('type');
        $uId = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 25)), 0, 25);
        $regex = '/(go.redirectingat.com)/i';
        preg_match($regex, $url, $match);
        if ($uId && count($match) > 0) {
            if($typeSource){
                $xcust = substr($typeSource.'.'.$uId, 0, - (strlen($typeSource)+1)) . '_' . 'coupon' . '_' . $id;
            }else{
                $xcust = $uId . '_' . 'coupon' . '_' . $id;
            }
            $url .= '&xcust=' . $xcust;
        }
        return redirect($url);
        
    }
    
    public function detail($slug, $itemId = 0) {
        $retVal = [];
        $coupons = $this->couponRepository->getData([
            'slug' => $slug,
            'statuses' => [Coupon::STATUS_ACTIVE,Coupon::STATUS_UNRELIABLE],
            'join_store' => 1,
            'columns' => ['coupon.*','store.slug as store_slug','store.image as store_image','store.title as store_title']]);
        if(!empty($coupons)){
            $couponObj = $coupons[0];
            $retVal['coupon'] = $couponObj;
            $relatedCoupon = array();
            if ($itemId) {
                $retVal['dataCoupon'] = $couponObj;
                $relatedCoupon = $this->getRelatedCoupon($couponObj->store_id, $itemId);
                $retVal['relatedCoupon'] = $relatedCoupon;
            }
            $lastestCoupon = $this->couponRepository->getData([
                'status' => Coupon::STATUS_ACTIVE,
                'page_size' => 10,
                'join_store' => 1,
                'columns' => ['coupon.*','store.slug as store_slug','store.image as store_image','store.title as store_title']
            ]);
            $anotherCoupon  = $this->couponRepository->getData([
                'page_size' => 5,
                'status' => Coupon::STATUS_ACTIVE,
                'store_id' => $couponObj->store_id,
                'join_store' => 1,
                'columns' => ['coupon.*','store.slug as store_slug','store.image as store_image','store.title as store_title']
            ]);
            $couponCategory = $this->categoryRepository->getData([
                'coupon_id' => $couponObj->id,
                'status'=> Category::STATUS_ENABLE
            ]);
            $tagCoupon = $this->tagRepository->getData([
                'refer_type' => 'coupon',
                'refer_id' => $couponObj->id,
            ]);
            $relatedStores = [];
            $listCategoryId = [];
            foreach ($couponCategory as $category) {
                $listCategoryId[] = $category->id;
            }
            if ($listCategoryId) {
                $relatedStores = $this->storeRepository->getData([
                    'status' => Store::STATUS_ENABLE,
                    'category_ids' => $listCategoryId
                ]);
            }
            $retVal['title'] = $couponObj->title;
            $retVal['lastestCoupon'] = $lastestCoupon;
            $retVal['anotherCoupon'] = $anotherCoupon;
            $retVal['tagCoupon'] = $tagCoupon;
            $retVal['couponCategory'] = $couponCategory;
            $retVal['relatedStores'] = $relatedStores;
            return view('frontend.coupon.detail', $retVal);
        }else{
            return view('errors.404');
        }

        
    }
    
}
