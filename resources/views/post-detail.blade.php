@vite('/resources/js/quillReader.js')
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
                        @if(($userID->id ?? false) == $post->user_id)
                        <form class="mb-0" action="/post/{{$post->id}}/edit" method="GET">
                            <x-primary-button id="editPost">수정</x-primary-button>
                        </form>
                        <form class="mb-0" action="/post/{{$post->id}}" method="POST">
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
            <div class="w-full my-5 p-5 grid gap-2 border items-center h-fit rounded-2xl shadow">
                @if($post->user->email_visibility)
                <h6 class="font-bold text-gray-700">연락처</h6>
                <div>
                    <p class=" mx-1 font-medium text-gray-700">{{$post->user->email}}</p>
                </div>
                @endif
                <h6 class="font-bold text-gray-700">포지션</h6>
                <div class="flex gap-3 flex-wrap">
                    @foreach($post->positions as $post->position)
                        <x-tag :value="$post->position->position_id">{{$post->position->position}}</x-tag>
                    @endforeach
                </div>
                <h6 class="font-bold text-gray-700">지역</h6>
                <x-tag :value="$post->region->region">{{$post->region->region}}</x-tag>
            </div>
            <div class="w-[80%]">
                <img class="rounded" alt="post_image" src={{$post->image}}  />
            </div>
            <div id="editorReadOnly" class="mt-3 border-t pt-10 w-[90%]" data="{!! $post->content !!}"></div>
        </div>
    </div>
</x-app-layout>



