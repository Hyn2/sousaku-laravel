<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use function PHPUnit\Framework\isEmpty;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $regions = new RegionController();
        $positions = new PositionController();

        if(!empty($request->positions)) {
            $positionIds = $request->positions;
            $posts = Post::whereHas('positions', function ($query) use ($positionIds) {
                $query->whereIn('positions.id', $positionIds);
            })->latest()->get();
        } else {
            $posts = Post::with(['region:id,region', 'positions:position', 'user:id,name'])->latest()->get();
        }
        if(!empty($request->gender)) {
            $posts = $posts->whereIn('gender', [$request->gender, 'N']);
        }
        if(!empty($request->region)) {
            $posts = $posts->where('region_id', $request->region);
        }
        return view('post.board', ['posts' => $posts, 'positions' => $positions(), 'regions' => $regions(), 'query' => $request->query()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
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
            'title' => 'required|string|max:50',
            'gender' => 'required|string|max:1',
            'htmlContent' => 'required|string|max:255',
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

            if(!$storeImage) return Redirect::route('post.create')->with('fail', '이미지 저장에 실패했습니다.');

            $dataToStore['image'] = $storeImage;
        }

        $post = Post::create($dataToStore);
        if(!$post) return Redirect::route('post.create')->with('fail', '게시글 저장에 실패했습니다.');

        // 연관 관계 설정
        $positions = $request->positions;
        $post->positions()->attach($positions);

        return Redirect::route('post.show', ['post' => $post->id])->with('success', '게시글이 작성되었습니다.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
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
//        return $request;
        // Validation
        $request->validate([
            'title' => 'required|string|max:30',
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

        $dataToUpdate = [
            'title' => $request->title,
            'gender' => $request->gender,
            'region_id' => $request->region,
            'contact' => $request->contact,
            'content' => $request->htmlContent,
        ];

        // 넘어온 요청 image 키에 파일이 있는가
        if($request->hasFile('image')) {
            // 기존에 저장된 이미지가 있는가
            if(!is_null($post->image)) {
                $oldImagePath = basename($post->image);
                // 기존에 저장된 이미지 경로가 있고, 해당 경로에 파일이 존재한다면 지운다 >> 기존 이미지 삭제라는 거
                if(Storage::exists($oldImagePath)) {
                    $deleteImage = Storage::delete($oldImagePath);
                    if(!$deleteImage) return Redirect::route('post.index')->with('fail', '기존 이미지 삭제에 실패했습니다.');
                }
            }
            // 이미지를 저장하고 경로를 받는다
            $dataToUpdate['image'] = Storage::url($request->image->store());
        }

        // 모든 연관 관계 해제
        $post->positions()->detach();

        // 업데이트
        $updatePost = $post->update($dataToUpdate);
        if(!$updatePost) return Redirect::route('post.index')->with('fail', '게시글 수정에 실패하였습니다.');

        // 연관 관계 설정
        $newPositions = $request->positions;
        $post->positions()->attach($newPositions);

        return Redirect::route('post.show' , ['post' => $post->id])->with('success', '게시글이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(!is_null($post->image)) {
            $filePath = basename($post->image);
            if(Storage::exists($filePath)) {
                $deleteImage = Storage::delete($filePath);
                if(!$deleteImage) return redirect('/post')->with('fail' , '이미지 삭제에 실패하였습니다.');
            }
        }
        $deletePost = $post->delete();

        return redirect('/post')->with($deletePost ? 'success' : 'fail', $deletePost ? '게시글이 삭제되었습니다.' : '게시글 삭제에 실패하였습니다.');
    }
}
