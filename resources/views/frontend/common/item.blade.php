<?php 
$clss = "";
if ($item->status == 'hot') {
   $clss = 'p-hot';
}else if($item->status == 'new'){
    $clss = 'p-new';
}
?>
<div class="p-item">
    <div class="p-thumb">
        <span class="<?= $clss?>"></span>
        <?php 
        if ($item->price > $item->sale_price) { 
                $discount = (($item->sale_price/$item->price)*100)-100;
            ?>
        <span class="p-discount"><?= round($discount) ?>%</span>
        <?php } ?>
        <a href="<?= route('frontend::product', ['slug' => $item->slug]) ?>"><img src="/upload/<?= $item->image_url ?>" alt="<?= $item->title ?>" /></a>
    </div>
    <div class="p-row">
        <a class="p-title" href="<?= route('frontend::product', ['slug' => $item->slug]) ?>"><?= $item->title ?></a>
    </div>
    <div class="p-row">
        <?php if ($item->price > $item->sale_price) { ?>
            <span class="p-oldprice"><?= number_format($item->price, 0, ',', '.') ?> đ</span>
        <?php } ?>
        <span class="p-price"><?= number_format($item->sale_price, 0, ',', '.') ?> đ</span>
    </div>
    <div class="p-star">
        <?php for ($i = 0;$i<5;$i++) {?>
        <?php if ($i<$item->rating_value) {
                echo "<i class=\"fa fa-star active\"></i>";
            }else{
                 echo "<i class=\"fa fa-star\"></i>";
            }?>
        <?php } ?>
    </div>
    <div class="p-row">
        <?= strip_tags($item->description) ?>
    </div>
</div>