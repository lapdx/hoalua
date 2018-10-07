@extends('frontend.layout.master', ['title' => ''])
@section('meta')
@include('frontend.layout.meta', ['data' => ''])
@endsection
@section('content')
<div class="main">
    <ol class="breadcrumb">
        <li><a href="/">Trang chủ</a></li>
        <li class="active"><i class="fa fa-long-arrow-right"></i>Liên hệ</li>
    </ol>
    <div class="box box-gray">
        <div class="box-title">
            <div class="lb-name">Thông tin liên hệ</div>
        </div><!-- box-title -->
        <div class="box-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contact-text">
                        <div class="maincontent">
                            <?= $siteConfig['contact.address'] ?>
                        </div><!-- maincontent -->
                    </div><!-- contact-text -->
                </div><!-- col -->
                <div class="col-sm-6">
                    <div class="contact-map">
                        
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.74042069596!2d105.85029831500579!3d21.00303998601225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac74cace94c5%3A0xa923db903f7c2163!2zMjYzIFRoYW5oIE5ow6BuLCBIYWkgQsOgIFRyxrBuZywgSMOgIE7hu5lpLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1538802162258" width="100%" height="300" frameborder="0" style="border:0"></iframe>
                    </div><!-- contact-map -->
                </div><!-- col -->
            </div><!-- row -->
        </div>
        <div class="box-title">
            <div class="lb-name">Liên hệ với chúng tôi</div>
        </div><!-- box-title --> 
        <div class="box-content">
            
                <?= isset($message) ? '<div class="alert alert-success">'.$message.'</div>' : '' ?>
            
            <form action="<?= route("frontend::contact::save") ?>" method="POST">
                {{ csrf_field() }}
                <?php if(isset($errors) && !empty($errors->all())) { ?>
                <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                <?php } ?>
                <div class="contact-form form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Họ và tên <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="name" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Số điện thoại <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="phone" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Email <span class="text-danger">(*)</span></label>
                        <div class="col-sm-5">
                            <input name="email" type="text" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Nội dung cần liên hệ <span class="text-danger">(*)</span></label>
                        <div class="col-sm-9">
                            <textarea name="content" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-primary">Gửi đi</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- box-content -->
    </div><!-- box -->
</div><!-- main -->
<div class="sidebar">
    <?= view("frontend.common.category-menu", ['categoryMenu' => $categoryMenu]) ?>
    <?= view("frontend.common.news-menu", ['news' => $news]) ?>

</div><!-- sidebar -->
<div class="clearfix"></div>
@endsection
