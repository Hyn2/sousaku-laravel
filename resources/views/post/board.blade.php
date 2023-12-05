<x-app-layout>
    <div class="flex mt-10 w-full justify-center">
        <div class="my-1">
            {{--searchForm--}}
            <form id="searchForm" method="get" action={{route('post.index')}}>
                <div class="flex justify-evenly">
                    <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                    <x-input-label class="w-3/12 text-center" for="region" value="REGION" />
                </div>
                <div class="flex justify-evenly">
                    <x-select id="gender" name="gender">
                        <option disabled selected>선택</option>
                        <option value="N"{{($query['gender'] ?? false) == 'N' ? 'selected' : ''}}>무관</option>
                        <option value="M"{{($query['gender'] ?? false) == 'M' ? 'selected' : ''}}>남성</option>
                        <option value="F"{{($query['gender'] ?? false) == 'F' ? 'selected' : ''}}>여성</option>
                    </x-select>
                    <x-select id="region" name="region">
                        <option disabled selected>선택</option>
                        @foreach($regions as $value)
                            <option value={{$value->id}} {{($query['region'] ?? false) == $value->id ? 'selected' : ''}} >{{$value->region}}</option>
                        @endforeach
                    </x-select>
                    <x-select class="hidden" id="positions" name="positions[]" multiple="true">
                        @foreach($positions as $value)
                            <option id={{$value->id}} value={{$value->id}} {{(in_array($value->id ,$query['positions'] ?? [])) ? 'selected' : ''}}></option>
                        @endforeach
                    </x-select>
                </div>
                <p class="text-sm">POSITION</p>
                <div class="my-5 flex flex-wrap">
                    @foreach($positions as $value)
                        <x-tag id="tag" class="mx-3 hover:scale-105 {{(in_array($value->id ,$query['positions'] ?? [])) ? 'clicked' : ''}}" :value="$value->id" >{{$value->position}}</x-tag>
                    @endforeach
                </div>
                <div class="flex justify-between">
                    <x-primary-button form="resetForm">초기화</x-primary-button>
                    <x-primary-button form="searchForm" id="searchSubmit">검색</x-primary-button>
                </div>
            </form>
            {{--resetForm--}}
            <form id="resetForm" action={{route('post.index')}}>
            </form>
        </div>
    </div>
    <x-post-box :posts="$posts" />
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

