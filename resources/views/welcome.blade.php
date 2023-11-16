<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

</head>
<x-app-layout>
   <div class="flex justify-center mt-10">
        <div class="flex items-center">
            <button id="prev" class="text-5xl"><</button>
        </div>
       <div id="carousel" class="basis-2/3 overflow-hidden">
           <div id="container" class="w-full flex pb-10">
               <img id="1" class="h-auto min-w-full object-cover" src={{env('CAROUSEL_IMAGE_PATH_1')}}/>
               <img id="2" class="h-auto min-w-full object-cover" src={{env('CAROUSEL_IMAGE_PATH_2')}}/>
               <img id="3" class="h-auto min-w-full object-cover" src="{{env('CAROUSEL_IMAGE_PATH_3')}}">
           </div>
       </div>

       <div class="flex items-center">
            <button id="next" class="text-5xl">></button>
        </div>
    </div>
</x-app-layout>
<script defer type="text/javascript">
    // 변수 & 함수 선언
    const container = document.querySelector('#container');
    const nextButton = document.querySelector('#next');
    const prevButton = document.querySelector('#prev');
    const nextButtonClick = (e) => {
        const id = e.target.id;
        container.style.transform = `translateX(-${100}%)`;
        container.style.transitionDuration = '700ms';
        container.ontransitionend = () => {
            replaceElement(id)
        }
    }
    const prevButtonClick = (e) => {
        const id = e.target.id;
        container.style.transform = `translateX(${100}%)`;
        container.style.transitionDuration = '700ms';
        container.ontransitionend = () => {
            replaceElement(id);
        }
    }

    const replaceElement = (id) => {
        container.removeAttribute('style');
        (id === 'next') ?
            container.appendChild(container.firstElementChild) :
            container.insertBefore(container.lastElementChild, container.firstElementChild);
    }

    // 이벤트 등록
    nextButton.addEventListener('click', nextButtonClick);
    prevButton.addEventListener('click', prevButtonClick);
</script>
</html>
