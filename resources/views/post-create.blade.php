@vite('/resources/js/quill.js')
<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="flex basis-3/5 flex-col p-1">
            <form id="postForm" method="post" enctype="multipart/form-data" action={{route('post.store')}}>
                @csrf
                <div class="flex justify-end">
                    <x-primary-button id="formSubmit">작성</x-primary-button>
                </div>
                <div class="my-1 items-center">
                    <x-input-label class="w-fit" for="title" value="TITLE"/>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <x-text-input class="w-full my-1" id="title" name="title" type="text" placeholder="TITLE"/>
                </div>
                <div class="my-1">
                    <div class="flex justify-evenly">
                        <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                        <x-input-label class="w-3/12 text-center" for="region" value="REGION"/>
                    </div>
                    <div class="flex justify-evenly">
                        <x-select name="gender">
                            <option value="M">남자</option>
                            <option value="F">여자</option>
                        </x-select>
                        <x-select name="region">
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
                    <x-input-error :messages="$errors->get('positions')" class="mt-2" />
                    <div class="my-5 flex flex-wrap">
                        @foreach($positions as $value)
                            <x-tag class="mx-3 hover:scale-105" :value="$value->id">{{$value->position}}</x-tag>
                        @endforeach
                    </div>
                </div>
                <x-input-label class="w-3/12" for="image" value="IMAGE" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                <div id="imageContainer" class="flex items-center w-auto h-20">
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
                <x-text-input hidden type="text" id="htmlContent" name="htmlContent"/>
            </form>
        </div>
    </div>
</x-app-layout>

