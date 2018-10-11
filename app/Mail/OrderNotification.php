<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$products)
    {
        $this->order = $order;
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("[Hoa Lua] Thông báo khách đặt hàng")->view('frontend.email.create-order-noti',['order'=>$this->order,'products'=> $this->products]);
    }
}
