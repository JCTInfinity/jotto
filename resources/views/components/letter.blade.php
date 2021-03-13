@props(['letter'=>''])
<span {{ $attributes->merge(['class'=>"h-full w-7 inline-block text-center leading-7"]) }}>
    {{$letter ?? ''}}
</span>
