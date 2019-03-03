@extends($prefix . '::layout.main_layout')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-10">
            <form class="form-inline" method="GET">
                <input type="text" placeholder="@lang($prefix . "::base.keyword")" name="keyword" value="{{$keyword ?? ""}}" class="form-control col-lg-4 mr-1">
                <button class="btn btn-primary">@lang($prefix . "::base.search")</button>
            </form>
        </div>
        <div class="col-lg-2 text-right">
            <a href="{{route('searchGroupAddPage')}}" class="btn btn-primary">@lang($prefix . "::group.add_new")</a>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>@lang($prefix . "::group.field.name")</th>
                <th>@lang($prefix . "::group.field.table_name")</th>
                <th>@lang($prefix . "::group.field.last_update")</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($listGroup as $group)
            <tr>
                <td>
                    {{$group->name}}
                </td>
                <td>
                    {{$group->table_name}}
                </td>
                <td>
                    {{$group->updated_at}}
                </td>
                <td>
                    <a href="{{route('searchGroupEditPage', ['id' => $group->id])}}">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" data-id="{{$group->id}}" class="btnDeleteGroup">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach

            @if($listGroup->count() <= 0)
                <tr>
                    <td colspan="4">
                        @lang($prefix . "::base.no_result")
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="text-center">
        {!! $listGroup->appends(request()->input())->links() !!}
    </div>
@endsection