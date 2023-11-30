<div id="header" class="flex justify-center">
    <div class="flex basis-2/12 text-center items-center">
        <a class="relative w-[76.5%] pb-[22%] min-[532px]:w-[59%] min-[532px]:pb-[17%]" href="/"><img id="logo" class="absolute w-full h-full" src="/storage/LOGO_NEW.jpg" alt="logo"></a>
    </div>
    <div class="flex basis-7/12 pt-1 justify-center items-center min-[532px]:justify-start">
        <div class="mx-5 text-lg">
            <a href="{{route("post.create")}}">멤버 구하기</a>
        </div>
        <div class="mx-5 text-lg">
            <a href="{{route('post.index')}}">공고 글</a>
        </div>
    </div>
    <div class="flex items-center justify-center basis-2/12 text-center pt-1 flex-col min-[738px]:flex-row">
        @auth
            <div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-900 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-semibold hover:text-gray-800">{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        @else
            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="font-semibold text-black hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>
            @endif
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="ml-4 font-semibold text-black hover:text-gray-400 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
            @endif
        @endauth
    </div>
</div>
