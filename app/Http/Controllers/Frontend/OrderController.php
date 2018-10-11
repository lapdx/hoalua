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
        Cart::add($product->id, $product->title, $quantity, $product->sale_price, ['image_url' => $product->image_url, 'slug' => $product->slug, 'product_id' => $product->id, 'product_name' => $product->title]);

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

    public function detail($id) {
        $order = DB::table('inoutput')->where('id', '=', $id)->first();
        $products = DB::table('inoutput_item')->where('inoutput_id', '=', $id)->get();
        return view("frontend.order.detail", ['products' => $products, 'order' => $order]);
    }

    public function saveOrder(Request $request) {
        if (Cart::content()->count() < 1) {
            abort(404);
        }
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
        $io = $request->only(["name", "email", "phone", "delivery_address"]);
        $io['created_at'] = date('Y-m-d h:i:s');
        $io['amount'] = Cart::subtotal(0, "", "");
        $inoutputId = DB::table('inoutput')->insertGetId($io);
        $items = [];
        $products = Cart::content();
        foreach ($products as $product) {
            $items[] = ["inoutput_id" => $inoutputId, 'product_id' => $product->options['product_id'], 'quantity' => $product->qty, 'unit_price' => $product->price, 'image_url' => $product->options['image_url'], 'product_name' => $product->options['product_name']];
        }

        if (!empty($items)) {
            DB::table('inoutput_item')->insert($items);
            $order = DB::table('inoutput')->where('id', '=', $inoutputId)->first();
            $products = DB::table('inoutput_item')->where('inoutput_id', '=', $inoutputId)->get();
            \Illuminate\Support\Facades\Mail::to($order->email)->send(new \App\Mail\Order($order, $products));
            \Illuminate\Support\Facades\Mail::to('xuanlap93@gmail.com')->send(new \App\Mail\OrderNotification($order, $products));
        }
        Cart::destroy();
        return view("frontend.order.success", ["inoutputId" => $inoutputId]);
    }

}
