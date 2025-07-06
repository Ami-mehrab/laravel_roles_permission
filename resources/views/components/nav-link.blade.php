@props(['active'])

@php
$base = 'inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 relative transition duration-150 ease-in-out no-underline';
$activeStyle = 'text-indigo-600 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-full after:h-[2px] after:bg-indigo-600 after:transition-all after:duration-300';
$inactiveStyle = 'hover:text-indigo-500 after:content-[""] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-indigo-500 after:transition-all after:duration-300 hover:after:w-full';

$classes = $base . ' ' . ($active ? $activeStyle : $inactiveStyle);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
