@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="">Trang chủ</a></li>
        <li><a href="<?= route("frontend::news::index")?>"><i class="fa fa-long-arrow-right"></i>Tin tức</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i><?= $detail->title?></li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name"><?= $detail->title?></div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="box-news">
                <div class="maincontent">
                   <?= $detail->content?>
                </div><!-- maincontent -->
                <div class="box-other">
                    <div class="bo-title">Bài viết liên quan:</div>
                    <ul>
                        <?php foreach ($others as $item) { ?>
                        <li><a href="<?= route("frontend::news", ['slug'=>$item->slug])?>"><?= $item->title?> <span>(<?= date('d/m/Y', strtotime($item->created_at)) ?></span></a></li>
                        <?php } ?>
                    </ul>
                </div><!-- box-other -->
            </div><!-- box-news -->
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
