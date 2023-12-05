<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isEmpty;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $regions = new RegionController();
        $positions = new PositionController();

        if(!empty($request->positions)) {
            $positionIds = $request->positions;
            $posts = Post::whereHas('positions', function ($query) use ($positionIds) {
                $query->whereIn('position_id', $positionIds);
            })->get();
        } else {
            $posts = Post::with(['region:id,region', 'positions:position', 'user:id,name'])->latest()->get();
        }
        if(!empty($request->gender)) {
            $posts = $posts->where('gender', $request->gender);
        }
        if(!empty($request->region)) {
            $posts = $posts->where('region_id', $request->region);
        }
        return view('post.board', ['posts' => $posts, 'positions' => $positions(), 'regions' => $regions(), 'query' => $request->query()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = new RegionController();
        $positions = new PositionController();
        return view('post.create', ['regions' => $regions(), 'positions' => $positions()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'gender' => 'required|string|max:1',
            'htmlContent' => 'required|string',
            'image' => 'image',
            'positions' => 'required|array',
        ]);

        $dataToStore = [
            'title' => $request->title,
            'gender' => $request->gender,
            'region_id' => $request->region,
            'user_id' => Auth::id(),
            'content' => $request->htmlContent,
        ];

        if($request->hasFile('image')) {
            $storeImage = Storage::url($request->image->store());
            $dataToStore['image'] = $storeImage;
        }

        $post = Post::create($dataToStore);

        $positions = $request->positions;
        foreach ($positions as $position) {
            $post->positions()->attach($position);
        }

        return Redirect::route('post.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.detail', ['post' => $post, 'comments' => $post->comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $regions = new RegionController();
        $positions = new PositionController();

        return view('post.edit', ['post' => $post, 'postPosition' => $post->positions->setVisible(['id']), 'regions' => $regions(), 'positions' => $positions()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validation
        $request->validate([
            'title' => 'required|string',
            'gender' => 'required|string|max:1',
            'htmlContent' => 'required|string',
            'image' => 'image',
            'positions' => 'required|array',
        ]);

        // Model
        try {
            $post = Post::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return response($e->getMessage(),$e->getCode());
        }

        $oldPositions = $post->positions->setVisible(['id']);
        foreach ($oldPositions as $oldPosition) {
            $post->positions()->detach($oldPosition->id);
        }

        $dataToUpdate = [
            'title' => $request->title,
            'gender' => $request->gender,
            'region_id' => $request->region,
            'contact' => $request->contact,
            'content' => $request->htmlContent,
        ];

        if($request->hasFile('image')) {
            $oldImagePath = basename($post->image);
            if(Storage::exists($oldImagePath)) {
               $deleteImage = Storage::delete($oldImagePath);
                if(!$deleteImage) return redirect('/post')->with('response' , 'Failed to Delete Image');
            }
            $dataToUpdate['image'] = Storage::url($request->image->store());
        }

        $post->update($dataToUpdate);

        $newPositions = $request->positions;
        foreach ($newPositions as $newPosition) {
            $post->positions()->attach($newPosition);
        }

        return Redirect::route('post.show' , ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $filePath = basename($post->image);
        if(Storage::exists($filePath)) {
            $deleteImage = Storage::delete($filePath);
            if(!$deleteImage) return redirect('/post')->with('response' , '이미지 삭제에 실패하였습니다.');
        }
        return redirect('/post')->with('response', $post->delete() ? '게시글이 성공적으로 삭제되었습니다.' : '게시글 삭제에 실패하였습니다.');
    }
}
