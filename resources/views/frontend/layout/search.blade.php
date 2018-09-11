
<a href="javascript:void(0)" class="show-search hidden-lg hidden-md hidden-sm">
    <i class="fa fa-lg fa-search"></i>
</a>
<a href="javascript:void(0)" class="close-search hidden-lg hidden-md hidden-sm">
    <i class="fa fa-lg fa-times"></i>
</a>
<div id="search-form" class="search-form">
    <form  id="js-search-form" class="search-form"
           class="form-search"
           action="<?= URL::route('frontend::search') ?>" method="get" novalidate="novalidate">
        <div class="input-group">
            <input type="text"
                   name="s"
                   id="js-auto-complete-input"
                   class="form-control input-lg"
                   autocomplete="off"
                   placeholder="Search coupons and deals for your favorite stores"/>
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
        </div>
        <input type="hidden"
               id="js-store-suggest-url"
               value="<?= URL::route('frontend::store-suggest') ?>"/>
        <?php
        $storeLink = array();
        if ($popularSearchStores = config('store.popular-store')) {
            foreach ($popularSearchStores as $urlStore => $title) {
                $storeLink[] = '<a href="'.$urlStore.'" title="'.$title.' coupons">'.$title.'</a>';
            }
        }
        ?>
        <p class="clear top-keyword">
            <span class="hidden-xs">Popular stores:</span>
            <?= implode(', ', $storeLink); ?>
        </p>
    </form>
    <div class="instant-results">
        <ul class="list-unstyled result-bucket"
            id="js-list-result-suggest">
            <li class="result-bucket-name">Stores</li>
        </ul>
    </div>
</div>
