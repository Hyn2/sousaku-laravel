<div class="p-1 flex w-full h-[350px] bg-white border rounded-2xl shadow flex-col">
    <div class="m-3 h-3/6">
        <img alt="postImage" class="object-none object-center w-full h-full" src={{$post->image}}>
    </div>
    <div class="mx-3 h-3/6">
        <div class=" mx-1 flex justify-between">
            <p class="line-clamp-1 font-semibold" id="title">{{$post->title}}</p>
        </div>
            @php
                $content = strip_tags($post->content);
            @endphp
            <p class="line-clamp-1 m-2">{{$content}}
        <div class="flex pb-1 my-0.5 border-b justify-between">
            @if(count($post->positions) > 1)
                <div class="position">{{$post->positions->first()->position." +".count($post->positions)}}</div>
            @else
                <div class="position">{{$post->positions->first()->position}}</div>
            @endif
            <div class="region">{{$post->region["region"]}}</div>
        </div>
        <div class="mt-1">
            <p class="float-right" id="userName">{{$post->user->name}}</p>
        </div>
    </div>
</div>
