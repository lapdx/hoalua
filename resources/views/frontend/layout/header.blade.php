<div class="navbar navbar-default">
    <div class="navbar-header">
        <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="logo"></a>
        <div class="box-search">
            <form action="<?= URL::route('frontend::search') ?>" method="GET">
                <div class="bs-inner">
                    <div class="bs-text">
                        <input name="k" type="text" value="<?= array_key_exists('k', $_GET)?$_GET['k']:'' ?>" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                    </div>
                    <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div><!-- box-search -->
        <div class="header-commit">
            <div class="hc-item">
                <i class="fa fa-calendar"></i>
                <div class="hc-text">
                    <p>Giờ bán hàng</p>
                    <p class="text-danger"><?= $siteConfig['site.salesHours'] ?></p>
                </div>
            </div>
            <div class="hc-item">
                <i class="fa fa-phone"></i>
                <div class="hc-text">
                    <p>Tư vấn Online</p>
                    <p class="text-danger"><a href="skype:<?= $siteConfig['site.skype'] ?>?chat"><i class="fa fa-skype"></i></a><?= $siteConfig['site.hotline'] ?></p>
                </div>
            </div>
        </div><!-- header-commit -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hoalua-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="box-cart" href="<?= route("frontend::cart")?>">
            <i class="fa fa-shopping-cart"></i>
            <span class="bc-price"><?= Cart::subtotal(0,".",",") ?> VNĐ</span>
        </a><!-- box-cart -->
    </div><!-- navbar-header -->
    <div class="collapse navbar-collapse" id="hoalua-navbar">
        <ul class="nav navbar-nav">
            <li><a href="/">Trang chủ</a></li>
            <?php $menus = json_decode($siteConfig['site.menu']);?>
            <?php foreach ($menus as $item) { ?>
            <li><a href="<?=$item->link?>"><?=$item->text?></a></li>
           <?php  } ?>
        </ul>
    </div><!-- /.navbar-collapse -->
</div>
<div class="box-commit">
    <div class="row sm-reset-all">
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-phone"></i>
                <div class="bc-text">Tư vấn miễn phí</div>
            </div>
        </div><!-- col -->
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-thumbs-o-up"></i>
                <div class="bc-text">Miễn phí lắp đặt</div>
            </div>
        </div><!-- col -->
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-shield"></i>
                <div class="bc-text">Bảo hành kép</div>
            </div>
        </div><!-- col -->
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-money"></i>
                <div class="bc-text">Thanh toán linh hoạt</div>
            </div>
        </div><!-- col -->
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-usd"></i>
                <div class="bc-text">Giá tốt nhất</div>
            </div>
        </div><!-- col -->
        <div class="col-sm-4 col-md-2 reset-padding-all">
            <div class="bc-item">
                <i class="fa fa-star-o"></i>
                <div class="bc-text">Dịch vụ chất lượng</div>
            </div>
        </div><!-- col -->
    </div><!-- row -->
</div>