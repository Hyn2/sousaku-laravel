@vite('/resources/js/quill.js')
<x-app-layout>
    <div class="flex justify-center mt-10">
        <div class="flex basis-3/5 flex-col p-1">
            <form id="postForm" action="/post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex justify-end">
                    <button id="formSubmit" class="w-20 p-2 rounded-lg bg-gray-50 hover:bg-gray-100 shadow font-semibold hover:drop-shadow-md">작성</button>
                </div>
                <div class="my-1">
                    <x-input-label for="title" value="TITLE"/>
                    <x-text-input class="@error('title') is-invalid @enderror w-full my-1" id="title" name="title" type="text" placeholder="TITLE"/>
                    @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="my-1">
                    <x-input-label for="contact" value="CONTACT"/>
                    <x-text-input class="w-full my-1" id="contact" name="contact" type="text" placeholder="CONTACT"/>
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
                    <div class="my-5 flex">
                        @foreach($positions as $value)
                            <x-tag class="mx-3 hover:bg-gray-50, hover:scale-105" :value="$value->id">{{$value->position}}</x-tag>
                        @endforeach
                    </div>
                </div>
                <x-input-label class="w-3/12" for="image" value="IMAGE" />
                <div id="imageContainer" class="flex items-center w-auto h-20">
                    <input id="image" type="file" name="image" />
                    <div class="w-1/12 max-h-full overflow-hidden mr-1">
                        <img id="preImg" class="max-h-full max-w-full">
                    </div>
                </div>
                <x-quill></x-quill>
                <x-text-input hidden type="text" id="htmlContent" name="htmlContent"/>
            </form>
        </div>
    </div>
</x-app-layout>

