
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('이름')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" :placeholder="__('이름을 입력해주세요.')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- bio -->
        <div class="mt-4">
            <x-input-label for="bio" :value="__('소개')" />
            <x-text-input id="bio" class="block mt-1 w-full" type="text" name="bio" :value="old('bio')" :placeholder="__('소개를 입력해주세요.(선택)')" />
            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
        </div>


        <!-- region -->
        <div class="mt-4">
            <x-input-label for="region" :value="__('지역')" />
            <x-select id="region" class="w-full" name="region_id" :value="old('region')">
                @foreach($regions as $value)
                    <option value={{$value->id}}>{{$value->region}}</option>
                @endforeach
            </x-select>
        </div>

        <!-- gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('성별')" />
            <x-select id="gender" class="w-full" name="gender" :value="old('gender')" required>
                    <option value="M">남성</option>
                    <option value="F">여성</option>
            </x-select>
        </div>

        <!-- position -->
        <div class="mt-4">
            <x-input-label for="positions" :value="__('포지션')" class="mb-1.5" />
                @foreach($positions as $position)
                    <x-tag class="mx-0.5 hover:scale-105" :value="$position->id">{{$position->position}}</x-tag>
                @endforeach
            <x-input-error :messages="$errors->get('positions')" class="mt-2" />
        </div>

        <x-select class="hidden" id="positions" name="positions[]" multiple="true">
            @foreach($positions as $value)
                <option id={{$value->id}} value={{$value->id}}></option>
            @endforeach
        </x-select>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('이메일')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" :placeholder="__('이메일을 입력해주세요.')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('비밀번호')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            :placeholder="__('비밀번호')" required />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('비밀번호 확인')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            :placeholder="__('비밀번호 확인')" required  />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4">
            <input id="email_visibility" class="mr-0.5" type="checkbox" name="email_visibility" value="1" />
            <x-input-label for="email_visibility" class="inline-flex">
                이메일 공개 여부
            </x-input-label>
            <p class="inline-flex font-thin text-xs text-gray-500">선택시 모든 게시물에 이메일이 표시됩니다.</p>
            <x-input-error :messages="$errors->get('email_visibility')" class="mt-2" ></x-input-error>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('이미 회원이신가요?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('가입하기') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
