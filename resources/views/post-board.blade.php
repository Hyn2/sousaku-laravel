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
            <div id="postBox" class="basis-4/5 grid gap-6 lg:grid-cols-3 min-[532px]:grid-cols-2 grid-cols-1">
                @if(session('response'))
                    <script>
                        alert('{{session('response')}}');
                    </script>
                @endif
                @foreach($posts as $post)
                    <x-card :post="$post"></x-card>
                @endforeach
            </div>
        </div>
    </x-app-layout>
</body>
</html>
