<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Laravel Search 3</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />

<!-- CSS Files -->
<link href="{{asset('vendor/search3/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('vendor/search3/css/light-bootstrap-dashboard.css')}}" rel="stylesheet" />
<link href="{{asset('vendor/search3/css/font-awesome.min.css')}}" rel="stylesheet" />
{!! \SethPhat\Search3\Library\Search3Helper::assetCss()  !!}
@foreach($assets['css'] as $css_file)
    <link href="{{$css_file}}" rel="stylesheet" />
@endforeach