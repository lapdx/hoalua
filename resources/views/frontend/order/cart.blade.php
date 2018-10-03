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
        <div class="checkout-title">Đơn hàng của bạn</div>
    </div><!-- col -->
</div><!-- row -->
        <?php if(empty($products) || count($products)<1) { ?>
<div class="row" style="text-align: center">
        <h4>Bạn chưa chọn sản phẩm cho giỏ hàng 
Vui lòng chọn sản phẩm để tiếp tục mua hàng!</h4>
</div>
        <?php }else{ ?>
<div class="row">
    <div class="col-sm-12">
        <div class="checkout-table">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="35%">Tên sản phẩm</th>
                            <th width="10%" class="text-center">Xoá</th>
                            <th width="15%" class="text-center">Số lượng</th>
                            <th width="20%" class="text-right">Đơn giá</th>
                            <th width="20%" class="text-right">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $item) {?>
                        <tr>
                            <td>
                                <div class="grid">
                                    <div class="img"><a href="<?= route("frontend::product",['slug'=>$item->options['slug']]) ?>"><img src="/upload/<?= $item->options['image_url'] ?>" alt="product"></a></div>
                                    <div class="g-content">
                                        <div class="g-row">
                                            <a class="g-title" href="<?= route("frontend::product",['slug'=>$item->options['slug']]) ?>"><?= $item->name ?></a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center"><span data-id="<?= $item->rowId ?>" class="fa fa-times cursor-pointer remove-item"></span></td>
                            <td class="text-center">
                                <input data-id="<?= $item->rowId ?>" type="number" min="1" max="1000" name="quantity" class="form-control text-inlineblock" value="<?= $item->qty ?>">
                            </td>
                            <td class="text-right"><?= number_format($item->price,0, ".",",") ?> VNĐ</td>
                            <td class="text-right"><?= number_format($item->price*$item->qty,0, ".",",") ?>VNĐ</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="4"><b>Tổng:</b></td>
                            <td class="text-right"><b class="text-danger"><?= Cart::subtotal(0,".",",") ?> VNĐ</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div><!-- table-responsive -->
        </div><!-- checkout-table -->
    </div><!-- col -->
</div><!-- row -->
<div class="row">
    <div class="col-sm-6">
        <div class="checkout-info">
            <h4>Phương thức thanh toán:</h4>
            <div class="checkout-form form">
                <div class="form-group">
                    <div class="radio">
                        <label><input name="rd_check" type="radio" value="" checked=""> Thanh toán trực tiếp khi nhận hàng</label>
                    </div>
                </div><!-- form-group -->
                <div class="form-group">
                    <div class="radio">
                        <label><input name="rd_check" type="radio" value=""> Thanh toán chuyển khoản Ngân hàng</label>
                    </div>
                </div><!-- form-group -->
            </div><!-- checkout-form -->
        </div>
    </div><!-- col -->
    <div class="col-sm-6">
        <div class="checkout-form form form-horizontal">
            <div class="form-group has-error">
                <label class="control-label col-sm-4">Họ và tên <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input name="" type="text" class="form-control">
                    <div class="help-block">Họ và tên chưa có.</div>
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <label class="control-label col-sm-4">Địa chỉ email <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input name="" type="text" class="form-control">
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <label class="control-label col-sm-4">Điện thoại <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input name="" type="text" class="form-control">
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <label class="control-label col-sm-4">Địa chỉ <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <input name="" type="text" class="form-control">
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <label class="control-label col-sm-4">Ghi chú</label>
                <div class="col-sm-8">
                    <textarea name="" cols="" rows="3" class="form-control"></textarea>
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <label class="control-label col-sm-4">Captcha <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <input name="" type="text" class="form-control">
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4">
                    <div class="box-captcha">
                        <img src="data/captcha.png" alt="captcha">
                    </div>
                    <a class="btnnewimg" href="#"></a>
                </div>
            </div><!-- form-group -->
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-4">
                    <button type="submit" class="btn btn-primary btn-lg">Đặt hàng</button>
                </div>
            </div><!-- form-group -->
        </div><!-- checkout-form -->
    </div><!-- col -->
</div><!-- row -->
        <?php } ?>

<div class="clearfix"></div>
@endsection
