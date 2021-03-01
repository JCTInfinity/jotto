@props(['letter'=>''])
<span {{ $attributes->merge(['class'=>"border border-l-0 first:border-l h-7 w-7 inline-block text-center leading-7"]) }}>
    {{$letter ?? ''}}
</span>
