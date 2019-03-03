@foreach($css as $path)
    <link rel="stylesheet" href="{{asset($path)}}">
@endforeach