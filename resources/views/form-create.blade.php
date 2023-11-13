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
        <div class="flex flex-col basis-7/12 justify-center shadow">
            <x-input-label for="title" value="TITLE"/>
            <x-text-input class="w-full" id="title" name="title" type="text" placeholder="TITLE"/>
            <div class="flex justify-between">
                <x-input-label for="gender" value="GENDER" />
                <x-input-label for="region" value="REGION"/>
                <x-input-label for="position" value="POSITION"/>
            </div>
            <div class="flex justify-between">

                <x-select id="gender"></x-select>

                <x-select id="region"></x-select>

                <x-select id="position"></x-select>
            </div>
            <x-quill></x-quill>
        </div>
    </x-app-layout>
</body>
</html>
