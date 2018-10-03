@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">KẾT QUẢ TÌM KIẾM CHO TỪ KHÓA: <?= $keyword?></div>
        </div><!-- box-title -->
    </div><!-- box -->
    <div class="box box-gray">
        <?php if(!empty($products)) {?>
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
        <?php }?>
    </div><!-- box -->
    {{ $products->links() }}
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
