<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use function response;
use function view;

class OrderController extends Controller {

    public function addToCart(Request $request) {
        $productId = $request->get('productId');
        $quantity = $request->get('quantity');
        $product = DB::table('product')->where('id', '=', $productId)->where('status', '!=', 'inactive')->first();
        Cart::add($product->id, $product->title, $quantity, $product->sale_price, ['image_url' => $product->image_url, 'slug' => $product->slug,'product_id'=>$product->id]);

        return response()->json(['result' => Cart::total()]);
    }

    public function updateCart(Request $request) {
        $rowId = $request->get('rowId');
        Cart::remove($rowId);
        return response()->json(['result' => Cart::total()]);
    }

    public function removeCart(Request $request) {
        $rowId = $request->get('rowId');
        $quantity = $request->get('quantity');
        Cart::update($rowId, $quantity);
        return response()->json(['result' => Cart::total()]);
    }

    public function cart() {
        $products = Cart::content();
        return view("frontend.order.cart", ['products' => $products]);
    }

    public function saveOrder(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|numeric',
                    'delivery_address' => 'required',
                        ], [
                    'name.required' => 'Vui lòng nhập Tên',
                    'email.required' => 'Vui lòng nhập Email',
                    'phone.required' => 'Vui lòng nhập số điện thoại',
                    'delivery_address.required' => 'Vui lòng nhập địa chỉ',
                    'email.email' => 'Email không hợp lệ',
                    'phone.numeric' => 'Số điện thoại không hợp lệ',
        ]);
        if ($validator->fails()) {
            return redirect('/thanh-toan')
                            ->withErrors($validator)
                            ->withInput();
        }
        
        $inoutputId = DB::table('inoutput')->insertGetId($request->only(["name","email","phone","delivery_address"]));
        $items = [];
        $products = Cart::content();
        foreach ($products as $product) {
            $items[] = ["inoutput_id"=>$inoutputId,'product_id'=>$product->options['product_id'],'quantity'=>$product->qty,'unit_price'=>$product->price,'image_url'=>$product->options['image_url']];
        }
        
        if (!empty($items)) {
           DB::table('inoutput_item')->insert($items);
        }
        Cart::destroy();
        return view("frontend.order.success", ["inoutputId"=>$inoutputId]);
        
    }

}
