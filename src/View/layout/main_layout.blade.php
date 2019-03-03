<!DOCTYPE html>
<html lang="en">

<head>
    @include($prefix . '::layout.header')
</head>

<body>
<div class="wrapper">
    @include($prefix . '::layout.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class=" container-fluid  ">
                <a class="navbar-brand" href="#">{{$nav_title ?? ""}}</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                    <span class="navbar-toggler-bar burger-lines"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

        @include($prefix . '::layout.footer')
    </div>
</div>
</body>

<!--   Core JS Files   -->
{!! \SethPhat\Search3\Library\Search3Helper::assetJs() !!}
<script src="{{asset('vendor/search3/js/popper.min.js')}}"></script>
<script src="{{asset('vendor/search3/js/bootstrap.min.js')}}"></script>
<script src="{{asset('vendor/search3/js/light-bootstrap-dashboard.js')}}"></script>
@foreach($assets['js'] as $js_file)
    <script src="{{$js_file}}"></script>
@endforeach
<script>
    $(document).ready(function() {
        $('li.active').removeClass('active');
        $('a[href="' + location.origin + location.pathname + '"]').closest('li').addClass('active');
    });
</script>
</html>