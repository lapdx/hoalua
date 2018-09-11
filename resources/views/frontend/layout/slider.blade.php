<?php
use App\Models\Coupon;
$listItem = Coupon::getCouponConfig('home.coupon_header');
if(!$listItem){
	$listItem = Coupon::getPopularCoupon(null, date('Y-m-d H:i:s'), 5);
}
?>
<div class="header-slider hidden-xs">
    <?php foreach($listItem as $item) { ?>
    <a class="slider-link" href="<?= route('frontend::coupon::detail', [ 'slug' => $item['slug'] ]); ?>">
        <h5><?= $item['title']; ?></h5>
        <p><?= strip_tags($item['content']); ?></p>
    </a>
    <?php } ?>
</div>