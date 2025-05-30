@extends('layouts.basicLayout')

@section('title', 'List of Users')

@section('css')
    <style>
        .badge-size {
            padding: 0.5em 1em;
            font-size: 1em;
            min-width: 80px;
            display: inline-block;
            text-align: center;
        }

        #datatable td:nth-child(6) {
            min-width: 120px;
        }

        .header-margin {
            margin-top: 2rem;
        }
    </style>
@endsection

@section('content')
    <div class="all">

        @if(session('success'))  
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(auth()->user()->is_admin)
            <h2 class="header-margin">Users List</h2>

            <form action="{{ route('users.insert') }}" method="GET">
                <button type="submit" class="btn btn-primary">Create new user</button>
                <a href="{{ route('dashboard') }}" class="btn btn-info">Return to Dashboard</a>
            </form>
            <br>

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
        @else
            <div class="alert alert-danger">You do not have permission to view this page</div>
        @endif
    </div>
@endsection

@section('js')
<script>
    var UsersDatatable = function() {
        var _initUsersDatatable = function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.get.data') }}",
                    type: "GET",
                    error: function(xhr, error, thrown) {
                        console.error("DataTables error:", error, thrown);
                        $('#datatable').DataTable().clear().draw();
                        $('#datatable tbody').html(
                            '<tr><td colspan="6" class="text-center text-danger">Failed to load data</td></tr>'
                        );
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'id', name: 'id', className: 'dt-center' },
                    { data: 'name', name: 'name', className: 'dt-center' },
                    { data: 'email', name: 'email', className: 'dt-center' },
                    { 
                        data: 'is_admin', 
                        name: 'is_admin',
                        className: 'dt-center',
                        render: function(data) {
                            return data ? 
                                '<span class="badge bg-success badge-size">Admin</span>' : 
                                '<span class="badge bg-primary badge-size">User</span>';
                        }
                    }
                ],
                dom: '<"top"fl>rt<"bottom"ip>',
                pagingType: 'simple_numbers',
                pageLength: 10,
                language: {
                    searchPlaceholder: "Search users...",
                    emptyTable: "No users available",
                    zeroRecords: "No matching users found",
                    paginate: {
                            previous: '← Previous',
                            next: '→ Next',
                        }
                }
            });
        };

        return {
            init: function() {
                _initUsersDatatable();
            }
        }
    }();

    document.addEventListener('DOMContentLoaded', function() {
        UsersDatatable.init();
    });
</script>
@endsection