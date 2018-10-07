@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Sản phẩm</li>
    </ol> 
    <div class="box box-gray">
        <div class="box-title"><div class="lb-name">Danh mục sản phẩm</div></div>
        <div class="box-content">
            <div class="product-category">
                <ul>
                    <?php $categories = isset($categories[0]) ? $categories[0] : [];
                    foreach ($categories as $item) { ?>
                        <li>
                            <div class="pc-item">
                                <div class="pc-thumb"><a href="<?= route('frontend::category', ['slug'=>$item->slug])?>"><img src="/upload/<?= $item->image?>" alt="<?= $item->title?>" /></a></div>
                                <div class="pc-title"><a href="<?= route('frontend::category', ['slug'=>$item->slug])?>"><?= $item->title?></a></div>
                            </div>	<!-- pc-item -->
                        </li>
                    <?php } ?>
                </ul>
                <div class="clearfix"></div>
            </div><!-- product-category -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
<?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
