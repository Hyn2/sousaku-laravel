@props(['post_id'])

<div {{$attributes->merge(['class' => "m-1.5 flex flex-col w-[90%] border rounded-xl p-3"])}}>
    <div class="flex justify-between">
        <p class="text-xl font-semibold"><a href={{route('profile.show', ['user'=>$comment->user_id])}}>{{$comment->user->name}}</a></p>
        @if((auth()->user()->id ?? false) == $comment->user_id || (auth()->user()->admin ?? false))
            <form method="post" class="mb-0" action={{route('comment.destroy', ['post'=>$post_id, 'comment' => $comment->id])}}>
                @csrf
                @method('DELETE')
                <x-primary-button class="float-right" onclick="confirm('정말 삭제하시겠습니까?')">삭제</x-primary-button>
            </form>
        @endif
    </div>
    <p class="ml-1.5 mt-1.5 font-thin">{{$comment->comment}}</p>
</div>
