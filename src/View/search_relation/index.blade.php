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
                <th>@lang($prefix . "::relation.column.base_table")</th>
                <th>@lang($prefix . "::relation.column.join_table")</th>
                <th>@lang($prefix . "::relation.column.type_join")</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($listRela as $relation)
            <tr>
                <td>
                    {{$relation->BaseJoinTable->name}}
                </td>
                <td>
                    {{$relation->JoinedTable->name}}
                </td>
                <td>
                    @lang($prefix . '::relation.type.' . $relation->type)
                </td>
                <td>
                    <a href="#">
                        <i class="fa fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" data-id="#" class="btnDeleteGroup">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach

            @if($listRela->count() <= 0)
                <tr>
                    <td colspan="4">
                        @lang($prefix . "::base.no_result")
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="text-center">
        {!! $listRela->appends(request()->input())->links() !!}
    </div>
@endsection