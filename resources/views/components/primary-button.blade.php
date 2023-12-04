<button {{ $attributes->merge(['type' => 'submit', 'class' => 'shadow inline-flex items-center px-4 py-2 bg-gray-100 border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-200 hover:drop-shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
