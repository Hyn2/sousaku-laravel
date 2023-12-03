
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- region -->
        <div class="mt-4">
            <x-input-label for="region" :value="__('Region')" />
            <x-select id="region" class="w-full" name="region_id" :value="old('region')">
                @foreach($regions as $value)
                    <option value={{$value->id}}>{{$value->region}}</option>
                @endforeach
            </x-select>
        </div>

        <!-- gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Gender')" />
            <x-select id="gender" class="w-full" name="gender" :value="old('gender')">
                    <option value="M">남성</option>
                    <option value="F">여성</option>
            </x-select>
        </div>

        <!-- position -->
        <div class="mt-4">
            <x-input-label for="positions" :value="__('Position')" class="mb-1.5" />
                @foreach($positions as $position)
                    <x-tag class="mx-0.5 hover:scale-105" :value="$position->id">{{$position->position}}</x-tag>
                @endforeach
            <x-input-error :messages="$errors->get('positions')" class="mt-2" />
        </div>

        <x-select id="positions" name="positions[]" multiple="true">
            @foreach($positions as $value)
                <option id={{$value->id}} value={{$value->id}}></option>
            @endforeach
        </x-select>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('이미 회원이신가요?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('가입하기') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
