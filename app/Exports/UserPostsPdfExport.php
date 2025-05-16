<?php

namespace App\Exports;

use PDF;
use App\Models\UserPosts;

class UserPostsPdfExport 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function download()
    {
        $allPosts = UserPosts::with('category')->get();

        $pdf = PDF::loadview('exports.posts-pdf', compact('posts'))->setPaper('a4', 'portrait');

        return $pdf->download('userposts.pdf');
    }
}
