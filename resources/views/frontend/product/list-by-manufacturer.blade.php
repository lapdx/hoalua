@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => $manufacturer])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $manufacturer->title ?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $manufacturer->title ?></div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-desc">
                <div class="maincontent">
                    <?= $manufacturer->description ?>
                </div><!-- maincontent -->
            </div><!-- product-desc -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box box-gray">
        <div class="box-title">
            <div class="box-sort">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="bs-text">Hiển thị: <span class="text-danger"><?=$products->total()?></span> sản phẩm</span>
                        <a class="bs-button" href="#" style="display:none;"><i class="fa fa-th-list"></i></a>
                        <a class="bs-button active" href="#" style="display:none;"><i class="fa fa-th"></i></a>
                    </div><!-- col -->
                </div><!-- rox -->
            </div><!-- box-sort -->
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-list">
                <ul>
                    <?php foreach ($products as $item) { ?> 
                        <li>
                            @include('frontend.common.item', ['item' => $item])
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-list -->
        </div><!-- box-content -->
    </div><!-- box -->
    {{ $products->links() }}
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
