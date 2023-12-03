<x-app-layout>
{{--    @if(session('response'))--}}
{{--        <script>--}}
{{--            alert('{{session('response')}}');--}}
{{--        </script>--}}
{{--    @endif--}}
    <div class="flex mt-10 w-full justify-center">
        <div class="my-1">
            <form method="get" action="/post">
                <div class="flex justify-evenly">
                    <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                    <x-input-label class="w-3/12 text-center" for="region" value="REGION"/>
                </div>
                <div class="flex justify-evenly">
                    <x-select id="gender" name="gender">
                        <option disabled selected>선택</option>
                        <option value="M">남자</option>
                        <option value="F">여자</option>
                    </x-select>
                    <x-select id="region" name="region">
                        <option disabled selected>선택</option>
                        @foreach($regions as $value)
                            <option value={{$value->id}}>{{$value->region}}</option>
                        @endforeach
                    </x-select>
                    <x-select class="hidden" id="positions" name="positions[]" multiple="true">
                        @foreach($positions as $value)
                            <option id={{$value->id}} value={{$value->id}}></option>
                        @endforeach
                    </x-select>
                </div>
                <p class="text-sm">POSITION</p>
                <div class="my-5 flex">
                    @foreach($positions as $value)
                        <x-tag id="tag" class="mx-3 hover:scale-105" :value="$value->id">{{$value->position}}</x-tag>
                    @endforeach
                </div>
                <div class="flex justify-end">
                    <button id="searchSubmit" class="w-20 p-2 rounded-lg bg-gray-50 hover:bg-gray-100 shadow font-semibold hover:drop-shadow-md">검색</button>
                </div>
            </form>
        </div>
    </div>
    <div class="flex justify-center mt-10 h-full">
        <div id="postBox" class="basis-4/5 grid gap-6 lg:grid-cols-3 min-[532px]:grid-cols-2 grid-cols-1">
            @foreach($posts as $post)
                <x-card :post="$post"></x-card>
            @endforeach
        </div>
    </div>
</x-app-layout>

<script>
    const regions = document.querySelector('#region');
    const genders = document.querySelector('#gender');
    const positions = document.querySelectorAll('#tag');

    regions.addEventListener('change', ()=>{
        axios.get('http://localhost:8000')
            .then((res) => {
                console.log(res)
            })
    });

    genders.addEventListener('change', ()=>{
        console.log('g')
    });

    positions.forEach((position)=>{
        position.addEventListener('click', ()=>{
            console.log('p')
        });
    })

</script>

