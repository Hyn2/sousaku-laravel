<div class="flex justify-center mt-10 h-full">
    @if(count($posts) === 0)
        <div class="w-full mt-12 text-center">
            <p class="text-4xl font-thin mb-3">결과가 없습니다</p>
            <a class="text-md font thin text-gray-500 hover:text-black" href="{{route('post.create')}}">글 작성하러 가기 </a>
        </div>
    @else
        <div class="basis-4/5 grid gap-6 lg:grid-cols-3 min-[532px]:grid-cols-2 grid-cols-1">
            @foreach($posts as $post)
                <x-card :post="$post"></x-card>
            @endforeach
        </div>
    @endif
</div>
