<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        return view('hello'); // Will render resources/views/hello.blade.php
    }

    public function greet()
    {
        return view("welcome");
    }

    public function show($id) 
    {
        return "User ID: " . $id;
    }
}
