<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function list()
    {
        return view('users.users');
    }

    public function getUsersData(Request $request)
    {
        $users = User::select(['id', 'name', 'email', 'is_admin']);

        return DataTables::eloquent($users)
            ->addIndexColumn()
            ->addColumn('action', function ($user) {
                $buttons = '';

                $editBtn = '<form action="' . '' . '" method="GET" style="display: inline;">
                <button type="submit" class="btn btn-primary">Update</button></form>';

                $delBtn = '<form action="' . '' . '" method="POST" style="display: inline;">' .
                    csrf_field() . '' . method_field('DELETE') . '
                <button type="submit" class="btn btn-danger">Delete</button></form>';

                $buttons = $editBtn . $delBtn;

                return $buttons;
            })
            ->addColumn('admin_status', function ($user) {
                return $user->is_admin;
            })
            ->rawColumns(['action', 'admin_status'])
            ->toJson();
    }
}
