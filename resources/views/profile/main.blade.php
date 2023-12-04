<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg flex flex-col p-14">
                <iframe class="w-full shadow-2xl"
                        height="315" src=""
                        title="YouTube video player"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen>
                </iframe>
                <div class="p-6">
                    <p class="text-2xl">{{$user->name}}</p>
                    <p class="text-gray-600">{{$user->bio}}</p>
                    <hr class="my-3">
                    <p class="text-xl">CONTACT</p>
                    <p class="text-gray-600">{{$user->email}}</p>
                    <hr class="my-3">
                    <p class="text-xl">REGION</p>
                    <p class="text-gray-600">{{$user->region['region']}}</p>
                    <hr class="my-3">
                    <div id="positionContainer">
                        <p class="text-xl">POSITIONS</p>
                        @foreach($userPositions as $userPosition)
                            <x-tag disabled>{{$userPosition->position}}</x-tag>
                        @endforeach
                    </div>
                    @if($user->id === Auth::user()->id)
                        <hr class="my-3">
                        <div class="float-right">
                            <form action={{route('profile.edit')}}>
                                <x-primary-button>수정</x-primary-button>
                            </form>
                        </div>
                    @endauth

                </div>
            </div>
        </div>

    </div>
</x-app-layout>
