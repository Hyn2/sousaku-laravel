<span {!! $attributes->merge(['class' => "w-fit p-2 rounded-2xl border"]) !!}>
    <button class="tag" value={{$value}}>
        {{$slot}}
    </button>
</span>

