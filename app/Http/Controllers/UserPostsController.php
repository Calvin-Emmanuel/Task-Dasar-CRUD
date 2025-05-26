<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPosts;
use App\Exports\UserPostsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facades\PDF;

class UserPostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['login', 'logout', 'showLogin']);
    }

    public function showLogin()
    {
        return view('posts.login', ['show_logout' => false]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('userposts.list'));
        }

        return back()->withErrors([
            'email' => 'E-mail or password is wrong'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function list()
    {
        $posts = UserPosts::all();

        return view('posts.index', compact('posts'));
    }

    public function insert()
    {
        return view('posts.create', ['show_logout' => false]);
    }

    public function store(Request $request)
    {

        $validData = $request->validate([
            'title' => 'required|max:30',
            'description' => 'required',
            'img' => 'nullable|image|mimes:jpeg,png,jpg|max:3584',
            'category_id' => 'required|exists:post_categories,id',
        ]);

        $image_path = null;

        if ($request->hasFile('img')) {
            $image_path = $request->file('img')->store('posts', 'public');
        }

        UserPosts::create([
            'user_id' => auth()->id(),
            'title' => $validData['title'],
            'description' => $validData['description'],
            'category_id' => $validData['category_id'],
            'image_path' => $image_path,
        ]);
        return redirect('/posts')->with('success', 'Post created!');
    }

    public function delete($id)
    {
        $post = UserPosts::findOrFail($id);

        if (!auth()->user()->is_admin && auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action');
        }

        if ($post->image_path) {
            Storage::delete('public' . $post->image_path);
        }

        $post->delete();

        return redirect()->route('userposts.list')->with('success', 'Post deleted');
    }

    public function update(Request $request, $id)
    {
        $post = UserPosts::findOrFail($id);

        if (!auth()->user()->is_admin && auth()->id() !== $post->user_id) {
            abort(403, 'Unauthorized action');
        }

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
        return view('posts.edit', compact('post'), ['show_logout' => false]);
    }

    public function excelExport()
    {
        // $this->notifyExports('Excel');

        return Excel::download(new UserPostsExport, 'userposts' . now()->format('d-m-Y H:i') . '.xlsx');
    }

    public function pdfExport()
    {
        // $this->notifyExports('PDF');
        $query = UserPosts::with(['category', 'user']);

        if (!auth()->user()->is_admin) {
            $query->where('user_id', auth()->id());
        }

        $posts = $query->get()->map(function ($post) {
            return [
                'id' => auth()->user()->is_admin ? $post->id : 'Hidden',
                'user_id' => auth()->user()->is_admin ? $post->id : 'Hidden',
                'title' => $post->title,
                'description' => $post->description,
                'category' => $post->category->name ?? '',
                'image_path' => $post->image_path,
                'created_at' => $post->created_at->format('d-m-Y H:i'),
                'updated_at' => $post->updated_at->format('d-m-Y H:i')
            ];
        });

        return PDF::loadview('posts.userpostspdf', [
            'posts' => $posts,
            'is_admin' => auth()->user()->is_admin
        ])
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
        $posts = UserPosts::with(['category', 'user']);

        if (!auth()->user()->is_admin) {
            $posts->where('user_id', auth()->id());
        }

        return DataTables::of($posts)
            ->addIndexColumn()
            ->addColumn('action', function ($post) {
                $buttons = '';

                if (auth()->user()->is_admin == true || auth()->id() === $post->user_id) {


                    $editBtn = '<form action="' . route('userposts.edit', $post->id) . '" method="GET" 
                style= "display: inline">
                <button type="submit" class="btn btn-primary btn-sm">Update</button></form>';

                    $delBtn = '<form action="' . route('userposts.delete', $post->id) . '" method="POST" 
                style= "display: inline">
                ' . csrf_field() . '' . method_field('DELETE') . '
                <button type="submit" class="btn btn-danger btn-sm" onclick="
                return confirm(\'Are you sure you want to delete this post?\')">Delete</button></form>';

                    $buttons =  $editBtn . $delBtn;
                    return $buttons;
                }
            })
            ->addColumn('image', function ($post) {
                if ($post->image_path) {
                    return '<img src="' . asset('storage/' . $post->image_path) . '" 
                    style="max-width: 100px; max-height: 100px; display: inline-block; vertical-align: middle;">';
                }
                return '<p style="text-align: center"> No Image </p>';
            })
            ->addColumn('user_id', function ($post) {
                return auth()->user()->is_admin ? $post->user_id : 'Hidden';
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
