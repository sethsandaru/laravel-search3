let tableResult = `
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover" id="search3TableResult">
            <thead>
                <tr>
                    <% _.each(columns, column => { %>
                        <td><%= column.label || column.name %></td>
                    <% }) %>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>
`;

export {
    tableResult
}