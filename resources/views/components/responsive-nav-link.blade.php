@props(['active' => false])


@php
$base = 'block pl-3 pr-4 py-2 border-l-4 text-base font-medium no-underline transition duration-150 ease-in-out';
$activeStyle = 'bg-indigo-50 border-indigo-600 text-indigo-700';
$inactiveStyle = 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800';

$classes = $base . ' ' . ($active ? $activeStyle : $inactiveStyle);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
