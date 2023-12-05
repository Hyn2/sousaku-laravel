<button {!! $attributes->merge(['class' => "w-fit p-2 h-10 rounded-2xl border tag"]) !!} value={{$value}}>
    {{$slot}}
</button>

