@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
            	<ol class="breadcrumb">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="active"><i class="fa fa-long-arrow-right"></i>Tin tức</li>
                </ol>
                <div class="box box-gray">
                	<div class="box-title">
                    	<div class="lb-name">Tin tức</div>
                    </div><!-- box-title -->
                    <div class="box-content">
                    	<div class="news-list">
                            <?php foreach ($newss as $item) { ?> 
                            <div class="grid">
                                <div class="img"><a href="<?= route("frontend::news",['slug'=>$item->slug])?>"><img src="/upload/<?= $item->image ?>" alt="img" /></a></div>
                                <div class="g-content">
                                    <div class="g-row">
                                        <a class="g-title" href="<?= route("frontend::news",['slug'=>$item->slug])?>"><?= $item->title?></a>
                                    </div>
                                    <div class="g-row">
                                        <span class="g-time">Ngày đăng: <?= date('d/m/Y', strtotime($item->created_at)) ?></span>
                                    </div>
                                    <div class="g-row">
                                        <?= $item->description?>
                                    </div>
                                    <a class="g-view" href="<?= route("frontend::news",['slug'=>$item->slug])?>">Xem thêm...</a>
                                </div>
                            </div><!-- grid -->
                            <?php } ?>
                        </div><!-- news-list -->
                    </div><!-- box-content -->
                </div><!-- box -->
                {{ $newss->links() }}
            </div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
