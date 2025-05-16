<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\UserPosts;
use App\Exports\UserPostsExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UserPostsController extends Controller
{

    public function run()
    {

        //dd('Done');

        UserPosts::create([
            'title' => 'This is a test',
            'description' => 'This is the description'

        ]);
    }

    public function insert()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {

        $validData = $request->validate([
            'title' => 'required|max:30',
            'description' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:3584',
            'category_id' => 'required|exists:post_categories,id'
        ]);

        $validData['image_path'] = null;

        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('posts', 'public');
            $validData['image_path'] = $path;
        }

        UserPosts::create($validData);
        return redirect('/posts')->with('success', 'Post created!');
    }

    public function list()
    {
        $posts = UserPosts::all();

        return view('posts.index', compact('posts'));
    }

    public function delete($id)
    {
        UserPosts::findOrFail($id)->delete();
        return redirect()->route('userposts.list')->with('success', 'Post deleted');
    }

    public function update(Request $request, $id)
    {
        $post = UserPosts::findOrFail($id);

        $validData = $request->validate([
            'title' => 'required|max:30',
            'description' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:3584',
            'category_id' => 'required|exists:post_categories,id'
        ]);

        if ($request->has('remove_image')) {
            Storage::delete('public/' . $post->image_path);
            $validData['image_path'] = null;
        } elseif ($request->hasFile('img')) {
            if ($post->image_path) {
                Storage::delete('public/' . $post->image_path);
            }
            $path = $request->file('img')->store('posts', 'public');
            $validData['image_path'] = $path;
        }

        $post->update($validData);

        return redirect('/posts')->with('success', 'Post updated!');
    }

    public function edit($id)
    {
        $post = UserPosts::with('category')->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function excelExport()
    {
        $this->notifyExports('Excel');

        return Excel::download(new UserPostsExport, 'userposts' . now()->format('d-m-Y H:i') . '.xlsx');
    }

    public function pdfExport()
    {
        $this->notifyExports('PDF');
        $posts = UserPosts::with('category')->get();

        return PDF::loadview('posts.userpostspdf', ['posts' => $posts])
            ->setPaper('a4', 'landscape')
            ->download('userposts' . now()->format('d-m-Y H:i' . '.pdf'));
    }

    private function notifyExports(string $format)
    {
        $subject = 'User Posts has been exported';
        $message = "The table was exported using the {$format} format";

        Mail::raw($message, function ($mail) use ($subject) {
            $mail->to('test@example.com')
                ->subject($subject);
        });
    }

    public function datatable(Request $request)
    {
        $posts = UserPosts::with('category')->select('userposts.*');

        return DataTables::of($posts)
            ->addIndexColumn()
            ->addColumn('action', function ($post) {
                $editBtn = '<form action="' . route('userposts.edit', $post->id) . '" method="GET" 
                style= "display: inline">
                <button type="submit" class="btn btn-primary btn-sm">Update</button></form>';

                $delBtn = '<form action="' . route('userposts.delete', $post->id) . '" method="POST" 
                style= "display: inline">
                <input type="hidden" name="_token" value="' . csrf_token() . '">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-sm" onclick="
                return confirm(\'Are you sure you want to delete this post?\')">Delete</button></form>';

                return  '<div>' . $editBtn . $delBtn . '</div>';
            })
            ->addColumn('image', function ($post) {
                if ($post->image_path) {
                    return '<img src="' . asset('storage/' . $post->image_path) . '" 
                    style="max-height:100px; max-width:100px">';
                }
                return '<p style="text-align: center"> No Image </p>';
            })
            ->editColumn('created_at', function ($post) {
                return $post->created_at->format('Y-m-d H:i');
            })
            ->editColumn('updated_at', function ($post) {
                return $post->updated_at->format('Y-m-d H:i');
            })
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
}
