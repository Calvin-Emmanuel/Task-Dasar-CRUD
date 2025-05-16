@section('content')

@if(session('success'))  
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
        display: inline-block;
        list-style: none;
        margin: 0;
        padding: 0 5px;
    }

        .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: flex-end;
        white-space: nowrap;
        float: left;
        padding: 2px ;
    }

        table.dataTable thead .sorting, 
        table.dataTable thead .sorting_asc, 
        table.dataTable thead .sorting_desc {
        background-image: none;
    }
        table.dataTable tbody td{
            vertical-align: :middle;
    }

    </style>
</head>
<body>
        <h1>All Posts</h1>
        <a href="{{ route('userposts.insert') }}">Create new Post</a>
        <table border="1" cellspacing="0" cellpadding="5" class='table datatable-basic'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Action</th>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Creation Date</th>
                    <th>Last Updated At</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <br>
        <br>
        <a href="{{ route('userposts.export.excel') }}">Export to Excel</a>
        <br>
        <a href="{{ route('userposts.export.pdf') }}">Export to PDF</a>
</body>





<script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>


<script>
var DatatableBasic = function () {
    var _componentDatatableBasic = function () {


        // Server-side DataTable configuration
        $('.datatable-basic').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: "{{ route('userposts.datatable') }}",
                type: "GET",
                error: function (xhr, error, thrown) {
                    console.error("DataTables error:", error, thrown);
                    // Optionally show a user-friendly error message
                    $('.datatable-basic').DataTable().clear().draw();
                    $('.datatable-basic tbody').html(
                        '<tr><td colspan="9" class="text-center text-danger">Failed to load data. Please try again.</td></tr>'
                    );
                }
            },
            dom: '<"top"fl>rt<"bottom"ip>',
            pagingType: 'simple_numbers',
            pageLength: 10,
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
            language: {
                searchPlaceholder: "Search here...",
                paginate: {
                    previous: '← Previous',
                    next: '→ Next',
                },
                emptyTable: "No posts available",
                zeroRecords: "No matching posts found"
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center'},
                { data: 'id', name: 'id' , orderable: false},
                { data: 'title', name: 'title' , orderable: false},
                { data: 'description', name: 'description' , orderable: false},
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'category.name', name: 'category.name' , orderable: false},
                { 
                    data: 'created_at', 
                    name: 'created_at',
                    type: 'date-eu',
                    searchable: false,
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            var date = new Date(data);
                            var day = String(date.getDate()).padStart(2, '0');
                            var month = String(date.getMonth() + 1).padStart(2, '0');
                            var year = date.getFullYear();
                            var hours = String(date.getHours()).padStart(2, '0');
                            var minutes = String(date.getMinutes()).padStart(2, '0');
                            return `${day}-${month}-${year} ${hours}:${minutes}`;
                        }
                        return data; 
                    }
                },
                { 
                    data: 'updated_at', 
                    name: 'updated_at',
                    type: 'date-eu',
                    searchable: false,
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            var date = new Date(data);
                            var day = String(date.getDate()).padStart(2, '0');
                            var month = String(date.getMonth() + 1).padStart(2, '0');
                            var year = date.getFullYear();
                            var hours = String(date.getHours()).padStart(2, '0');
                            var minutes = String(date.getMinutes()).padStart(2, '0');
                            return `${day}-${month}-${year} ${hours}:${minutes}`;
                        }
                        return data;
                    }
                }
            ],
            initComplete: function() {
                // Optional: Any post-initialization code
                console.log('DataTable initialized');
            }
        });
    };

    return {
        init: function() {
            _componentDatatableBasic();
            _componentSelect2();
        }
    }
}();

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', function() {
    DatatableBasic.init();
});
</script>
