<div class="winget">
        <div class="winget-title"><div class="lb-name">Danh mục sản phẩm</div></div>
        <div class="winget-content">
            <div class="menuleft">
                <ul>
                    <?php if (isset($categoryMenu[0])) { ?>
                        <?php foreach ($categoryMenu[0] as $parent) { ?>
                            <li>
                                <a href="#"><i class="fa fa-sign-in"></i><?= $parent->title ?><i class="fa fa-caret-right"></i></a>
                                <div class="menuleft-submenu">
                                    <ul>
                                        <?php if (isset($categoryMenu[$parent->id])) { ?>
                                            <?php foreach ($categoryMenu[$parent->id] as $item) { ?>
                                                <li><a href="#"><i class="fa fa-long-arrow-right"></i><?= $item->title ?></a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div><!-- menuleft -->
        </div><!-- winget-content -->
    </div><!-- winget -->