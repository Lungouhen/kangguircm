@props([
    'text',
    'variant' => 'primary', // primary, secondary, success, danger, warning
    'size' => 'md', // sm, md, lg
    'pill' => false
])

@php
$variants = [
    'primary' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
    'secondary' => 'bg-gray-100 text-gray-800 border-gray-200',
    'success' => 'bg-green-100 text-green-800 border-green-200',
    'danger' => 'bg-red-100 text-red-800 border-red-200',
    'warning' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
];

$sizes = [
    'sm' => 'px-2 py-0.5 text-xs',
    'md' => 'px-3 py-1 text-sm',
    'lg' => 'px-4 py-1.5 text-base',
];

$badgeClass = $variants[$variant] ?? $variants['primary'];
$sizeClass = $sizes[$size] ?? $sizes['md'];
$roundedClass = $pill ? 'rounded-full' : 'rounded-md';
@endphp

<span class="inline-flex items-center font-semibold {{ $badgeClass }} {{ $sizeClass }} {{ $roundedClass }} border">
    {{ $text }}
</span>
