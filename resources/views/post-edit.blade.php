{{--@vite('/resources/js/quill.js')--}}
<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="flex basis-3/5 flex-col p-1">
            <form id="postForm" action="/post/{{$post->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="flex justify-end">
                    <button id="formSubmit" class="w-20 p-2 rounded-lg bg-gray-50 hover:bg-gray-100 shadow font-semibold hover:drop-shadow-md">작성</button>
                </div>
                <div class="my-1">
                    <x-input-label for="title" value="TITLE"/>
                    <x-text-input class="w-full my-1" :value="old('title', $post->title)" id="title" name="title" type="text" placeholder="TITLE"/>

                </div>
                <div class="my-1">
                    <x-input-label for="contact" value="CONTACT"/>
                    <x-text-input class="w-full my-1" id="contact" name="contact" type="text" :value="old('contact', $post->contact)" placeholder="CONTACT"/>
                </div>
                <div class="my-1">
                    <div class="flex justify-evenly">
                        <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                        <x-input-label class="w-3/12 text-center" for="region" value="REGION"/>
                    </div>
                    <div class="flex justify-evenly">
                        <x-select name="gender">
                            <option value="M" @if($post->gender == "M") selected @endif>남자</option>
                            <option value="F" @if($post->gender == "F") selected @endif>여자</option>
                        </x-select>
                        <x-select name="region">
                            @foreach($regions as $value)
                                <option @if($value->id == $post->region_id) selected @endif value={{$value->id}}>{{$value->region}}</option>
                            @endforeach
                        </x-select>
                        <x-select class="hidden" id="positions" name="positions[]" multiple="true">
                            @foreach($positions as $value)
                                <option id={{$value->id}} value={{$value->id}} {{($postPosition->contains('id', $value->id)) ? 'selected' : ''}}></option>
                            @endforeach
                        </x-select>

                    </div>
                    <p class="text-sm">POSITION</p>
                    <div class="my-5 flex">
                        @foreach($positions as $value)
                            <x-tag class="mx-3 hover:scale-105
                            {{($postPosition->contains('id', $value->id)) ? 'clicked' : ''}}" :value="$value->id">{{$value->position}}</x-tag>
                        @endforeach
                    </div>
                </div>
                <x-input-label class="w-3/12" for="image" value="IMAGE" />
                <div id="imageContainer" class="flex items-center w-auto h-20">
                    <label for="image" class="mr-5">
                        <div class="border px-3 py-2 rounded-2xl hover:scale-105 font-thin">사진 업로드하기</div>
                    </label>
                    <input hidden id="image" type="file" name="image" />
                    <div class="w-1/12 max-h-full overflow-hidden mr-1">
                        <img id="preImg" class="max-h-full max-w-full" src="{{$post->image}}">
                    </div>
                </div>
                <x-quill></x-quill>
                <x-text-input hidden type="text" id="htmlContent" name="htmlContent"/>
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

    const putData =(data) => {
        const htmlToDelta = quill.clipboard.convert(data);
        quill.setContents(htmlToDelta);
    }

    putData('{!! $post->content !!}');
</script>
