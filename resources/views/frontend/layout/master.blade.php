<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE11">
        <link rel="stylesheet" type="text/css" href="/frontend/css/bootstrap.min.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/font-awesome.min.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/owl.carousel.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/cloudzoom.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/form.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/content.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="stylesheet" type="text/css" href="/frontend/css/responsive.css?v=<?= Config::get('app.version'); ?>" media="all">
        <link rel="shortcut icon" href="/frontend/images/favicon.png?v=<?= Config::get('app.version'); ?>" type="image/x-icon" />
        @yield('meta')
    </head>
    <body>
        <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '448249385342778',
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v3.1'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
        <div class="container">
            {{ csrf_field() }}
        @include('frontend.layout.header')
        <div class="bground">
        @yield('content')
        </div>
        @include('frontend.layout.footer')
        </div>
        <script type="text/javascript" src="/frontend/js/jquery-1.11.2.min.js?ver=<?= Config::get('app.version'); ?>"></script>
        <script src="/frontend/js/bootstrap.min.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
        <script src="/frontend/js/owl.carousel.min.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
        <script src="/frontend/js/cloudzoom.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
        <script src="/frontend/js/style.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
        <script src="/frontend/js/popup.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
        <script src="/frontend/js/order.js?v=<?= Config::get('app.version'); ?>" type="text/javascript"></script>
    </body>
</html>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.1&appId=448249385342778&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="367827510084685"
  theme_color="#0084ff"
  logged_in_greeting="CHUYÊN CUNG CẤP CÁC LOẠI THIẾT BỊ NHÀ BẾP NHẬP KHẨU"
  logged_out_greeting="CHUYÊN CUNG CẤP CÁC LOẠI THIẾT BỊ NHÀ BẾP NHẬP KHẨU">
</div>