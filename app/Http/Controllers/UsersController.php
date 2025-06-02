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

                $editBtn = '<form action="' . route('users.edit', $user->id) . '" method="GET" style="display: inline;">
                <button type="submit" class="btn btn-primary">Update</button></form>';

                $delBtn = '<form action="' . route('users.delete', $user->id) . '" method="POST" style="display: inline;">' .
                    csrf_field() . '' . method_field('DELETE') . '
                <button type="submit" class="btn btn-danger" onclick="
                return confirm(\'Are you sure you want to delete this user?\')">Delete</button></form>';

                $buttons = $editBtn . $delBtn;

                return $buttons;
            })
            ->addColumn('admin_status', function ($user) {
                return $user->is_admin;
            })
            ->rawColumns(['action', 'admin_status'])
            ->toJson();
    }

    public function insert()
    {
        return view('users.userCreate');
    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean'
        ]);

        User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => bcrypt($validData['password']),
            'is_admin' => $validData['is_admin']
        ]);

        return redirect('/users')->with('success', 'User created!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.userEdit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validData = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'is_admin' => 'required|boolean'
        ]);

        if (!empty($validData['password'])) {
            $validData['password'] = bcrypt($validData['password']);
        } else {
            unset($validData['password']);
        }

        $user->update($validData);

        return redirect('/users')->with('success', 'User updated!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect('/users')->with('success', 'User deleted!');
    }

    public function register()
    {
        return view('users.userRegister');
    }

    public function guest(Request $request)
    {
        $validData = $request->validate([
            'name' => 'required|max:32',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'is_admin' => 'required|boolean'
        ]);

        User::create([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => bcrypt($validData['password']),
            'is_admin' => $validData['is_admin']
        ]);

        return redirect('/login')->with('success', 'User registered!');
    }
}
