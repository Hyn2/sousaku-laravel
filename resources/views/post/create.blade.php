<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="flex basis-3/5 flex-col p-1">
            <form id="postForm" method="post" enctype="multipart/form-data" action={{route('post.store')}}>
                @csrf
                <div class="flex justify-end">
                    <x-primary-button id="formSubmit">작성</x-primary-button>
                </div>
                    <div class="my-1 items-center px-8">
                        <div class="flex items-center">
                            <x-input-label class="w-fit mr-3" for="title" :value="__('제목')" />
                            <x-input-error :messages="$errors->get('title')" />
                        </div>
                        <x-text-input class="w-full my-1" id="title" name="title" :value="old('title', '')" type="text" placeholder="TITLE" maxlength="30"/>
                    </div>
                <div class="my-1">
                    <div class="flex justify-evenly">
                        <x-input-label class="w-3/12 text-center" for="gender" :value="__('성별')" />
                        <x-input-label class="w-3/12 text-center" for="region" :value="__('지역')"/>
                    </div>
                    <div class="flex justify-evenly">
                        <x-select name="gender">
                            <option value="N" {{ old('gender') == "N" ? 'selected' : '' }}>무관</option>
                            <option value="M" {{ old('gender') == "M" ? 'selected' : '' }}>남성</option>
                            <option value="F" {{ old('gender') == "F" ? 'selected' : '' }}>여성</option>
                        </x-select>
                        <x-select name="region">
                            @foreach($regions as $value)
                                <option value={{$value->id}} {{ old('region') == $value->id ? 'selected' : '' }}>{{$value->region}}</option>
                            @endforeach
                        </x-select>
                        <x-select class="hidden" id="positions" name="positions[]" multiple="true">
                            @foreach($positions as $value)
                                <option id={{$value->id}} value={{$value->id}} {{ in_array($value->id, old('positions', [])) ? 'selected' : '' }}></option>
                            @endforeach
                        </x-select>
                    </div>
                    <div class="flex items-center mt-3">
                        <p class="text-sm mx-3">{{__('포지션')}}</p>
                        <x-input-error :messages="$errors->get('positions')" />
                    </div>
                    <div class="mt-4 mb-5 flex flex-wrap px-7">
                        @foreach($positions as $value)
                            <x-tag class="mx-3 hover:scale-105 {{ in_array($value->id, old('positions', [])) ? 'clicked' : '' }}" :value="$value->id">{{$value->position}}</x-tag>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-center">
                    <x-input-label class="w-fit mx-3" for="image" :value="__('이미지')" />
                    <x-input-error :messages="$errors->get('image')" />
                </div>
                <div id="imageContainer" class="flex items-center w-auto h-16 mb-3">
                    <label for="image" class="mr-5">
                        <div class="border px-3 py-2 rounded-2xl hover:scale-105 font-thin">사진 업로드하기</div>
                    </label>
                    <input hidden id="image" type="file" name="image" />
                    <div class="w-1/12 max-h-full overflow-hidden mr-1">
                        <img id="preImg" class="max-h-full max-w-full">
                    </div>
                </div>
                <hr />
                <x-input-error :messages="$errors->get('htmlContent')" class="mt-2" />
                <x-quill></x-quill>
                <x-text-input hidden type="text" id="htmlContent" :value="old('htmlContent', '')" name="htmlContent"/>
            </form>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    const image = (e) => {
        const img = document.querySelector('#preImg');
        if(img.src !== '') {
            console.log('a');
            URL.revokeObjectURL(img.src);
        }
        const url = URL.createObjectURL(e.target.files[0]);
        img.setAttribute('src', url);
    }

    const img = document.querySelector('#image');
    img.addEventListener('change', image);

    const modules = {
        toolbar: {
            container : [
                [{header: [1,2,3,false]}],
                ["bold","italic","underline","strike"],
                [{ list: "ordered" }, { list: "bullet" }],
                [{ color: [] }, { background: [] }],
                [{ align: [] }],
            ],
        },
    }

    const formats =
        [
            "header",
            "bold",
            "italic",
            "underline",
            "strike",
            "align",
            "list",
            "bullet",
            "background",
            "color",
            "image",
        ];

    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: modules,
        formats: formats,
    });
    quill.on('text-change', () => {
        const data = quill.root.innerHTML;
        const content = document.querySelector('#htmlContent');
        content.value = data;
    });



    document.addEventListener('DOMContentLoaded', ()=>{
        console.log('test');
        const htmlContent = document.querySelector('#htmlContent');
        if(htmlContent.value) quill.setContents(quill.clipboard.convert(htmlContent.value));
    });
</script>

