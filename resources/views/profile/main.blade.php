<x-app-layout>
    @include('profile.partials.user-info')
    <x-post-box :posts="$userPosts" />
</x-app-layout>
