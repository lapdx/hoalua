@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => $category])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $category->title ?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $category->title ?></div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="product-desc">
                <div class="maincontent">
                    <?= $category->description ?>
                </div><!-- maincontent -->
            </div><!-- product-desc -->
        </div><!-- box-content -->
    </div><!-- box -->
    <div class="box box-gray">
        <div class="box-title">
            <div class="box-sort">
                <div class="row">
                    <div class="col-sm-6">
                        <span class="bs-text">Hiển thị: <span class="text-danger"><?= $products->total() ?></span> sản phẩm</span>
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
    <div class="box box-gray">
        <div class="box-title"><div class="lb-name">Hãng sản xuất</div></div>
        <div class="box-content">
            <div class="box-filter">
                <ul>
                    <?php
                    foreach ($manufacturers as $item) {
                        $c = '';
                        if (isset($manus) && in_array($item->id, $manus)) {
                            $c = 'checked';
                        }
                        ?>
                        <li><div class="checkbox"><label><input <?= $c ?> name="hsx" type="checkbox" value="<?= $item->id ?>" /> <?= $item->title ?></label></div></li>
                    <?php } ?>
                </ul>
            </div><!-- box-filter -->
        </div><!-- box-content -->
        <?php foreach ($attributes as $attr) { ?>
            <?php if (isset($attributeValues[$attr->id])) { ?>
                <div class="box-title"><div class="lb-name"><?= $attr->name ?></div></div>
                <div class="box-content">
                    <div class="box-filter">
                        <ul>
                            <?php
                            foreach ($attributeValues[$attr->id] as $item) {
                                $checked = '';
                                if (isset($params) && in_array($item->id, $params)) {
                                    $checked = 'checked';
                                }
                                ?>
                                <li><div class="checkbox"><label><input <?= $checked ?> name="param" type="checkbox" value="<?= $item->id ?>" /> <?= $item->content_value ?></label></div></li>
                            <?php } ?>
                        </ul>
                    </div><!-- box-filter -->
                </div><!-- box-content -->
            <?php } ?>
        <?php } ?>
        <div class="box-title"><div class="lb-name">Khoảng giá</div></div>
        <div class="box-content">
            <div class="box-filter">
                <ul>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '1000000-3000000')?'checked':'' ?> name="gia" type="radio" value="1000000-3000000" /> 1 - 3 triệu</label></div></li>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '3000000-5000000')?'checked':'' ?> name="gia" type="radio" value="3000000-5000000" /> 3 - 5 triệu</label></div></li>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '5000000-10000000')?'checked':'' ?> name="gia" type="radio" value="5000000-10000000" /> 5 - 10 triệu</label></div></li>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '10000000-15000000')?'checked':'' ?> name="gia" type="radio" value="10000000-15000000" /> 10 - 15 triệu</label></div></li>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '15000000-20000000')?'checked':'' ?> name="gia" type="radio" value="15000000-20000000" /> 15 - 20 triệu</label></div></li>
                    <li><div class="radio"><label><input <?= (isset($_GET['gia']) && $_GET['gia'] == '20000000-0')?'checked':'' ?> name="gia" type="radio" value="20000000-0" /> Trên 20 triệu</label></div></li>
                </ul>
            </div><!-- box-filter -->
        </div><!-- box-content -->
    </div><!-- box -->
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
