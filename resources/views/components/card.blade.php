<div class="p-1 flex w-full h-[350px] bg-white border rounded-2xl shadow flex-col">
    <div class="m-3 h-3/6">
        <img class="object-none object-center w-full h-full" src="https://thumbs.dreamstime.com/z/music-notes-7544001.jpg?w=576">
    </div>
    <div class="mx-3 h-3/6">
        <div class=" mx-1 flex justify-between">
            <p class="line-clamp-1" id="title">{{$post->title}}</p>
        </div>
            <p class="line-clamp-2 my-2">{{$post->content}}</p>
        <div class="flex pb-1 mb-0.5 border-b justify-between">
            <div class="position">{{$post->position_id}}</div>
            <div class="region">{{$post->region_id}}</div>
        </div>
        <div class="mt-1">
            <p class="float-right" id="userName">{{$post->user_id}}</p>
        </div>
    </div>
</div>
