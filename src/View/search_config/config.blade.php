@extends($prefix . '::layout.main_layout')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <tr>
                    <th width="20%">Search Group</th>
                    <td width="30%">{{$group->name}}</td>
                    <th width="20%">Version</th>
                    <td width="30%">{{$version}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div id="templateContainer"></div>

    <div class="text-right">
        <button class="btn btn-primary">@lang($prefix . '::base.save')</button>
        <a href="javascript:void(0);" class="btn btn-secondary btnCancel">@lang($prefix . '::base.cancel')</a>
    </div>

    <script>
        var urlInfo = {
            back: "{{route('searchConfigPage')}}",
            api: "",
        };
        var search_group_id = "{{$group->id}}";

        @if ($is_add)
            var old_template = {
                search_form: "{!! $latest_template->search_form !!}",
                table_result: "{!! $latest_template->table_result !!}",
            };
        @endif
    </script>
@endsection