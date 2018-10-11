@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<ol class="breadcrumb">
    <li><a href="/">Trang chủ</a></li>
    <li class="active"><i class="fa fa-long-arrow-right"></i>Giỏ hàng</li>
</ol>
<div class="row">
    <div class="col-sm-12">
        <div class="checkout-title">Đặt hàng thành công</div>
    </div><!-- col -->
</div><!-- row -->
<div class="checkout-info">
    <div class="cf-code">MÃ ĐƠN HÀNG: <span class="text-danger"><?= $inoutputId ?></span></div>
    <p>Cám ơn bạn đã mua hàng tại hoalua.vn!
        <br />Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất </p>
    <br />
    <p>Bạn có muốn:</p>
    <p>Xem lại <a href="<?= route("frontend::order::detail", ['id'=>$inoutputId]) ?>">hóa đơn mua hàng.</a></p>
    <p>Trở về <a href="/">trang chủ.</a></p>
</div><!-- checkout-info -->
<div class="clearfix"></div>

@endsection
