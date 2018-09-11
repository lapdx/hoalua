<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Config;
use App\Models\Coupon;
use App\Models\Store;
use App\Utils\Utils;
use Illuminate\Support\Facades\Request;
use View;
use function redirect;
use function view;

class StoreController extends Controller {

    public function listByStore($slug, $itemId = 0) {
        $retVal = [];
        $filter = ["slug"=>$slug,'status'=> Store::STATUS_ENABLE];
        $stores = $this->storeRepository->getData($filter);
        if (empty($stores)) {
            return view('errors.404');
        }
        $store = $stores[0];
        $category = $this->categoryRepository->getData([
            'store_id'=>$store->id,
            'status'=> \App\Models\Category::STATUS_ENABLE,
            'columns'=>['category.id','category.left_value','category.right_value','category.depth']
            ])->first();
    if (!empty($category)) {
            $categories = $this->categoryRepository->getData([
                'leftTo' => $category->left_value,
                'rightFrom' => $category->right_value,
                'depthTo' => $category->depth,
                'status' => \App\Models\Category::STATUS_ENABLE,
                'columns' => ['category.id', 'category.parent_id', 'category.title'],
                'order_by' => ['depth', 'desc']]);
            $categoryIds = [];
            foreach ($categories as $value) {
                $categoryIds[] = $value->id;
            }
            $relatedStores = $this->storeRepository->getData(['status' => Store::STATUS_ENABLE, 'page_id' => 1, 'page_size' => 10, 'category_ids' => $categoryIds]);
        } else {
            $relatedStores = $this->storeRepository->getData(['status' => Store::STATUS_ENABLE, 'page_id' => 1, 'page_size' => 10, 'order_by' => ['coupon_count','desc']]);
        }
        $columns = ['coupon.*','store.slug as store_slug','store.image as store_image','store.title as store_title'];
        if(!empty(Request::segment(3)) && Request::segment(3) == 'c'){
            $dataCoupon = $this->couponRepository->getData(['id'=>$itemId,'join_store'=>'','columns'=>$columns]);
            $dataCoupon = $dataCoupon[0];
            $retVal['dataCoupon'] = $dataCoupon;
            $retVal['relatedCoupon'] = $this->getRelatedCoupon($dataCoupon->store_id, $itemId);
        }
        $filterCoupon = ['status' => Coupon::STATUS_ACTIVE,'page_id'=>1,'page_size'=>20,'store_id'=>$store->id,'join_store'=>'','columns'=>$columns, 'order_by' => ['sorder','desc'],];
        $activeCoupons = $this->couponRepository->getData($filterCoupon);
        $filterCoupon['status']= Coupon::STATUS_UNRELIABLE;
        $filterCoupon['page_size']= 8;
        $unreliableCoupons = $this->couponRepository->getData($filterCoupon);
        $relatedCategories = $this->categoryRepository->getData([
            'store_id' => $store->id,
            'status' => Category::STATUS_ENABLE,
            'page_size' => 10
        ]);
        $retVal['store'] = $store;
        $defaultMetaTitle = Config::getValue("site.defaultMetaTitle");
        $defaultMetaTitle = str_replace("{text}", $store->title, $defaultMetaTitle);
        $retVal['title'] = !empty($store->meta_title)? Utils::replaceMonthYeah($store->meta_title):Utils::replaceMonthYeah($defaultMetaTitle);
        $retVal['storeNameTracking'] = $store->title;
        $retVal['storeIdTracking'] = $store->id;
        $retVal['slug'] = $slug;
        $retVal['activeCoupons'] = $activeCoupons;
        $retVal['breadcrumbs'] = $this->getBreadcrumbs($store, 'store');
        $retVal['unreliableCoupons'] = $unreliableCoupons;
        $retVal['relatedStores'] = $relatedStores;
        $retVal['relatedCategories'] = $relatedCategories;
        \View::share('remarketingType', 'offerdetail');
        return View::make('frontend.store.list', $retVal);
    }

    protected function allStore() {
        $retStores = ["0-9"=>[]];
        $alphabet = range('A', 'Z');
        array_unshift($alphabet, "0-9");
        $stores = $this->storeRepository->getData(['order_by'=>['title','asc'],'status' => Store::STATUS_ENABLE]);
        foreach ($stores as $store) {
            $title = $store->title;
            $char = strtoupper(substr(trim($title), 0,1));
            if (in_array($char, $alphabet)) {
                if (isset($retStores[$char])) {
                    $retStores[$char][] = $store;
                }else{
                    $retStores[$char] = [$store];
                }
            }else{
                $retStores["0-9"][] = $store;
            }
        }
        return view('frontend.store.all', ['stores' => $retStores, 'title' => 'All Stores','alphabet'=>$alphabet]);
    }

    public function goStore($slug) {
        $stores = $this->storeRepository->getData(['slug' => $slug, 'status' => Store::STATUS_ENABLE]);
        if (!empty($stores)) {
            $store = $stores[0];
            if (!$store->inactive_affiliate) {
                $url = trim($store->affiliate_link);
            } else {
                $url = $store->website;
            }
            return redirect($url);
        }
    }

}
