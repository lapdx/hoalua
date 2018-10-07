<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Order extends Mailable
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
        return $this->view('frontend.email.create-order',['order'=>$this->order,'products'=> $this->products]);
    }
}
