<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function response;

class OrderController extends Controller {

    public function addToCart(Request $request) {
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $retVal = [];
        $product = DB::table('product')->where('id','=',$productId)->where('status','!=','inactive')->first();
        Cart::add($product->id,$product->title,$quantity,$product->sale_price,['image_url'=>$product->image_url,'slug'=>$product->slug]);
        
        return response()->json(['result'=>Cart::total()]);
    }
    public function updateCart(Request $request) {
        $rowId = $request->get('rowId');
        Cart::remove($rowId);
        return response()->json(['result'=>Cart::total()]);
    }
    public function removeCart(Request $request) {
        $rowId = $request->get('rowId');
        $quantity = $request->get('quantity');
        Cart::update($rowId,$quantity);
        return response()->json(['result'=>Cart::total()]);
    }
    
    public function cart() {
        $products = Cart::content();
        return view("frontend.order.cart", ['products'=>$products]);
        
    }
   
}
