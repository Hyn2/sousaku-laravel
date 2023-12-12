<x-app-layout>
    <div class="flex justify-center">
        <div class="grid basis-3/5 mt-20 place-items-center">
            <div class="pb-1 my-3 border-b w-full">
                <h1 class="text-4xl px-3 text-center whitespace-pre-wrap">{{$post->title}}</h1>
                <div class="flex ml-1.5 justify-between my-3">
                    <div class="flex gap-3 items-end">
                        @php
                        $userID = auth()->user();
                        @endphp
                        @if(($userID->id ?? false) == $post->user_id || (auth()->user()->admin ?? false))
                        <form class="mb-0" method="GET" action={{route('post.edit', ['post' =>$post->id])}}>
                            <x-primary-button id="editPost">수정</x-primary-button>
                        </form>
                        <form class="mb-0" method="POST" action={{route('post.destroy', ['post'=>$post->id])}}>
                            @method("DELETE")
                            @csrf
                            <x-primary-button id="deletePost" onclick="confirm('삭제할거에요?')">삭제</x-primary-button>
                        </form>
                        @endif
                    </div>
                    <div class="text-right items-center">
                        <div class="rounded-2xl text-gray-700 hover:scale-105 hover:text-black" ><a href={{route('profile.show', ['user'=>$post->user_id])}}>{{$post->user->name}}</a></div>
                        <div>{{$post->created_at}}</div>
                    </div>
                </div>
            </div>
            <div id="optionBox" class="w-full my-5 p-5 flex flex-col gap-x-10 gap-y-3 justify-around border
             h-fit rounded-2xl shadow">
                <h6 class="font-bold text-gray-700 border-b">연락처</h6>
                @if($post->user->email_visibility)
                    <p class=" mx-1 font-medium text-gray-700">{{$post->user->email}}</p>
                @else
                    <p class="mx-1 font-medium text-gray-700">비공개</p>
                @endif
                <h6 class="font-bold text-gray-700 border-b">성별</h6>
                <p class=" mx-1 font-medium text-gray-700">
                    {{ $post->gender == "N" ? "무관" :
                    ($post->gender == "M" ? "남성" : "여성") }}
                </p>
                <h6 class="font-bold text-gray-700 border-b">포지션</h6>
                <div class="flex gap-3 flex-wrap">
                    @foreach($post->positions as $post->position)
                        <x-tag :value="$post->position->position_id">{{$post->position->position}}</x-tag>
                    @endforeach
                </div>
                <h6 class="font-bold text-gray-700 border-b">지역</h6>
                <div class="flex">
                    <x-tag :value="$post->region->region" disabled="true">{{$post->region->region}}</x-tag>
                </div>
            </div>
            <div class="w-[80%]">
                @if(!is_null($post->image))<img class="rounded" alt="post_image" src={{$post->image}}  />@endif
            </div>
            <div id="editorReadOnly" class="mt-3 border-y pt-7 w-[90%]" data="{!! $post->content !!}"></div>
            <div class="w-[90%] my-3 border-b pb-3">
                <form method="post" action={{route('comment.store', ['post' => $post->id])}}>
                    @csrf
                    <x-input-label for="comment" value="{{ __('댓글') }}" class="text-xl mb-1.5"></x-input-label>
                    <x-text-input id="comment" name="comment"  :value="old('comment') ?? ''" class="w-full h-24" placeholder="{{__('여기 댓글을 작성하세요(최대 30자)')}}" maxlength="30"></x-text-input>
                    <x-primary-button class="float-right mt-3">작성</x-primary-button>
                </form>
            </div>
            @foreach($comments as $comment)
                <x-comment-box :comment="$comment" :post_id="$post->id"></x-comment-box>
            @endforeach
        </div>
    </div>
</x-app-layout>



