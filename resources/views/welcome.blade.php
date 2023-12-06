
<x-app-layout>
    <div class="flex flex-col items-center my-20 gap-32">
        <div id="recentPost" class="grid gap-3 w-[80%]">
            <h1 class="text-3xl font-thin text-center pb-4 border-b w-full">
                최근 공고
            </h1>
            <x-post-box :posts="$posts"></x-post-box>
        </div>
        <div id="weeklyMusic" class="grid gap-3 w-[80%]">
            <h2 class="text-3xl font-thin text-center pb-4 border-b w-full">이번 주의 음악</h2>
            @if(auth()->user()->admin ?? false)
                <x-input-label class="text-center mt-3" for="link">영상 변경하기</x-input-label>
            <div class="flex justify-center">
                <form method="POST" action={{route('embedlink.update')}}>
                    @csrf
                    @method('PATCH')
                    <x-text-input id="link" name="link" :value="$embedLink->link"></x-text-input>
                    <x-primary-button>변경</x-primary-button>
                </form>
            </div>
            @endif
            <div class="mt-10 relative pb-[56.25%]">
                <iframe class="w-full absolute h-full"
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                        src={{$embedLink->link}}>
                </iframe>
            </div>
        </div>
    </div>

</x-app-layout>

