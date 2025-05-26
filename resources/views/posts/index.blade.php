@extends('postsLayout.layout')

@section('title', 'Dashboard')

@section('css')
    <style>

    .datatable-header {
        margin-left: -1rem;
        border: none !important;
    }

    /* Table container styling */
    .datatable-container {
        margin: 1rem 0;
        overflow-x: auto;
    }

    /* Table styling */
    table.dataTable {
        width: calc(100% - 1rem);
        margin: 1rem auto;
        border-collapse: collapse;
    }

    /* Table header styling */
    table.dataTable thead th {
        padding: 12px 15px;
        border-top: 1px solid #000000 !important;
        font-weight: bold;
    }

    /* Table body styling */
    table.dataTable tbody td {
        padding: 10px 15px;
        vertical-align: middle;
    }

    /* Top controls (search, length menu) */
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_length {
        margin-bottom: 1rem;
    }

    /* Bottom info and pagination */
    .dataTables_wrapper .dataTables_info {
        padding: 0.5rem 0;
    }

    /* Pagination buttons */
    .dataTables_wrapper .paginate_button {
        cursor: pointer;
    }


    /* Remove default sorting icons */
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
        background-image: none;
    }


    </style>
@endsection
@section('content')
    <br>
    <div class="all">
        @if(session('success'))  
            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif
        <div class="datatable-header">
            <h2>
                @if (auth()->user()->is_admin)
                    All Posts
                @else 
                    Your Posts
                @endif
            </h2>
        </div>
        

        <div class="datatable-container">
            <form action="{{ route('userposts.insert') }}" method="GET">
                <button type="submit">Create new post</button>
            </form>
            <br>

            <table border="1" cellspacing="0" cellpadding="5" class='table datatable-basic'>
                <thead>
                    <tr>
                        <th style="width: 2%;">No.</th>
                        <th style="width: 18%;">Action</th>
                        <th style="width: 2%;">Post ID</th>
                        <th style="width: 2%;">User ID</th>
                        <th style="width: 5%;">Title</th>
                        <th style="width: 25%;">Description</th>
                        <th style="width: 10%;">Image</th>
                        <th style="width: 8%;">Category</th>
                        <th style="width: 14%;">Creation Date</th>
                        <th style="width: 14%;">Last Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
            <br>
            <div style="display:flex; gap: 5px">
                <form action="{{ route('userposts.export.excel') }}" method="GET">
                    <button type="submit">Export to Excel</button>
                </form>
                <form action="{{ route('userposts.export.pdf') }}" method="GET">
                    <button type="submit"> Export to PDF</button>
                </form>
            </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>



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
                        { data: 'id', name: 'id' , orderable: false, className: 'dt-center', 
                                visible: {{ auth()->user()->is_admin ? 'true' : 'false' }}},
                        { data: 'user_id', name: 'user_id', className: 'dt-center', 
                                visible: {{ auth()->user()->is_admin ? 'true' : 'false' }}},
                        { data: 'title', name: 'title' , orderable: false, className: 'dt-center'},
                        { data: 'description', name: 'description' , orderable: false},
                        { data: 'image', name: 'image', orderable: false, searchable: false, className: 'dt-center' },
                        { data: 'category.name', name: 'category.name' , orderable: false, className: 'dt-center'},
                        { 
                            data: 'created_at', 
                            name: 'created_at',
                            type: 'date-eu',
                            className: 'dt-center',
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
                            className: 'dt-center',
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

@endsection
