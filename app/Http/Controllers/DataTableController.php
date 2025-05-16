<?php

namespace App\Http\Controllers;

use App\Models\UserPosts;
use DataTables;
use Illuminate\Http\Request;

class DataTableController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()){
            $data = UserPosts::with('category')->select('*');
            return DataTables::of($data) -> addColumn('category_name', function($row){
                return $row->category->name ?? 'Uncategorized';
            })
            -> make(true);
        }
    }
}
