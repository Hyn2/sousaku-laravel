@vite(['resources/js/carousel.js'])
<x-app-layout>
   <div class="flex justify-center mt-10">
        <div id="prevDiv" class="flex items-center mr-3">
            <button id="prev" class="text-5xl"><</button>
        </div>
       <div id="carousel" class="mt-16 basis-2/3 overflow-hidden">
           <div id="container" class="w-full flex pb-10">
               <img id="1" class="h-auto min-w-full object-cover" alt="carousel1" src={{env('CAROUSEL_IMAGE_PATH_1')}}/>
               <img id="2" class="h-auto min-w-full object-cover" alt="carousel2" src={{env('CAROUSEL_IMAGE_PATH_2')}}/>
               <img id="3" class="h-auto min-w-full object-cover" alt="carousel3" src="{{env('CAROUSEL_IMAGE_PATH_3')}}">
           </div>
       </div>
       <div id="nextDiv" class="flex items-center ml-3">
            <button id="next" class="text-5xl">></button>
        </div>
    </div>
</x-app-layout>
