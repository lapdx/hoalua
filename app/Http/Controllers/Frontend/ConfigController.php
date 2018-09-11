<?php 

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class ConfigController extends Controller
{

	public function index(){
		$request = \Request::all();
		$configStores = $this->getDataInternalRequests('/service/cfg/find', ['type' => 'home', 'key'=>'home.store']);
		if($configStores){
			$configStores = json_decode($configStores[0]['value']);
		}
		$configCouponHeaders = $this->getDataInternalRequests('/service/cfg/find', ['type' => 'home', 'key'=>'home.coupon_header']);
		$configCouponTodays = $this->getDataInternalRequests('/service/cfg/find', ['type' => 'home', 'key'=>'home.coupon_today']);

		$storeData = $this->getDataInternalRequests('/service/store/find',[
          'pageSize' => 20,
          // 'search_title' => $request['s'],
          'status' => Store::STATUS_ENABLE]);

		$couponData = $this->getDataInternalRequests('/service/store/find',[
          'pageSize' => 20,
          // 'search_title' => $request['s'],
          'status' => Store::STATUS_ENABLE]);

        return view('vendor.config.index', ['title' => 'Config', 'stores' =>$configStores, 'configCouponHeaders' =>$configCouponHeaders, 'configCouponTodays' =>$configCouponTodays]);
    }

    public function updateStore(){
    	$request = \Request::all();
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.store'])->first();
        // $configStores = $this->getDataInternalRequests('/service/cfg/find', ['type' => 'home', 'key'=>'home.store']);
        $stores = [];
        if($config){
            $configObject = json_decode($config->value);
            $storeids = $configObject->value;
            if(isset($request['store_id'])){
                $storeids[] = (int)$request['store_id'];
            }
            if(isset($request['ids'])){
                $storeids = $request['ids'];
            }
            $storeids = array_unique($storeids);
            $configObject->value = $storeids;
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($configObject)]);
        }

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.store'])->first();
        if($config){
            $configStores = json_decode($config->value);
            if($configStores){
                $tmp = $this->storeRepository->getData(['ids' => $configStores->value]);
                foreach ($configStores->value as $key => $id) {
                   foreach ($tmp as $keyStore => $store) {
                       if($id == $store->id){
                            $stores[] = $store;
                            break;
                       }
                   }
                }
            }
        }

        return  view('vendor.store', ['stores'=>$stores]);

    }
    public function deleteStore(){
    	$request = \Request::all();

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.store'])->first();
        $stores = [];
        if($config){
            $objectConfig = json_decode($config->value);
            $storeids = $objectConfig->value;
            if (($key = array_search((int)$request['store_id'], $storeids)) !== false) {
                unset($storeids[$key]);
            }
            $objectConfig->value = array_values($storeids);
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($objectConfig)]);
        }
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.store'])->first();
        if($config){
            $configStores = json_decode($config->value);
            if($configStores){
                $tmp = $this->storeRepository->getData(['ids' => $configStores->value]);
                foreach ($configStores->value as $key => $id) {
                   foreach ($tmp as $keyStore => $store) {
                       if($id == $store->id){
                            $stores[] = $store;
                            break;
                       }
                   }
                }
            }
        }
        
        return  view('vendor.store', ['stores'=>$stores]);

    }
    public function updateCoupon(){
    	$request = \Request::all();
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.coupon'])->first();
        $coupons = [];
        if($config){
            $configObject = json_decode($config->value);
            $couponids = $configObject->value;
            if(isset($request['coupon_id'])){
                $couponids[] = (int)$request['coupon_id'];
            }
            if(isset($request['ids'])){
                $couponids = $request['ids'];
            }
            $couponids = array_unique($couponids);
            $configObject->value = $couponids;
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($configObject)]);
        }

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.coupon'])->first();
        if($config){
            $configCoupon = json_decode($config->value);
            if($configCoupon){
                $tmp = $this->couponRepository->getData(['ids' => $configCoupon->value]);
                foreach ($configCoupon->value as $key => $id) {
                   foreach ($tmp as $keyCoupon => $coupon) {
                       if($id == $coupon->id){
                            $coupons[] = $coupon;
                            break;
                       }
                   }
                }
            }
        }

        return  view('vendor.coupon', ['coupons'=>$coupons]);

    }
    public function deleteCoupon(){
    	$request = \Request::all();

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.coupon'])->first();
        $coupons = [];
        if($config){
            $objectConfig = json_decode($config->value);
            $couponids = $objectConfig->value;
            if (($key = array_search((int)$request['coupon_id'], $couponids)) !== false) {
                unset($couponids[$key]);
            }
            $objectConfig->value = array_values($couponids);
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($objectConfig)]);
        }
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.coupon'])->first();
        if($config){
            $configCoupon = json_decode($config->value);
            if($configCoupon){
                $tmp = $this->couponRepository->getData(['ids' => $configCoupon->value]);
                foreach ($configCoupon->value as $key => $id) {
                   foreach ($tmp as $keyCoupon => $coupon) {
                       if($id == $coupon->id){
                            $coupons[] = $coupon;
                            break;
                       }
                   }
                }
            }
        }
        
        return  view('vendor.coupon', ['coupons'=>$coupons]);

    }

    public function updateCategories(){
    	$request = \Request::all();
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.category'])->first();
        $categories = [];
        if($config){
            $configObject = json_decode($config->value);
            $ids = $configObject->value;
            if(isset($request['category_id'])){
                $ids[] = (int)$request['category_id'];
            }
            if(isset($request['ids'])){
                $ids = $request['ids'];
            }
            $ids = array_unique($ids);
            $configObject->value = $ids;
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($configObject)]);
        }

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.category'])->first();
        if($config){
            $configCategory = json_decode($config->value);
            if($configCategory){
                $tmp = $this->categoryRepository->getData(['ids' => $configCategory->value]);
                foreach ($configCategory->value as $key => $id) {
                   foreach ($tmp as $keyCoupon => $category) {
                       if($id == $category->id){
                            $categories[] = $category;
                            break;
                       }
                   }
                }
            }
        }

        return  view('vendor.categories', ['categories'=>$categories]);

    }
    public function deleteCategories(){
    	$request = \Request::all();

        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.category'])->first();
        $categories = [];
        if($config){
            $objectConfig = json_decode($config->value);
            $ids = $objectConfig->value;
            if (($key = array_search((int)$request['category_id'], $ids)) !== false) {
                unset($ids[$key]);
            }
            $objectConfig->value = array_values($ids);
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($objectConfig)]);
        }
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>'home.category'])->first();
        if($config){
            $configCategory = json_decode($config->value);
            if($configCategory){
                $tmp = $this->categoryRepository->getData(['ids' => $configCategory->value]);
                foreach ($configCategory->value as $key => $id) {
                   foreach ($tmp as $keyCoupon => $category) {
                       if($id == $category->id){
                            $categories[] = $category;
                            break;
                       }
                   }
                }
            }
        }
        
        return  view('vendor.categories', ['categories'=>$categories]);
    }

    public function updateNameTitle(){
        $request = \Request::all();
        $key = $request['type'];
        $config= $this->configRepository->getData(['type' => 'home', 'key'=>$key])->first();
        if($config){
            $objectConfig = json_decode($config->value);
            $objectConfig->name = $request['name'];
            $this->postInternalRequests('/service/cfg/update', ['id'=>$config->id,'value'=>json_encode($objectConfig)]);

        }
        return ;
    }


    public function getSelectStore(){
    	return (String) view('vendor.config.select2.store');
    }
}

