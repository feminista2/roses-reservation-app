@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-indigo-500 dark:border-indigo-600 text-lg font-bold leading-5 text-indigo-500 dark:text-indigo-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-indigo-500 dark:text-indigo-500 hover:text-gray-200 dark:hover:text-gray-900 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-indigo-500 dark:focus:text-indigo-500 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
