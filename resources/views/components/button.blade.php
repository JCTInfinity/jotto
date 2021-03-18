@props(['text','rounded'=>false,'unshadowed'=>false,'h7'=>false,'icon'])
@php
$rounding = [
    true => 'rounded-lg',
    'both' => 'rounded-lg',
    'left' => 'rounded-l-lg',
    'right' => 'rounded-r-lg',
][$rounded]??'';
$shadow = $unshadowed ? '' : 'shadow';
$height = $h7 ? 'h-7' : '';
@endphp
<button {{ $attributes->merge(['class'=>"px-2 py-1 bg-blue-200 $shadow $rounding $height"]) }}>
    @if(!empty($icon))
        <x-dynamic-component :component="'feathericon-'.$icon" :class="'-mt-1 inline '.($h7 ? 'h-5' : '')" />
    @endif
    {{ $text ?? $slot }}
</button>
