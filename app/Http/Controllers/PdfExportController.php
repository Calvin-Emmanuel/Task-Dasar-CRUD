<?php

namespace App\Http\Controllers;

use App\Models\UserPosts;
use Illuminate\Http\Request;
use PDF;

class PdfExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function exportPdf()
    {
        $posts = UserPosts::with('category')->get();

        $data = [
            'posts' => $posts,
            'title' => 'User Posts Report',
            'date' => now()->format('F j, Y')
        ];

        return PDF::loadview('userpostspdf.blade.php', $data)
        ->setPaper('a4', 'porttrait')
        ->setOptions('isRemoteEnabled', true)
        ->download('userpostspdf.blade.php');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserPosts  $userPosts
     * @return \Illuminate\Http\Response
     */
    public function show(UserPosts $userPosts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserPosts  $userPosts
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPosts $userPosts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserPosts  $userPosts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserPosts $userPosts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserPosts  $userPosts
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPosts $userPosts)
    {
        //
    }
}
