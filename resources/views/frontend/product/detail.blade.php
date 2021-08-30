@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => $product])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li><a href="<?= route("frontend::category", ['slug'=>$product->categorySlug]) ?>"><i class="fa fa-long-arrow-right"></i><?= $product->category_name ?></a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $product->title ?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $product->title ?></div>
            <div class="box-share">
                <ul>
                    <li><div class="fb-like" data-href="<?= route('frontend::product',['slug'=>$product->slug])?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div></li>
                </ul>
            </div><!-- box-share -->
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-desc">
                <div class="row sm-reset-5">
                    <div class="col-sm-6 padding-left-5">
                        <div class="product-image">
                            <div class="pi-inner">
                                <img id="myCloudZoom" class="cloudzoom" src="/upload/<?= $product->image_url ?>" data-cloudzoom ="zoomSizeMode: 'image', zoomImage: '/upload/<?= $product->image_url ?>'" alt="Click to view image!" />
                            </div>
                        </div><!-- product-image -->
                        <div class="pi-slider">
                            <div id="imageslider" class="owl-carousel">
                                <div class="pi-item active"><a class="cloudzoom-gallery" href="/upload/<?= $product->image_url ?>" data-cloudzoom="useZoom:'.cloudzoom', image:'/upload/<?= $product->image_url ?>' "><img src="/upload/<?= $product->image_url ?>"></a></div>
                                <?php foreach ($images as $image) { ?>
                                    <div class="pi-item"><a class="cloudzoom-gallery" href="/upload/<?= $image->image_url ?>" data-cloudzoom="useZoom:'.cloudzoom', image:'/upload/<?= $image->image_url ?>' "><img src="/upload/<?= $image->image_url ?>"></a></div>
                                <?php }?>
                            </div><!-- owl-carousel -->
                        </div><!-- pi-slider -->
                    </div><!-- col -->
                    <div class="col-sm-6 padding-all-5">
                        <div class="pd-center">
                            <div class="pd-title"><?= $product->title ?></h1></div>
                             <?php if ($product->price > $product->sale_price) { ?>
                            <div class="pd-row">
                                <label>Giá chính hãng:</label>
                                <div class="pd-text"><span class="pd-oldprice"><?= number_format($product->price, 0, ',', '.') ?> VNĐ</span></div>
                            </div><!-- pd-row -->
                            <?php } ?>
                            <div class="pd-row">
                                <label>Giá khuyến mại:</label>
                                <div class="pd-text"><span class="discount-percent pd-price"><?= number_format($product->sale_price, 0, ',', '.') ?> VNĐ</span></div>
                            </div><!-- pd-row -->
                            <?php if (isset($discount)) { ?>
                                <div class="pd-row">
                                <label>Tiết kiệm:</label>
                                <div class="pd-text"> <span class="discount-percent"><?= $discount ?>% </span><span class="pd-price">(<?= number_format(($product->price - $product->sale_price), 0, ',', '.') ?> VNĐ)</span></div>
                            </div>
                                <?php } ?>
                            <div class="pd-row">
                                <label>Số lượng:</label>
                                <div class="pd-text">
                                    <input rel="quantity" type="number" min="1" max="1000" class="form-control pd-qty" value="1" />
                                    <a class="btn btn-primary btn-buy" data-id="<?= $product->id ?>" >Đặt mua</a>
                                    
                                </div>
                            </div><!-- pd-row -->
                            <div class="box-support">
                                <div class="support-title"><i class="fa fa-gift"></i>Quà tặng</div>
                                <div class="support-content">
                                    <?= $product->description ?>
                                </div><!-- support-content -->
                            </div><!-- box-support -->
                        </div><!-- pd-center -->
                    </div><!-- col -->
                </div><!-- row -->
                <div class="pd-tabs" role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#description" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
                        <li role="presentation"><a href="#comments" role="tab" data-toggle="tab">Bình luận - Đánh giá</a></li>
                    </ul><!-- nav-tabs -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="description">
                            <div class="maincontent">                                            
                                <?= $product->content ?>
                            </div><!-- maincontent -->
                        </div><!-- tab-pane -->
                        <div role="tabpanel" class="tab-pane" id="comments">
                            <div class="fb-comments" data-href="<?= route('frontend::product',['slug'=>$product->slug])?>" data-numposts="5"></div>
                        </div><!-- tab-pane -->
                    </div><!-- tab-content -->
                </div><!-- pd-tabs -->
            </div><!-- product-desc -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box">
        <div class="box-title"><div class="lb-name">Sản phẩm cùng loại</div></div>
        <div class="box-content">
            <div class="product-list">
                <ul>
                    <?php foreach ($releatedProducts as $item) { ?> 
                        <li>
                            @include('frontend.common.item', ['item' => $item])
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-list -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
