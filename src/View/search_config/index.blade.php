@extends($prefix . '::layout.main_layout')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-10">
            <form class="form-inline" method="GET">
                <input type="text" placeholder="@lang($prefix . "::base.keyword")" name="keyword" value="{{$keyword ?? ""}}" class="form-control col-lg-4 mr-1">
                <button class="btn btn-primary">@lang($prefix . "::base.search")</button>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>@lang($prefix . "::template.column.search_group")</th>
                <th>@lang($prefix . "::template.column.version")</th>
                <th>@lang($prefix . "::template.column.last_updated")</th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($listGroup as $group)
                <?php
                    $template = $group->Templates->last();
                ?>
            <tr>
                <td>
                    {{$group->name}} ({{$group->table_name}})
                </td>

                @if (empty($template))
                    <td colspan="3" class="text-center">
                        <a href="{{route('searchConfigTemplatePage', ['id' => $group->id])}}" class="btn btn-success">
                            <i class="fa fa-plus-circle"></i> @lang($prefix . '::template.add_new')
                        </a>
                    </td>
                @else
                    <td>
                        {{$template->version}}
                    </td>
                    <td>
                        {{$template->updated_at}}
                    </td>
                    <td>
                        <a href="{{route('searchConfigTemplatePage', ['id' => $group->id])}}">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:void(0);" data-id="{{$group->id}}" class="btnDeleteGroup">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                @endif
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