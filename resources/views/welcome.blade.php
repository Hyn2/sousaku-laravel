@vite(['resources/js/carousel.js'])
<x-app-layout>
    <div class="flex flex-col items-center">
        <div class="flex justify-center">
            <div class="mt-20 pb-4 border-b w-full">
                <h1 class="font-thin text-center">이번 주의 음악</h1>
            </div>
        </div>
        <button class="text-center mt-3 text-gray-300 hover:text-gray-600">Carousel 수정하기</button>
        <div class="flex justify-center w-full h-[800px]">
            <div id="prevDiv" class="flex items-center mr-3">
                <button id="prev" class="text-5xl"><</button>
            </div>
            <div id="carousel" class="mt-10 basis-2/3 overflow-hidden">
                <div id="container" class="w-full h-full flex pb-10">
                    <iframe class="h-auto min-w-full"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            src={{env('CAROUSEL_IMAGE_PATH_1')}}>
                    </iframe>
                    <iframe class="h-auto min-w-full"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            src={{env('CAROUSEL_IMAGE_PATH_2')}}>
                    </iframe>
                    <iframe class="h-auto min-w-full"
                            title="YouTube video player"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen
                            src={{env('CAROUSEL_IMAGE_PATH_3')}}>
                    </iframe>
                </div>
            </div>
            <div id="nextDiv" class="flex items-center ml-3">
                <button id="next" class="text-5xl">></button>
            </div>
        </div>
    </div>

</x-app-layout>

