<x-app-layout>
    @vite('resources/js/quillReader.js');
    <div class="flex justify-center">
        <div class="grid basis-3/5 mt-20 place-items-center">
            <div class="pb-1 my-3 border-b w-full">
                <h1 class="text-4xl px-3 text-center whitespace-pre-wrap">{{$post->title}}</h1>
                <div class="flex ml-1.5 justify-between my-3">
                    <div class="flex gap-3 items-end">
                        <form action="/post/{{$post->id}}" method="post">
                            @method("PATCH")
                            @csrf
                            <x-primary-button id="editPost">수정</x-primary-button>
                        </form>
                        <form action="/post/{{$post->id}}" method="post">
                            @method("DELETE")
                            @csrf
                            <x-primary-button id="deletePost">삭제</x-primary-button>
                        </form>
                    </div>
                    <div class="text-right items-center">
                        <div>{{$post->user->name}}</div>
                        <div>{{$post->created_at}}</div>
                    </div>
                </div>
            </div>
            <div class="w-full my-5 p-5 grid gap-2 border items-center h-fit rounded-2xl shadow">
                <h6 class="font-bold text-gray-700">연락처</h6>
                <div>
                    <p class=" mx-1 font-medium text-gray-700">{{$post->contact}}</p>
                </div>
                <h6 class="font-bold text-gray-700">포지션</h6>
                <div class="flex gap-3 flex-wrap">
                    @foreach($post->positions as $post->position)
                        <x-tag :value="$post->position->position_id">{{$post->position->position}}</x-tag>
                    @endforeach
                </div>
                <h6 class="font-bold text-gray-700">지역</h6>
                <x-tag :value="$post->region->region">{{$post->region->region}}</x-tag>
            </div>
            <div class="w-[80%] shadow">
                <img class="rounded" alt="post_image" src={{$post->image}}  />
            </div>
            <div id="editorReadOnly" class="mt-3 border-t pt-10 w-[90%]" data="{!! $post->content !!}">

            </div>
        </div>
    </div>
</x-app-layout>


