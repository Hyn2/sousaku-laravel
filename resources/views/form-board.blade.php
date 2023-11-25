<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('/resources/css/board.css')
</head>
<body>
    <x-app-layout>
        <div class="flex justify-center mt-10 h-full">
            <div id="postBox" class="basis-4/5 grid gap-6">
                @foreach($posts as $post)
                    <x-card :post="$post"></x-card>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</body>
</html>
