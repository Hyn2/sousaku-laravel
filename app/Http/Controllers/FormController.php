<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['region:id,region', 'positions:position'])->get();

        return $posts;

        return view('form-board', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions = new PositionController();
        $regions = new RegionController();

        return view('form-create',['regions' => $regions(), 'positions' => $positions()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::check()) {
            $id = Auth::id();
            $post = Post::create([
                'title'        => $request->title,
                'gender'       => $request->gender,
                'user_id'      => $id,
                'region_id'    => $request->region,
                'position_id'  => $request->position,
                'contact'      => $request->contact,
                'content'      => $request->htmlContent,
            ]);

            $post->positions()->attach($post->position_id);

            return redirect('/form');
        } else {
            return redirect('/login');
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
