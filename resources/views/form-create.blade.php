<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <x-app-layout>
        <div class="flex justify-center mt-10">
            <div class="flex basis-3/5 flex-col p-1">
                <form action="/form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-end">
                        <button class="w-20 p-2 rounded-lg bg-gray-50 hover:bg-gray-100 shadow font-semibold hover:drop-shadow-md">작성</button>
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
                        <div class="flex justify-between">
                            <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                            <x-input-label class="w-3/12 text-center" for="region" value="REGION"/>
                            <x-input-label class="w-3/12 text-center" for="position" value="POSITION"/>
                        </div>
                        <div class="flex justify-between">
                            <x-select name="gender">
                                <option value="M">남자</option>
                                <option value="F">여자</option>
                            </x-select>
                            <x-select name="region">
                                @foreach($regions as $value)
                                    <option value={{$value->id}}>{{$value->region}}</option>
                                @endforeach
                            </x-select>
                            <x-select name="position">
                                @foreach($positions as $value)
                                    <option value={{$value->id}}>{{$value->position}}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <x-quill></x-quill>
                    <x-text-input hidden  type="text" id="htmlContent" name="htmlContent"/>
                </form>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
@vite(['resources/js/quill.js'])
