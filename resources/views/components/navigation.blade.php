@php
    $base = 'flex items-center gap-3 px-4 py-3 rounded-xl group transition';
    $activeClass = 'bg-indigo-600 text-white shadow-md shadow-indigo-900/20';
    $inactiveClass = 'text-gray-600 hover:bg-gray-100';

    $classes = $base . ' ' . ($active ? $activeClass : $inactiveClass);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <i data-lucide="{{ $icon }}" class="w-5 h-5"></i>
    @endif

    <span class="font-medium text-sm">
        {{ $slot }}
    </span>
</a>