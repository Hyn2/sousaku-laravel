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
                    <form action="" method="post">
                        <div class="flex justify-end">
                            <button class="w-20 p-2 rounded-lg bg-gray-50 hover:bg-gray-100 shadow font-semibold hover:drop-shadow-md">작성</button>
                        </div>
                        <div class="my-3">
                            <x-input-label for="title" value="TITLE"/>
                            <x-text-input class="w-full my-1" id="title" name="title" type="text" placeholder="TITLE"/>
                        </div>
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
                        <x-quill></x-quill>
                    </form>
                </div>


        </div>
    </x-app-layout>
</body>
</html>
