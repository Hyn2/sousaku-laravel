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
        <div class="flex flex-col h-[560px] basis-7/12 p-8 shadow">
            <x-input-label for="title" value="TITLE"/>
            <x-text-input class="w-full my-1" id="title" name="title" type="text" placeholder="TITLE"/>
            <div class="my-1">
                <div class="flex justify-between">
                    <x-input-label class="w-3/12 text-center" for="gender" value="GENDER" />
                    <x-input-label class="w-3/12 text-center" for="region" value="REGION"/>
                    <x-input-label class="w-3/12 text-center" for="position" value="POSITION"/>
                </div>
                <div class="flex justify-between">
                    <x-select id="gender"></x-select>
                    <x-select id="region"></x-select>
                    <x-select id="position"></x-select>
                </div>
            </div>
            <x-quill class="my-3"></x-quill>
        </div>
    </x-app-layout>
</body>
</html>
