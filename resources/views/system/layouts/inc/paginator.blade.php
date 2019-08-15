<?php
//validate parameters
if (!isset($accessPageId)) {
    echo "<span class='text-bold text-red'>Render paginator: missing parameter accessPageId to access pageId value</span>";
    return;
}
if (!isset($accessPagesCount)) {
    echo "<span class='text-bold text-red'>Render paginator: missing parameter accessPagesCount to access pagesCount value</span>";
    return;
}

if (!isset($accessFind)) {
    echo "<span class='text-bold text-red'>Render paginator: missing parameter accessFind to access find() function</span>";
    return;
}
?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center no-padding">
    <div ng-show="<?= $accessPagesCount ?> > 0" ng-init="steps = [ - 5, - 4, - 3, - 2, - 1, 0, 1, 2, 3, 4, 5 ]"
    >
        <ul class="pagination pull-right" style="margin: 0px 15px;">
            <li class="@{{step == 0 ? 'active' : ''}}"
                ng-repeat="step in steps"
                ng-show="$parent.filter.<?= $accessPageId ?> + step >= 0 && $parent.filter.<?= $accessPageId ?> + step < $parent.<?= $accessPagesCount ?>">
                <a ng-click="$parent.filter.<?= $accessPageId ?> = $parent.filter.<?= $accessPageId ?> + step;$parent.<?= $accessFind ?>"
                >
                    @{{$parent.filter.<?= $accessPageId ?> + step + 1}}
                </a>
            </li>
        </ul>
    </div>
</div>
