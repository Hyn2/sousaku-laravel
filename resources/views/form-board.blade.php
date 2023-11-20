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
        <div class="flex justify-center mt-10 h-full">
            <div class="basis-2/3 grid gap-6" style="grid-template-columns: repeat(3, minmax(0px, 1fr));">
                @foreach($posts as $post)
                    <x-card :post="$post"></x-card>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</body>
</html>
