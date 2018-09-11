<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    protected function viewByTag($slug, $param1 = 0, $param2 = 0){

        if($param1-1 <= 0)
            $pagination = 0;
        else
            $pagination = $param1-1;

        $dataCoupon = array();
        $relatedCoupon = array();

        $dataCoupon = $relatedCoupon = array();
        if(!empty(Request::segment(3)) && Request::segment(3) == 'c'){
            $dataCoupon = $this->getDataInternalRequests('/service/coupon/find', ['id' => $param1, 'host' => 'local']);
            $relatedCoupon = $this->getRelatedCoupon($dataCoupon['storeId'], $param1);
        }

        if(!empty(Request::segment(4)) && Request::segment(4) == 'c'){
            $dataCoupon = $this->getDataInternalRequests('/service/coupon/find', ['id' => $param2, 'host' => 'local']);
            $relatedCoupon = $this->getRelatedCoupon($dataCoupon['storeId'], $param2);
        }

        $itemTag = $this->getDataInternalRequests('/service/tag/find', ['slug' => $slug]);
        if(!empty($itemTag)) {
            $referCouponBlog = $this->getDataInternalRequests('/service/tag/find', ['tagReferId' => $itemTag[0]['id']]);
            $blogId = $couponId = array(-1);
            foreach($referCouponBlog as $item) {
                if(isset($item['refertype']) && $item['referType'] == 'blog'){
                    $blogId[] = $item['referId'];
                }else if(isset($item['refertype']) && $item['referType'] == 'coupon'){
                    $couponId[] = $item['referId'];
                }
            }


            $itemCoupon = $this->getInternalRequests('/service/coupon/find', ['couponIn' => $couponId, 'pageId' => $pagination, 'pageSize' => 10]);

            $itemBlog = $this->getInternalRequests('/service/blog/find', ['blogId' => $blogId, 'pageId' => $pagination, 'pageSize' => 10]);
            return view('frontend.tag.list', ['title' => !empty($itemTag[0]['metaTitle'])?\App\Utils\Utils::replaceMonthYeah($itemTag[0]['metaTitle']): 'Tag '.$itemTag[0]['title'], 'itemCoupon' => $itemCoupon, 'itemBlog' => $itemBlog, 'slug' => $slug, 'dataCoupon' => $dataCoupon, 'relatedCoupon' => $relatedCoupon]);
        }else{
            return view('errors.404');
        }

    }
}
