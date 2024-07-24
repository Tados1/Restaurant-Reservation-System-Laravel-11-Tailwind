<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center my-4 px-4 py-2 bg-gray-800 dark:bg-rose-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-rose-800 focus:bg-gray-700 dark:focus:bg-rose-800 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-rose-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
