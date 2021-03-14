@props(['guess'])
@php $jots = $guess->jots ?? null; @endphp
<span {{$attributes->merge(['class'=>'text-center w-10'])}}>
    {{$jots === 6 ? 'JOTTO' : $jots}}
</span>
