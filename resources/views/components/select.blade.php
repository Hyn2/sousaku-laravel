
<select {!! $attributes->merge(['class' => "block mt-1 w-3/12 border-gray-300 text-gray-700 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"]) !!} >
    {{$slot}}
</select>
