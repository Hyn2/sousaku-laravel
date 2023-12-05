<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg flex flex-col p-14">
                <div class="p-6">
                    <p class="text-2xl font-medium">{{$user->name}}</p>
                    <p class="text-gray-600 ml-1">{{$user->bio}}</p>
                    <hr class="my-3">
                    <p class="text-xl">{{__('이메일')}}</p>
                    <p class="text-gray-600">{{$user->email}}</p>
                    <hr class="my-3">
                    <p class="text-xl">{{__('지역')}}</p>
                    <p class="text-gray-600">{{$user->region['region']}}</p>
                    <hr class="my-3">
                    <div id="positionContainer">
                        <p class="text-xl mb-1">{{__('포지션')}}</p>
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
