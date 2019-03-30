<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
{!! \SethPhat\Search3\Library\Search3Helper::assetCss() !!}


<div class="container-fluid" style="padding-top:20px;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Test search 3
        </div>
        <div class="panel-body">
            <table id="table_result" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Field Name</th>
                        <th>Group Name</th>
                        <th>Table Name</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>
</div>

{!!\SethPhat\Search3\Library\Search3Helper::assetJs()!!}
<script>
    $("#table_result").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "pageLength": 15,
        "serverSide": true,
        "processing": true,
        ajax: {
            url: "{{route('search3LookupAPI')}}",
            data: function (data) {
                // hook here
                data.main_group = "SearchGroupField";

                return data;
            },
            type: "POST"
        },
        columns: [
            {
                data: "SearchGroupField__id",
                sortable:true,
            },
            {
                data: "SearchGroupField__field_name",
                sortable:true,
            },
            {
                data: "SearchGroup__name",
                sortable:true,
            },
            {
                data: "SearchGroup__table_name",
                sortable:true,
            },
            {
                data: "SearchGroup__created_at",
                sortable:false,
            }
        ]
    });
</script>