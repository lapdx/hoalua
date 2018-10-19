<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('images/mlogo.png')}}" />
    <title>{{ isset($title) ? $title : 'Document' }} - Hoalua</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @section('css')

    @include('system.layouts.inc.css')
    @show

</head>
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini fixed"ng-app="system">
    <div class="wrapper">
    <header class="main-header">
        @section('header')
            @include('system.layouts.inc.header')
        @show
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        @section('main-sidebar')
            @include('system.layouts.inc.main-sidebar')
        @show
    </aside>

    <!-- Content Wrapper. Contains page content -->
    @yield('content-system')
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        @section('footer')
            @include('system.layouts.inc.footer')
        @show
    </footer>

    <div id="loading-find">
        <div class="popup"><img src="{{ asset('loading.gif') }}"></div>
        <div id="ExitPop" class="ExitPop"></div>
    </div>

</div>
    <script>            var apiUrl = '<?= env("API_URL", "http://api.hoaluaco.vn/api") ?>';
</script>
<!-- ./wrapper -->
@section('js')

@include('system.layouts.inc.js')
@show
</body>
</html>
