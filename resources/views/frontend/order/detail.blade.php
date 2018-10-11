@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<ol class="breadcrumb">
    <li><a href="">Trang chủ</a></li>
    <li class="active"><i class="fa fa-long-arrow-right"></i>Hoá đơn</li>
</ol>
<div class="invoice-wrapper">
    <div class="invoice-border">
        <div class="invoice-header">
            <div class="row">
                <div class="col-sm-7">
                    <div class="grid">
                        <div class="img"><img src="/images/logo.png" alt="logo" /></div>
                        <div class="g-content">
                            <div class="g-row">
                                <h4><?= $_SERVER['SERVER_NAME'] ?></h4>
                            </div>
                            <div class="g-row">
                                <p><?= $siteConfig['contact.address'] ?></p>
                                
                            </div>
                        </div>
                    </div><!-- grid -->
                </div><!-- col-sm-7 -->
                <div class="col-sm-5">
                    <div class="grid text-right">
                        <div class="g-row">
                            <p><?= date("d/m/Y", strtotime($order->created_at)) ?></p>
                        </div>
                        <div class="g-row">
                            <p><b>Mã đơn hàng:</b> <?= $order->id ?></p>
                        </div>
                        <div class="g-row">
                            <div class="pay-compleate-info"><?= $order->status == 'active' ? 'Đã xác nhận' : 'Chưa xác nhận' ?></div>
                        </div>
                    </div><!-- grid -->
                </div><!-- col-sm-5 -->
            </div><!-- row -->
        </div><!-- invoice-header -->
        <div class="invoice-content">
            <div class="row">
                <div class="col-sm-12"><div class="fi-invoice-title">Hoá đơn mua hàng</div></div>
            </div><!-- row -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form form-horizontal form-invoice">
                        <div class="form-group">
                            <label class="control-label col-xs-4">Họ và tên:</label>
                            <div class="col-xs-8">
                                <p class="form-control-static"><?= $order->name ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4">Số điện thoại:</label>
                            <div class="col-xs-8">
                                <p class="form-control-static"><?= $order->phone ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-4">E-Mail:</label>
                            <div class="col-xs-8">
                                <p class="form-control-static"><?= $order->email ?></p>
                            </div>
                        </div>
                    </div>
                </div><!-- col-sm-6 -->
                <div class="col-sm-6">
                    <div class="form form-horizontal form-invoice"> 
                        <div class="form-group">
                            <label class="control-label col-xs-4">Địa chỉ:</label>
                            <div class="col-xs-8">
                                <p class="form-control-static"><?= $order->delivery_address ?></p>
                            </div>
                        </div>
                    </div>
                </div><!-- col-sm-6 -->
            </div><!-- row -->
            <div class="row">
                <div class="col-sm-6">
                    <!--<p>Hình thức thanh toán: Thanh toán trực tiếp khi nhận hàng</p>-->
                </div>
            </div><!-- row -->
            <div class="invoice-list">
                <div class="il-title">
                    <div class="row">
                        <div class="col-sm-8"><span class="il-label">Thông tin sản phẩm</span></div>
                        <div class="col-sm-1 text-center">Số lượng</div>
                        <div class="col-sm-2 text-right">Thành tiền</div>
                        <div class="col-sm-1"></div>
                    </div>
                </div><!-- il-title -->
                <?php foreach ($products as $item) { ?>
                    <div class="il-item">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="grid">
                                    <div class="img"><img src="/upload/<?= $item->image_url?>" alt="<?= $item->product_name?>" /></div>
                                    <div class="g-content">
                                        <div class="g-row">
                                            <a href=""><?= $item->product_name?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1 text-center"><span class="mobile-sl">Số lượng:&nbsp;</span><?= $item->quantity ?></div>
                            <div class="col-sm-2 text-right"><b><?= number_format($item->unit_price*$item->quantity, 0, ".", ",") ?><sup>đ</sup></b></div>
                            <div class="col-sm-1"></div>
                        </div>
                    </div><!-- il-item -->
                <?php } ?>
                <div class="il-item">
                    <div class="row">
                        <div class="col-sm-9 text-right">
                            <b>Tổng tiền:</b>
                        </div>
                        <div class="col-sm-2 text-right"><b class="text-danger"><?= number_format($order->amount, 0, ".", ",") ?><sup>đ</sup></b></div>
                        <div class="col-sm-1"></div>
                    </div>
                </div><!-- il-item -->
            </div><!-- invoice-list -->
            <div class="row">
                <div class="col-sm-12">
                    <p><b>*Ghi chú của khách hàng:</b> <?= $order->note?></p>
                </div>
            </div><!-- row -->
        </div><!-- invoice-content -->
    </div><!-- invoice-border -->
</div><!-- invoice-wrapper -->
<div class="clearfix"></div>
@endsection
