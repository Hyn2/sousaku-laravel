<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            유저 정보
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            이메일과 닉네임 및 기타 정보를 업데이트할 수 있습니다.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{--이름--}}
        <div>
            <x-input-label for="name" :value="__('이름')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{--이메일--}}
        <div>
            <x-input-label for="email" :value="__('이메일')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{--소개--}}
        <div>
            <x-input-label for="bio" :value="__('소개')" />
            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full" :value="old('bio', $user->bio)" />
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{--성별--}}
        <div>
            <x-input-label class="w-3/12" for="gender" value="GENDER" />
            <x-select name="gender">
                <option value="M" @if($user->gender == "M") selected @endif>남성</option>
                <option value="F" @if($user->gender == "F") selected @endif>여성</option>
            </x-select>
        </div>

        {{--지역--}}
        <div>
            <x-input-label class="w-3/12" for="region_id" value="REGION"/>
            <x-select name="region_id">
                @foreach($regions as $value)
                    <option value={{$value->id}}@if($user->region_id == $value->id) selected @endif>{{$value->region}}</option>
                @endforeach
            </x-select>
        </div>

        {{--포지션--}}
        <div>
            <x-select class="hidden" id="positions" name="positions[]" multiple="true">
                @foreach($positions as $value)
                    <option id={{$value->id}} value={{$value->id}} {{($userPosition->contains('id', $value->id)) ? 'selected' : ''}}></option>
                @endforeach
            </x-select>
            <p class="text-sm">POSITION</p>
            <div class="mt-1.5 flex">
                @foreach($positions as $value)
                    <x-tag class="mx-3 hover:scale-105 {{($userPosition->contains('id', $value->id)) ? 'clicked' : ''}}" :value="$value->id" >{{$value->position}}</x-tag>
                @endforeach
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('수정') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
