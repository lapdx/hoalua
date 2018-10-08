<?php

$defaultMetaTitle =  $siteConfig['home.meta_title'];
$defaultMetaDescription = $siteConfig['home.meta_description'];
$defaultMetaKeywords = $siteConfig['home.meta_keywords'];
if (empty($data)) {
    $data = new stdClass();
}
$data = clone $data;
//if (!isset($data->image)) {
//    $data->image = '/frontend/images/noimage.png';
//} else {
//    $data->image = '/images/stores/' . $data->image;
//}

if (!isset($data->meta_title) || empty($data->meta_title)) {
    $data->meta_title = $defaultMetaTitle;
}

if (!isset($data->meta_keywords) || empty($data->meta_keywords)) {
    $data->meta_keywords = $defaultMetaKeywords;
}

if (!isset($data->meta_description) || empty($data->meta_description)) {
    $data->meta_description = $defaultMetaDescription;
}

?>
<title><?= $data->meta_title; ?></title>
<meta name="title" content="<?= $data->meta_title; ?>" />
<meta name="keywords" content="<?= $data->meta_keywords; ?>" />
<meta name="description" content="<?= $data->meta_description; ?>" />

<meta property="og:title" content="<?= $data->meta_title; ?>">
<meta property="og:image:type" content="image/png">
<meta property="og:description" content="<?= $data->meta_description; ?>">
<meta property="og:image" content="">
<meta property="og:url" content="<?= Request::fullUrl() ?>">
<meta property="og:site_name" content="<?= Request::root(); ?>">
<meta property="og:type" content="article" />
