<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['region:id,region', 'positions:position', 'user:id,name'])->get();

        return view('post-board', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = new PositionController();
        $regions = new RegionController();

        return view('post-create',['regions' => $regions(), 'positions' => $positions()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title'   => 'required|string',
                'gender'  => 'required|string|max:1',
                'contact' => 'required|string',
                'htmlContent' => 'required|string',
                'image'   => 'required|file',
                'positions' => 'required|array',
            ]);
        } catch(ValidationException $e) {
            $errMsg = $e->getMessage();
            $errCode = $e->status;
            return response($errMsg, $errCode);
        }

        $imageName = $request->image->store();

        if(Auth::check()) {
            $id = Auth::id();
            $post = Post::create([
                'title'        => $request->title,
                'gender'       => $request->gender,
                'region_id'    => $request->region,
                'user_id'      => $id,
                'contact'      => $request->contact,
                'content'      => $request->htmlContent,
                'image'        => Storage::url($imageName),
            ]);

            $positions = $request->positions;
            foreach($positions as $position) {
                $post->positions()->attach($position);
            }

            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post-detail', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $filePath = basename($post->image);
        if(Storage::exists($filePath)) {
            $deleteImage = Storage::delete('/asdfasdfzzzz/'.$filePath);
            if(!$deleteImage) return redirect('/post')->with('response' , 'Failed to Delete Image');
        }
        return redirect('/post')->with('response', $post->delete() ? 'Post deleted successfully' : 'Failed to delete post');
    }
}