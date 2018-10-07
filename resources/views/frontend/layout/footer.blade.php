<?php
$manufacturers = \Illuminate\Support\Facades\DB::table('manufacturer')->where('status','=','active')->get();
?>
<div class="footer-slider">
    <div id="fslider" class="owl-carousel">
        <?php foreach ($manufacturers as $manufacturer) { ?>
        <div class="logo-item"><a href="<?= route("frontend::manufaturer",['slug'=>$manufacturer->slug])?>"><img src="/upload/<?= $manufacturer->image_url?>" alt="logo" /></a></div>
       <?php } ?>
    </div><!-- owl-carousel -->
</div><!-- footer-slider -->
<div class="footer-top">
    <div class="row">
        <div class="col-sm-4">
            <div class="box-social">
                <a href="#"><i class="fa fa-google-plus"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-youtube"></i></a>
                <a href="#"><i class="fa fa-facebook"></i></a>
            </div>
        </div><!-- col -->
        <div class="col-sm-4">
            <div class="email-text">
                <i class="fa fa-envelope"></i>
                <div class="et-content">
                    <h4>ĐĂNG KÝ NHẬN BẢN TIN</h4>
                    <p>Cập nhật tin tức, sản phẩm, khuyến mại</p>
                </div>
            </div><!-- email-text -->
        </div><!-- col -->
        <div class="col-sm-4">
            <div class="email-input">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Email của bạn..." />
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">Đăng ký</button>
                    </span>
                </div>
            </div><!-- email-input -->
        </div><!-- col -->
    </div><!-- row -->
</div><!-- footer-top -->
<div class="footer-commit">
    <div class="row">
        <div class="col-sm-4">
            <div class="fc-title">Tổng đài hỗ trợ</div>
            <div class="fc-content">
                <div class="grid">
                    <div class="img"><i class="fa fa-phone"></i></div>
                    <div class="g-content">
                        <div class="g-row">Tư vấn trực tiếp</div>
                        <div class="g-row">
                            Skype: <a href="skype:<?= $siteConfig['site.skype'] ?>?chat"><i class="fa fa-skype"></i></a>
                            Tel: <span class="text-danger"><?= $siteConfig['site.hotline'] ?></span>
                        </div>
                    </div>
                </div><!-- grid -->
                <div class="grid">
                    <div class="img"><i class="fa fa-mobile"></i></div>
                    <div class="g-content">
                        <div class="g-row">Chăm sóc & Bảo hành</div>
                        <div class="g-row"><span class="text-danger"><?= $siteConfig['site.phone'] ?></span></div>
                    </div>
                </div><!-- grid -->
                <p class="fc-247">Phục vụ 24/7(cả ngày lễ và chủ nhật)</p>
            </div><!-- fc-content -->
        </div><!-- col -->
        <div class="col-sm-8">
            <div class="fc-border">
                <div class="fc-title">Cam kết bán hàng!</div>
                <ul>
                    <?= $siteConfig['site.commitment'] ?>
                </ul>
            </div><!-- fc-border -->
        </div><!-- col -->
    </div><!-- row -->
</div><!-- footer-commit -->
<div class="footer-text">
    <h1>Hoa lửa chuyên thiết kế sản xuất nội thất phong cách mới</h1>
    <div class="row">
        <div class="col-sm-12">
            <div class="ft-content" style="text-align: center;">
                <div class="grid">
                    <div class="g-row"><?= $siteConfig['site.footer']?></div>
                </div><!-- grid -->
            </div><!-- ft-content -->
        </div><!-- col -->
    </div><!-- row -->
</div><!-- footer-text -->
<div class="copyright">
    <div class="c-left">© 2015 Bản quyền thuộc về Hoa Lửa</div>
    <div class="c-right">Hoa Lửa trên <a href="#">Google Plus</a></div>
</div><!-- copyright -->
