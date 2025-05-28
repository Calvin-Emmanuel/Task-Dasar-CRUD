@extends('layouts.basicLayout')

@section('title', 'List of Users')

@section('content')
    <div class="container">
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Actions</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>E-mail</th>
                    <th>User Privilege</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.get.data') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center'},
                    { data: 'id', name: 'id', className: 'dt-center'},
                    { data: 'name', name: 'name', className: 'dt-center'},
                    { data: 'email', name: 'email', className: 'dt-center'},
                    { data: 'admin_status', name: 'is_admin', orderable: false, searchable: false, className: 'dt-center',
                        render: function(data, type, row){
                            return row.is_admin ? 
                                '<span class="badge bg-success">Admin</span>':
                                '<span class="badge bg-primary">User</span>';
                        }
                    }
                ]

                error: function(xhr, error, thrown) {
                    console.log('DataTables error:', xhr, error, thrown);
            });
        });
    </script>
@endsection