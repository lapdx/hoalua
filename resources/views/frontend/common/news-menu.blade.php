<div class="winget">
        <div class="winget-title"><div class="lb-name">Tin tức cập nhật</div></div>
        <div class="winget-content">
            <div class="featured-news">
                <?php foreach ($news as $new) { ?>
                <div class="grid">
                    <div class="img"><a href="<?= route('frontend::news', ['slug'=>$new->slug])?>"><img src="/upload/<?= $new->image ?>" alt="<?= $new->title ?>" /></a></div>
                    <div class="g-content">
                        <div class="g-row"><a class="g-title" href="<?= route('frontend::news', ['slug'=>$new->slug])?>"><?= $new->title ?></a></div>
                        <div class="g-row"><?= date( 'd/m/Y', strtotime($new->updated_at) )?></div>
                    </div>
                </div><!-- grid -->
                <?php } ?>
            </div><!-- featured-news -->
        </div><!-- winget-content -->
    </div><!-- winget -->