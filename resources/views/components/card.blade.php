<a class="text-left" href="{{route("post.show", ['post' => $post->id])}}">
    <div class="p-1 w-full lg:h-[325px] min-[532px]:h-[250px] h-[240px] bg-white border rounded-2xl shadow hover:bg-gray-50">
        <div class="m-3 h-3/6 shadow-sm">
            @if(is_null($post->image))
                <div class="w-full h-full flex justify-center items-center font-thin text-xl">이미지가 없어요</div>
            @else
            <img alt="postImage" class="object-center w-full h-full" src={{$post->image}}>
            @endif
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
                    <div class="position">{{$post->positions->first()->position." +".count($post->positions) - 1}}</div>
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
</a>

