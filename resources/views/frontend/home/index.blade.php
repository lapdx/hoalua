@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
    <div class="main-slider">
        <div id="heartslider" class="owl-carousel">
            <div class="h-item">
                <img src="data/slider1.jpg" alt="slider" />
            </div><!-- h-item -->
            <div class="h-item">
                <img src="data/slider2.jpg" alt="slider" />
            </div><!-- h-item -->
            <div class="h-item">
                <img src="data/slider3.jpg" alt="slider" />
            </div><!-- h-item -->
        </div><!-- owl-carousel -->
    </div><!-- main-slider -->
    <?php if (isset($saleProducts) && !empty($saleProducts)) { ?>
        <div class="box">
            <div class="box-title"><div class="lb-name">Sản phẩm giảm giá</div></div>
            <div class="box-content">
                <div class="sale-home">
                    <div id="saleslider" class="owl-carousel">
                        <?php foreach ($saleProducts as $item) { ?> 
                            @include('frontend.common.item', ['item' => $item])
                        <?php } ?>
                    </div><!-- owl-carousel -->
                </div><!-- sale-home -->
            </div><!-- box-content -->
        </div><!-- box -->
    <?php } ?>
    <?php if (isset($bestProducts) && !empty($bestProducts)) { ?>
        <div class="box">
            <div class="box-title"><div class="lb-name">Sản phẩm bán chạy</div></div>
            <div class="box-content">
                <div class="product-list">
                    <ul>
                        <?php foreach ($bestProducts as $item) { ?> 
                            <li>
                                @include('frontend.common.item', ['item' => $item])
                            </li>
                        <?php } ?>
                    </ul>
                    <div class="clearfix"></div>
                </div><!-- product-list -->
            </div><!-- box-content -->
        </div><!-- box -->
    <?php } ?>
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <div class="winget">
        <div class="winget-title"><div class="lb-name">Tin tức cập nhật</div></div>
        <div class="winget-content">
            <div class="featured-news">
                <?php foreach ($news as $new) { ?>
                <div class="grid">
                    <div class="img"><a href="<?= route('frontend::news', ['slug'=>$new->slug])?>"><img src="/upload/<?= $new->image ?>" alt="<?= $new->title ?>" /></a></div>
                    <div class="g-content">
                        <div class="g-row"><a class="g-title" href="<?= route('frontend::news', ['slug'=>$new->slug])?>"><?= $new->title ?></a></div>
                        <div class="g-row"><?= date( 'd/m/Y', strtotime($new->updated_at) )?></div>
                    </div>
                </div><!-- grid -->
                <?php } ?>
            </div><!-- featured-news -->
        </div><!-- winget-content -->
    </div><!-- winget -->
    <div class="box-banner">
        <div class="bb-item">
            <a href="#"><img src="data/banner1.jpg" alt="banner" /></a>
        </div>
        <div class="bb-item">
            <a href="#"><img src="data/banner2.jpg" alt="banner" /></a>
        </div>
    </div><!-- box-banner -->
</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
