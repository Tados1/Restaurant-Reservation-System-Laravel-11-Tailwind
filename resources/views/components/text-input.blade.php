@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'dark:border-gray-700 dark:bg-transparent dark:text-gray-300 dark:focus:border-rose-500 dark:focus:ring-rose-500 rounded-md']) !!}>
